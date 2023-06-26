<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;


class CommentFixtures extends Fixture
{ 
    private Generator $faker;
   
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }

    public function load(ObjectManager $manager): void
    {
       
        $faker = (new \Faker\Factory())::create();

        //comment

        $comments =[];
        for ($i=0; $i < 10; $i++) {
            $comment = new Comment();
            $comment->setName($this->faker->name())
                ->setMessage($this->faker->realText())
                ->setNote(mt_rand(1, 5))
                ->setIsApproved(mt_rand(0, 1) === 0 ? 'Non' : 'Oui');
        
        
            $comments[] = $comment;
            $manager->persist($comment);
        }
        

        $manager->flush();
   }
}