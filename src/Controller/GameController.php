<?php

namespace App\Controller;

use App\Entity\Game;

use App\Form\GameType;
use App\Repository\PokemonRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GameController extends AbstractController
{

    #[Route('/game/level', name: 'app_game_choose')]
    public function index(PokemonRepository      $pokemonRepository,
                          Request                $request,
                          EntityManagerInterface $entityManager,

    ): Response
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($form->get('difficulty')->getData() == 1) {
                $game->setNumberOfCards(4);
                $numberOfPokemons = 2;
            } elseif ($form->get('difficulty')->getData() == 2) {
                $game->setNumberOfCards(16);
                $numberOfPokemons = 8;
            } elseif ($form->get('difficulty')->getData() == 3) {
                $game->setNumberOfCards(36);
                $numberOfPokemons = 18;
            }
            for ($i = 0; $i < $numberOfPokemons; $i++) {
                $pokemon = $pokemonRepository->findOneBy(['id' => rand(1, 18)]);
                $game->addPokemon($pokemon);
                $entityManager->persist($game);
            }
            $game->setPlayer($this->getUser());
            $game->setPoints(0);
            $game->setNumberofAttempts(0);
            $game->setStatus('en cours');
            $entityManager->persist($game);
            $entityManager->flush();

            return $this->redirectToRoute('app_game_play', ['id' => $game->getId()]);
        }
        return $this->render('game/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/game/play/{id}', name: 'app_game_play')]
    public function startGame(Game $game)
    {
         $chosenPokemon = $game->getPokemon()->toArray();
         $pokemonDuplicates = $game->getPokemon()->toArray();
         shuffle($pokemonDuplicates);
//         dd($chosenPokemon);

        return $this->render('game/play.html.twig', [
            'game' => $game,
            'chosenPokemon' => $chosenPokemon,
            'pokemonDuplicates' => $pokemonDuplicates,
        ]);
    }
}
