<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Repository\PokemonRepository;
use App\Service\PokemonDataService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class PokemonController extends AbstractController
{

    public function __construct(
        private readonly PokemonDataService  $pokemonDataService,
        private readonly SerializerInterface $serializer,
    )
    {
    }

    #[Route('/pokemon', name: 'app_pokemon')]
    public function index(): Response
    {
        $serializer = $this->serializer;
        $pokemonData = $this->pokemonDataService->getPokemon();
//        var_dump($pokemonData);

        return $this->render('pokemon/index.html.twig', [
            'pokemonData' => $pokemonData,
        ]);
    }
}
