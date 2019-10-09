<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;

/**
 * Class DogService
 * @package App\Services
 */
class DogService
{
    const RANDOM_ENDPOINT = 'https://dog.ceo/api/breeds/image/random';
    const BREED_ENDPOINT = 'https://dog.ceo/api/breed/%s/images/random';
    const API_KEY = 'trnsl.1.1.20190926T211623Z.603dcfac0a529e09.8e794cc99476245e2732ae3757e381b0a046dd38';
    const TRANSLATE_ENDPOINT = 'https://translate.yandex.net/api/v1.5/tr.json/translate?key=' . self::API_KEY . '&text=%s&lang=en';

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
     * Fetch and return a random image from all breeds.
     *
     * @return string
     */
    public function random()
    {
        try {
            $response = json_decode(
                $this->client->get(self::RANDOM_ENDPOINT)->getBody()
            );

            return $response->message;
        } catch (Exception $e) {
            return 'Произошла ошибка, повтори попытку позже.';
        }
    }

    /**
     * Fetch and return a random image from a given breed.
     *
     * @param string $breed
     * @return string
     */
    public function byBreed($breed)
    {
        try {
            $breed_translate = json_decode(
                $this->client->get(sprintf(self::TRANSLATE_ENDPOINT, $breed))->getBody()
            );
            $endpoint = sprintf(self::BREED_ENDPOINT, strtolower($breed_translate->text[0]));

            $response = json_decode(
                $this->client->get($endpoint)->getBody()
            );

            return $response->message;
        } catch (Exception $e) {
            return 'Извини, фото собакена ' . $breed . ' не найдено:( Попробуй другую породу.';
        }
    }
}
