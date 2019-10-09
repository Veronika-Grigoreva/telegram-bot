<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

/**
 * Class WeatherService
 * @package App\Services
 */
class WeatherService
{
    const API_TOKEN = 'cb36c7eebf5479f855993fbff9abd46b';
    const WEATHER_ENDPOINT = 'https://api.openweathermap.org/data/2.5/weather?q=%s&lang=RU&APPID=' . self::API_TOKEN;

    /**
     * Guzzle client.
     *
     * @var GuzzleHttp\Client
     */
    private $client;

    /**
     * DogService constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client;
    }

    /**
     * Return weather from a city.
     *
     * @param string $city
     * @return string
     */
    public function byCity($city)
    {
        try {
            $endpoint = sprintf(self::WEATHER_ENDPOINT, $city);

            $response = json_decode(
                $this->client->get($endpoint)->getBody()
            );

            $finalTemp = $response->main->temp - 273.15;
            return mb_convert_case($city, MB_CASE_TITLE, 'UTF-8') . ': ' .round($finalTemp) . "\u{2103} " .
                $response->weather[0]->description;
        } catch (Exception $e) {
            return 'Такой город еще не известен человечеству о_О';
        }
    }
}
