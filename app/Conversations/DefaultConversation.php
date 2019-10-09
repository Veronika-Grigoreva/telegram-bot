<?php

namespace App\Conversations;

use App\Services\DogService;
use App\Services\WeatherService;
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
        $question = Question::create('Так, чего тебе хочется?')
            ->addButtons([
                Button::create('Рандомное фото собакена')->value('random'),
                Button::create('Фото собакена по породе')->value('breed'),
                Button::create('Погода сейчас')->value('weather'),
//                Button::create('Рандомный фильм')->value('film'),
            ]);

        return $this->ask($question, function (Answer $answer) {
           if ($answer->isInteractiveMessageReply()) {
               switch ($answer->getValue()) {
                   case 'random':
                       $this->say((new DogService())->random());
                       break;
                   case 'breed':
                       $this->askForBreedName();
                       break;
                   case 'weather':
                       $this->askForWeatherInCity();
                       break;
                   case 'film':
                       $this->askForFilmGenre();
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
        $this->ask('Порода собакена?', function (Answer $answer) {
           $name = $answer->getText();

            $this->say((new DogService())->byBreed($name));
        });
    }

    /**
     * Ask for the city and send the weather.
     *
     * @return void
     */
    public function askForWeatherInCity()
    {
        $this->ask('Какой город?', function (Answer $answer) {
           $city = $answer->getText();

           $this->say((new WeatherService())->byCity($city));
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
