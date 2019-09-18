<?php

namespace App\Http\Controllers;

use App\Services\DogService;

/**
 * Class AllBreedsController
 * @package App\Http\Controllers
 */
class AllBreedsController extends Controller
{
    private $photos;

    /**
     * AllBreedsController constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->photos = new DogService;
    }

    /**
     * Return a random dog image from all breeds.
     *
     * @param $bot
     * @return void
     */
    public function random($bot)
    {
        $bot->reply($this->photos->random());
    }

    /**
     * Return a random dog image from a given breed.
     *
     * @param $bot
     * @param $name
     * @return void
     */
    public function byBreed($bot, $name)
    {
        $bot->reply($this->photos->byBreed($name));
    }
}
