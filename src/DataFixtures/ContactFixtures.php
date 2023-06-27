<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


class ContactFixtures extends Fixture
{ 
    private Generator $faker;
   
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
       
        $faker = (new \Faker\Factory())::create();

        //Contact
        $contacts =[];
        for ($i=0; $i < 10; $i++) {
            $contact = new Contact();
            $contact->setName($this->faker->lastName())
                ->setFirstName($this->faker->firstName())
                ->setAddress($this->faker->address())
                ->setMessage($this->faker->realText())
                ->setEmail($this->faker->email())
                ->setPhone($this->faker->phoneNumber());

            $contacts[] = $contact;
            $manager->persist($contact);
        }
        

        $manager->flush();
   }
}