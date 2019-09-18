<?php
//use App\Http\Controllers\BotManController;

use App\Conversations\StartConversation;

$botman = resolve('botman');

$botman->hears('/start', function ($bot) {
    $bot->reply('Hello! If you want to know the details, try: \'Start Conversation\'');
});

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello! If you want to know the details, try: \'Start Conversation\'');
});

$botman->hears('Start Conversation', 'App\Http\Controllers\ConversationController@index');
$botman->hears('/random', 'App\Http\Controllers\AllBreedsController@random');
$botman->hears('/b {breed}', 'App\Http\Controllers\AllBreedsController@byBreed');
$botman->hears('Bye', 'App\Http\Controllers\ConversationController@bye');
$botman->fallback('App\Http\Controllers\FallbackController@index');
