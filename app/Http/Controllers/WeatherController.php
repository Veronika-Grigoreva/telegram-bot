<?php

namespace App\Http\Controllers;

use App\Services\WeatherService;

/**
 * Class WeatherController
 * @package App\Http\Controllers
 */
class WeatherController extends Controller
{
    private $temp;

    /**
     * WeatherController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->temp = new WeatherService;
    }

    /**
     * Return temp from a city.
     *
     * @param $bot
     * @param $city
     * @return void
     */
    public function byCity($bot, $city)
    {
        $bot->reply($this->temp->byCity($city));
    }
}
