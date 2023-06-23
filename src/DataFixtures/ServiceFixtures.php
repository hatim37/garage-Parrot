<?php

namespace App\DataFixtures;

use App\Entity\Service;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


class ServiceFixtures extends Fixture
{ 
    private Generator $faker;
   
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
       
        $faker = (new \Faker\Factory())::create();


         //Service

         $service1 = new Service();
         $service1->setName('Entretien');
         $manager->persist($service1);
 
         $service1 = new Service();
         $service1->setName('Vidange');
         $manager->persist($service1);
 
         $service1 = new Service();
         $service1->setName('Diagnostic');
         $manager->persist($service1);
 
         $service1 = new Service();
         $service1->setName('Réparation');
         $manager->persist($service1);
 
         $service1 = new Service();
         $service1->setName('Pneumatique');
         $manager->persist($service1);
 
         $service1 = new Service();
         $service1->setName('Pare-brise');
         $manager->persist($service1);
 
         $service1 = new Service();
         $service1->setName('Climatisation');
         $manager->persist($service1);
 
         $service1 = new Service();
         $service1->setName('Dépannage');
         $manager->persist($service1);
 
         $service1 = new Service();
         $service1->setName('Réparation d’embrayage');
         $manager->persist($service1);
 
         $service1 = new Service();
         $service1->setName('Révision moteur');
         $manager->persist($service1);
 
         $service1 = new Service();
         $service1->setName('Distribution');
         $manager->persist($service1);
        

        $manager->flush();
   }
}