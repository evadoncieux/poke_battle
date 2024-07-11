<?php

namespace App\Controller;

use App\Entity\Player;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, Security $security, EntityManagerInterface $entityManager): Response
    {
        $player = new Player();
        $form = $this->createForm(RegistrationFormType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = $form->get('email')->getData();
            $username = $form->get('username')->getData();
            
            // encode the plain password
            $player->setPassword(
                    $userPasswordHasher->hashPassword(
                    $player,
                    $form->get('plainPassword')->getData()
                    )
                )
                ->setEmail($email)
                ->setUsername($username)
                ->setRoles(['ROLE_USER', 'ROLE_PLAYER'])
                ->setRank(0)
                ;

            $entityManager->persist($player);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $security->login($player, 'form_login', 'main');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
