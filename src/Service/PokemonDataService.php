<?php

namespace App\Service;

use App\Entity\Pokemon;
use GuzzleHttp\Client;

class PokemonDataService
{
    public function __construct()
    {
    }

    public function getAllPokemon(): array
    {
        $client = new Client();

        $count = 0;
        $limit = 18;
        $offset = rand(0, 999);
        $allPokemon = [];

        $response = $client->request('GET', "https://pokeapi.co/api/v2/pokemon?limit=$limit&offset=$offset");
        $decodedResponse = json_decode($response->getBody()->getContents(), true);

        foreach ($decodedResponse['results'] as $pokemonData) {
            if ($count >= $limit) {
                break;
            }
            $pokemon = new Pokemon();
            $pokemon->setName($pokemonData['name'])
                ->setUrl($pokemonData['url']);

            $pokemonDetailsResponse = $client->request('GET', $pokemonData['url']);
            $pokemonDetailsData = json_decode($pokemonDetailsResponse->getBody()->getContents(), true);

            $pokemon->setImage($pokemonDetailsData['sprites']['front_default']);

            $allPokemon[] = $pokemon;
            $count++;
        }

        return $allPokemon;
    }
}
