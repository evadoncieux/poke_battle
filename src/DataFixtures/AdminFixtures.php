<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AdminFixtures extends Fixture implements OrderedFixtureInterface
{ 
    private UserPasswordHasherInterface $hasher;
    
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $date = new \DateTimeImmutable();

        $admin = new Admin();
        $admin->setPseudo("Administrateur")
        ->setUsername('admin')
        ->setEmail('admin@poke-battle.com')
        ->setPassword($this->hasher->hashPassword($admin, "admin"))
        ->setRoles(["ROLE_ADMIN"])
        ->setCreatedAt($date)
        ->setUpdateAt($date);
        $manager->persist($admin);

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
