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
            return 'An unexpected error occurred. Please try again later.';
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
            $endpoint = sprintf(self::BREED_ENDPOINT, $breed);

            $response = json_decode(
                $this->client->get($endpoint)->getBody()
            );

            return $response->message;
        } catch (Exception $e) {
            return 'Sorry, I could\'t get you any photos from ' . $breed . '.' . ' Please try with a different breed.';
        }
    }
}
