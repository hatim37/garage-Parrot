<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use App\Repository\HourlyRepository;
use App\Repository\InformationRepository;
use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    
    #[Route('/', name: 'home.index', methods: ['GET'])]
    public function index(ServiceRepository $serviceRepository, InformationRepository $informationRepository,
     HourlyRepository $hourlyRepository, CommentRepository $commentRepository): Response
    {

        //On récupère les commentaires pour les afficher dans la page d'accueil
        $comment = $commentRepository->findAll();

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();
        $service = $serviceRepository->findAll();

        return $this->render('pages/home.html.twig', [
            'service' => $service,
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
            'comment'=> $comment,
        ]);
    }
}
