<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Images;
use App\Entity\PropertySearch;
use App\Form\CarType;
use App\Form\PropertySearchType;
use App\Repository\CarRepository;
use App\Repository\ImagesRepository;
use App\Service\PictureService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarController extends AbstractController
{
    

    #[Route('/voiture', name: 'car.index')]
    public function index(CarRepository $repository, Request $request): Response
    {
      //On créer le formulaire de recherche
      $search = new PropertySearch();
      $form = $this->createForm(PropertySearchType::class, $search);
      $form->handleRequest($request);

      // On définit le nombre d'éléments par page
      $limit = 6;

      // On récupère le numéro de page
      $page = (int)$request->query->get("page", 1);

      // On récupère les annonces de la page en fonction du filtre
      $car = $repository->findBySearch($search, $page, $limit);
      
      // On récupère le nombre total d'annonces
      $total = $repository->getTotalAnnonces($search);

      //si on a une requete ajax, on modifie uniquement la partie "content"
      if($request->get('ajax')) {
          return new JsonResponse([
              'content' => $this->renderView('pages/car/_content.html.twig', [
                'car' => $car,
               'total'=> $total,
               'limit'=> $limit,
                'page' => $page,
              ])
          ]);
      }

      //si on a une requete classique
      return $this->render('pages/car/index.html.twig', [
          'car' => $car,
          'total'=> $total,
          'limit'=> $limit,
          'page' => $page,
          'form'=> $form->createView(),
      ]);

    }


    #[Route('/voiture/creation', name: 'car.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager, PictureService $pictureService): Response
    {
        $car = new Car();
        $form = $this->createForm(CarType::class, $car);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère les images
            $images = $form->get('images')->getData();
            
            foreach($images as $image){
                //on definit le dossier de destination
                $folder = 'car';

                //on appelle le service d'ajout
                $fichier = $pictureService->add($image, $folder);

                $img = new Images();
                $img->setName($fichier);
                $car->addImage($img);
            }

            $car = $form->getData();
            $manager->persist($car);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre annonce a été créé avec succès !'
            );

            return $this->redirectToRoute('car.index');
        }

        return $this->render('pages/car/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    
    #[Route('/voiture/edition/{id}', name:'car.edit', methods: ['GET', 'POST'])]
    public function edit(car $car, Request $request, EntityManagerInterface $manager, PictureService $pictureService, ImagesRepository $imagesRepository): Response 
    {

        $image = $imagesRepository->RemoveAllImageCar($car->getId());
            
        $form = $this->createForm(CarType::class, $car,  ['required' => $image ? false : true]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //on récupère les images
            $images = $form->get('images')->getData();
            
            foreach($images as $image){
                //on definit le dossier de destination
                $folder = 'car';

                //on appelle le service d'ajout
                $fichier = $pictureService->add($image, $folder);

                $img = new Images();
                $img->setName($fichier);
                $car->addImage($img);
            }
            
            $car = $form->getData();

            $manager->persist($car);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre annonce a été modifié avec succès !'
            );

            return $this->redirectToRoute('car.index');
        }

        return $this->render('pages/car/edit.html.twig', [
            'form' => $form->createView(),
            'car' => $car,
        ]);
    }

    

    #[Route('/voiture/suppression/{id}', name: 'car.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Car $car,
     ImagesRepository $imagesRepository, Images $images, PictureService $pictureService): Response
    {
        
        //On récupère le nom des images qui appartienent à cette annonce
        $image = $imagesRepository->RemoveAllImageCar($car->getId());
        //dd($image);

        //On boucle sur le resultat qui est une arrayCollection 
        foreach($image as $ligne){
            // On boucle une seconde fois pour extraire uniquement la valeur 'name' 
            foreach($ligne as $cle=>$valeur){
            //On appelle le service PictureService a qui on passe le nom de l'image
                if($pictureService->delete($valeur, 'car')){
                //On supprime l'image de la base de données
                $manager->remove($images);
                $manager->flush();
                }
            }
        }

        //On supprime l'annonce
        $manager->remove($car);
        $manager->flush();

        //message flash
        $this->addFlash(
            'success',
            'Votre annonce a été supprimé avec succès !'
        );

        return $this->redirectToRoute('car.index');
    }



    #[Route('/voiture/suppression/image/{id}', name: 'car.delete_image', methods: ['DELETE'])]
    public function deleteImage(EntityManagerInterface $manager, PictureService $pictureService, Images $image, Request $request): JsonResponse
    {

        //On récupère le contenu dela requête
        $data = json_decode($request->getContent(), true);

        if($this->isCsrfTokenValid('delete' . $image->getId(), $data['_token'])){
            //le token est valide

            //on récupère le nom de l'image
            $nom = $image->getName();

            if($pictureService->delete($nom, 'car')){
                //On supprime l'image de la base de données
                $manager->remove($image);
                $manager->flush();
                return new JsonResponse(['success' => true], 200);
            }
        }

        // La suppression a échoué
        return new JsonResponse(['error' => 'Erreur de suppression'], 400);
    }


    #[Route('/voiture/{id}', name: 'car.show', methods: ['GET'])]
    public function show(car $car): Response
    {
        
        return $this->render('pages/car/show.html.twig', [
            'car' => $car
        ]);
    }

}

