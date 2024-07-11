<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Service\PokemonDataService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pokemon')]
class PokemonController extends AbstractController
{

    public function __construct(
        private readonly PokemonDataService     $pokemonDataService,
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    #[Route('/', name: 'app_pokemon_index', methods: ['GET'])]
    public function getAllPokemon(): Response
    {
        $allPokemon = $this->pokemonDataService->getAllPokemon();
        foreach ($allPokemon as $pokemon) {
            $registeredPokemon = $this->entityManager->getRepository(Pokemon::class)->findOneBy(['name' => $pokemon->getName()]);

            if (!$registeredPokemon) {
                $this->entityManager->persist($pokemon);
            }
        }
        $this->entityManager->flush();

        return $this->render('pokemon/index.html.twig', [
            'allPokemon' => $allPokemon,
        ]);
    }

//    #[Route('/detail/{id}', name: 'app_pokemon_info')]
//    public function getPokemonInfo(int $id): Response
//    {
//
//        $pokemonInfo = $this->pokemonDataService->getPokemonByInfo($id);
//
//        return $this->render('pokemon/detail.html.twig', [
//            'pokemonInfo' => $pokemonInfo,
//        ]);
//    }
}
