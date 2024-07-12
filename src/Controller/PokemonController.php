<?php

namespace App\Controller;

use App\Entity\Pokemon;
use App\Service\PokemonDataService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;


class PokemonController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly PokemonDataService     $pokemonDataService,
    )
    {
    }

    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('default/homepage.html.twig');
    }

    #[Route('/pokemon', name: 'app_pokemon_index', methods: ['GET'])]
    public function getAllPokemon(): Response
    {
        $allPokemonCount = $this->entityManager->getRepository(Pokemon::class)->count([]);

        if ($allPokemonCount < 18) {
            $allPokemonData = $this->pokemonDataService->getAllPokemon();

            foreach ($allPokemonData as $pokemonData) {
                $registeredPokemon = $this->entityManager->getRepository(Pokemon::class)->findOneBy(['name' => $pokemonData->getName()]);

                if (!$registeredPokemon) {
                    $this->entityManager->persist($pokemonData);
                }
            }
            $this->entityManager->flush();
        }
        $allPokemon = $this->entityManager->getRepository(Pokemon::class)->findAll();

        return $this->render('pokemon/index.html.twig', [
            'allPokemon' => $allPokemon,
        ]);
    }

    #[Route('/reset', name: 'app_pokemon_reset')]
    public function resetPokemonDatabase(): RedirectResponse
    {
        $allPokemon = $this->entityManager->getRepository(Pokemon::class)->findAll();

        foreach ($allPokemon as $pokemon) {
            $this->entityManager->remove($pokemon);
        }

        $this->entityManager->flush();

        return $this->redirectToRoute('app_pokemon_index');
    }
}
