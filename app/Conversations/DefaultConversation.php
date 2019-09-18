<?php

namespace App\Conversations;

use App\Services\DogService;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

/**
 * Class DefaultConversation
 * @package App\Conversations
 */
class DefaultConversation extends Conversation
{
    public function defaultQuestion()
    {
        $question = Question::create('Huh - you woke me up. What do you need?')
            ->addButtons([
                Button::create('Random dog photo')->value('random'),
                Button::create('A photo by breed')->value('breed'),
            ]);

        return $this->ask($question, function (Answer $answer) {
           if ($answer->isInteractiveMessageReply()) {
               switch ($answer->getValue()) {
                   case 'random':
                       $this->say((new DogService())->random());
                       break;
                   case 'breed';
                       $this->askForBreedName();
                       break;
               }
           }
        });
    }

    /**
     * Ask for the breed name and send the image.
     *
     * @return void
     */
    public function askForBreedName()
    {
        $this->ask('What\'s the breed name?', function (Answer $answer) {
           $name = $answer->getText();

            $this->say((new DogService())->byBreed($name));
        });
    }

    /**
     * Start the conversation
     *
     * @return void
     */
    public function run()
    {
        $this->defaultQuestion();
    }
}
