<?php

namespace App\DataFixtures;


use App\Entity\Equipment;
use App\Entity\Images;
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



        //Images
        $images = [];
     
        $image1 = new Images();
        $image1->setName('annonce1.jpg');
        $manager->persist($image1);
        $image2 = new Images();
        $image2->setName('annonce2.jpg');
        $manager->persist($image2);
        $image3 = new Images();
        $image3->setName('annonce3.jpg');
        $manager->persist($image3);
        $image4 = new Images();
        $image4->setName('annonce4.jpg');
        $manager->persist($image4);
        $image5 = new Images();
        $image5->setName('annonce5.jpg');
        $manager->persist($image5);
        $image6 = new Images();
        $image6->setName('annonce6.jpg');
        $manager->persist($image6);
        $image7 = new Images();
        $image7->setName('annonce7.jpg');
        $manager->persist($image7);
        $image8 = new Images();
        $image8->setName('annonce8.jpg');
        $manager->persist($image8);
        $image9 = new Images();
        $image9->setName('annonce9.jpg');
        $manager->persist($image9);
        $image10 = new Images();
        $image10->setName('annonce10.jpg');
        $manager->persist($image10);
        $image11 = new Images();
        $image11->setName('annonce11.jpg');
        $manager->persist($image11);
        $image12 = new Images();
        $image12->setName('annonce12.jpg');
        $manager->persist($image12);
        $image13 = new Images();
        $image13->setName('annonce13.jpg');
        $manager->persist($image13);
        $image14 = new Images();
        $image14->setName('annonce14.jpg');
        $manager->persist($image14);
        $image15 = new Images();
        $image15->setName('annonce15.jpg');
        $manager->persist($image15);    
        $image16 = new Images();
        $image16->setName('annonce16.jpg');
        $manager->persist($image16);
        $image17 = new Images();
        $image17->setName('annonce17.jpg');
        $manager->persist($image17);
        $image18 = new Images();
        $image18->setName('annonce18.jpg');
        $manager->persist($image18);
        $image19 = new Images();
        $image19->setName('annonce19.jpg');
        $manager->persist($image19);
        $image20 = new Images();
        $image20->setName('annonce20.jpg');
        $manager->persist($image20);
        $image21 = new Images();
        $image21->setName('annonce21.jpg');
        $manager->persist($image21);
        $image22 = new Images();
        $image22->setName('annonce22.jpg');
        $manager->persist($image22);
        $image23 = new Images();
        $image23->setName('annonce23.jpg');
        $manager->persist($image23);
        $image24 = new Images();
        $image24->setName('annonce24.jpg');
        $manager->persist($image24);
        $image25 = new Images();
        $image25->setName('annonce25.jpg');
        $manager->persist($image25);
        $image26 = new Images();
        $image26->setName('annonce26.jpg');
        $manager->persist($image26);
        $image27 = new Images();
        $image27->setName('annonce27.jpg');
        $manager->persist($image27);
        $image28 = new Images();
        $image28->setName('annonce28.jpg');
        $manager->persist($image28);
        $image29 = new Images();
        $image29->setName('annonce29.jpg');
        $manager->persist($image29);
        $image30 = new Images();
        $image30->setName('annonce30.jpg');
        $manager->persist($image30);
        $image31 = new Images();
        $image31->setName('annonce31.jpg');
        $manager->persist($image31);
        $image32 = new Images();
        $image32->setName('annonce32.jpg');
        $manager->persist($image32);
        $image33 = new Images();
        $image33->setName('annonce33.jpg');
        $manager->persist($image33);
        $image34 = new Images();
        $image34->setName('annonce34.jpg');
        $manager->persist($image34);
        $image35 = new Images();
        $image35->setName('annonce35.jpg');
        $manager->persist($image35);
        $image36 = new Images();
        $image36->setName('annonce36.jpg');
        $manager->persist($image36);
        $image37 = new Images();
        $image37->setName('annonce37.jpg');
        $manager->persist($image37);
        $image38 = new Images();
        $image38->setName('annonce38.jpg');
        $manager->persist($image38);
        $image39 = new Images();
        $image39->setName('annonce39.jpg');
        $manager->persist($image39);
        $image40 = new Images();
        $image40->setName('annonce40.jpg');
        $manager->persist($image40);
        $image41 = new Images();
        $image41->setName('annonce41.jpg');
        $manager->persist($image41);
        $image42 = new Images();
        $image42->setName('annonce42.jpg');
        $manager->persist($image42);


        //Equipment

        $equipment1 = new Equipment();
        $equipment1->setName('Direction assistée');
        $manager->persist($equipment1);
        $equipment2 = new Equipment();
        $equipment2->setName('ESP');
        $manager->persist($equipment2);
        $equipment3 = new Equipment();
        $equipment3->setName('Jantes Alu');
        $manager->persist($equipment3);
        $equipment4 = new Equipment();
        $equipment4->setName('Ordinateur de bord');
        $manager->persist($equipment4);
        $equipment5 = new Equipment();
        $equipment5->setName('Régulateur de vitesse');
        $manager->persist($equipment5);
        $equipment6 = new Equipment();
        $equipment6->setName('Sellerie cuir');
        $manager->persist($equipment6);
        $equipment7 = new Equipment();
        $equipment7->setName('ABS');
        $manager->persist($equipment7);
        $equipment8 = new Equipment();
        $equipment8->setName('Détecteur de pluie');
        $manager->persist($equipment8);
        $equipment9 = new Equipment();
        $equipment9->setName('Limiteur de vitesse');
        $manager->persist($equipment9);
        $equipment10 = new Equipment();
        $equipment10->setName('Détecteur de sous-gonflage');
        $manager->persist($equipment10);
        $equipment11 = new Equipment();
        $equipment11->setName('Volant multifonction');
        $manager->persist($equipment11);
        $equipment12 = new Equipment();
        $equipment12->setName('Ecran tactile');
        $manager->persist($equipment12);
        

        

        $manager->flush();
   }
}
