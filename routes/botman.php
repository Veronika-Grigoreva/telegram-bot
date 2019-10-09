<?php
//use App\Http\Controllers\BotManController;

use App\Conversations\StartConversation;

$botman = resolve('botman');

$botman->hears('/start', function ($bot) {
    $bot->reply('Привет! Если ты хочешь уточнить делали, напиши мне: \'Старт\'');
});

$botman->hears('Привет', function ($bot) {
    $bot->reply('Привет! Если ты хочешь уточнить делали, напиши мне: \'Старт\'');
});


$botman->hears('Старт', 'App\Http\Controllers\ConversationController@index');
$botman->hears('/random', 'App\Http\Controllers\AllBreedsController@random');
$botman->hears('/b {breed}', 'App\Http\Controllers\AllBreedsController@byBreed');

$botman->hears('/w {city}', 'App\Http\Controllers\WeatherController@byCity');

$botman->hears('Пока', 'App\Http\Controllers\ConversationController@bye');
$botman->fallback('App\Http\Controllers\FallbackController@index');
