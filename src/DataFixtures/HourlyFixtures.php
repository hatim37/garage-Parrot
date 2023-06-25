<?php

namespace App\DataFixtures;

use App\Entity\Hourly;
use App\Entity\Information;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


class HourlyFixtures extends Fixture
{ 
    private Generator $faker;
   
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
       
        $faker = (new \Faker\Factory())::create();



        //horaire
        $horaire1 = new Hourly;
        $horaire1->setDay('Lundi')
         ->setTimeStartMorning('09h')
         ->setTimeEndMorning('12h')
         ->setTimeStartAfternoon('14h')
         ->setTimeEndAfternoon('18h');
         $manager->persist($horaire1);

         $horaire2 = new Hourly;
        $horaire2->setDay('Mardi')
         ->setTimeStartMorning('09h')
         ->setTimeEndMorning('12h')
         ->setTimeStartAfternoon('14h')
         ->setTimeEndAfternoon('18h');
         $manager->persist($horaire2);

         $horaire3 = new Hourly;
         $horaire3->setDay('Mercredi')
          ->setTimeStartMorning('09h')
          ->setTimeEndMorning('12h')
          ->setTimeStartAfternoon('14h')
          ->setTimeEndAfternoon('18h');
          $manager->persist($horaire3);

          $horaire4 = new Hourly;
        $horaire4->setDay('Jeudi')
         ->setTimeStartMorning('09h')
         ->setTimeEndMorning('12h')
         ->setTimeStartAfternoon('14h')
         ->setTimeEndAfternoon('18h');
         $manager->persist($horaire4);

         $horaire5 = new Hourly;
        $horaire5->setDay('Vendredi')
         ->setTimeStartMorning('09h')
         ->setTimeEndMorning('12h')
         ->setTimeStartAfternoon('14h')
         ->setTimeEndAfternoon('18h');
         $manager->persist($horaire5);

         $horaire6 = new Hourly;
        $horaire6->setDay('Samedi')
         ->setTimeStartMorning('09h')
         ->setTimeEndMorning('12h')
         ->setCloseAfternoon(true);
         $manager->persist($horaire6);

         $horaire6 = new Hourly;
        $horaire6->setDay('Dimanche')
         ->setCloseMorning(true)
         ->setCloseAfternoon(true);
         $manager->persist($horaire6);


         //information

         $information = new Information;
         $information->setName('Garage V.Parrot')
             ->setPhone($this->faker->phoneNumber())
             ->setEmail('v.parrot@garage.com')
             ->setstreet($this->faker->streetAddress())
             ->setcity($this->faker->postcode().' '.$this->faker->city());
             $manager->persist($information);

             

        $manager->flush();
   }
}