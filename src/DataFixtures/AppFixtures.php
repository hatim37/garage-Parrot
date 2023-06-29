<?php

namespace App\DataFixtures;

use App\Entity\Car;
use App\Entity\Equipment;
use App\Entity\Images;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


class AppFixtures extends Fixture
{ 
    private Generator $faker;
   
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
       
        $faker = (new \Faker\Factory())::create();

       

        //Users
        $users = [];

        $admin = new User();
        $admin->setName('Administrateur')
            ->setFirstName('admin')
            ->SetEmail('admin@garage.fr')
            ->setRoles(['ROLE_ADMIN'])
            ->setPlainPassword('password');

        $users[] = $admin;
        $manager->persist($admin);
        

        $manager->flush();
   }
}
