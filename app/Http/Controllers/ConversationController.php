<?php

namespace App\Http\Controllers;

use App\Conversations\DefaultConversation;

/**
 * Class ConversationController
 * @package App\Http\Controllers
 */
class ConversationController extends Controller
{
    /**
     * Create a new conversation.
     *
     * @param $bot
     * @return void
     */
    public function index($bot)
    {
        $bot->startConversation(new DefaultConversation);
    }

    public function bye($bot)
    {
        $userName = $bot->getUser()->getUsername();

        if (empty($userName)) {
            $name = $bot->getUser()->getFirstName();

            $bot->reply('Bye, ' . $name);
        } else {
            $bot->reply('Bye, @' . $userName);
        }

    }
}
