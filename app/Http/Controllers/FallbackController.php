<?php

namespace App\Http\Controllers;

/**
 * Class FallbackController
 * @package App\Http\Controllers
 */
class FallbackController extends Controller
{
    /**
     * Respond with a generic message.
     *
     * @param $bot
     * @return void
     */
    public function index($bot)
    {
        $bot->reply('Sorry, I did not understand these command. Try: \'Start Conversation\'');
    }
}
