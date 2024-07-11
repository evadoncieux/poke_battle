<?php

namespace App\Service;

use App\Entity\Pokemon;
use GuzzleHttp\Client;
use \Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class PokemonDataService
{
    public function __construct()
    {
        //
    }

    public function getAllPokemon()
    {
        $client = new Client();
        $limit = 36;
        $offset = 0;
        $response = $client->request('GET', "https://pokeapi.co/api/v2/pokemon?limit=$limit&offset=$offset");
        $decodedResponse = json_decode($response->getBody()->getContents(), true);

        $index = 0;
        foreach ($decodedResponse['results'] as $pokemonData) {
            echo $index++;
            $pokemon = new Pokemon();
            $pokemon->setName($pokemonData['name'])
                ->setUrl($pokemonData['url']);
            $allPokemon[] = $pokemon;
        }

        return $allPokemon;
    }

//    public function getPokemonByInfo($id)
//    {
//        $client = new Client();
//        $response = $client->request('GET', "https://pokeapi.co/api/v2/pokemon/$id");
//        $decodedResponse = json_decode($response->getBody());
//        dd($decodedResponse);
//
//        return $decodedResponse;
//    }
}