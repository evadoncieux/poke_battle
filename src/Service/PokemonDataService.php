<?php

namespace App\Service;

use GuzzleHttp\Client;
use \Psr\Http\Message\ResponseInterface;

class PokemonDataService
{
    public function __construct()
    {
        //
    }

    public function getPokemon()
    {
        $client = new Client();
        $response = $client->request('GET', 'https://pokeapi.co/api/v2/pokemon?limit=36&offset=0');


//        // Send an asynchronous request.
//        $request = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');
//        $promise = $client->sendAsync($request)->then(function ($response) {
//            echo 'I completed! ' . $response->getBody();
//        });
//
//        $promise->wait();

        return json_decode($response->getBody());
    }
}