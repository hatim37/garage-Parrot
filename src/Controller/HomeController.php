<?php

namespace App\Controller;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home.index', methods: ['GET'])]
    public function index(ServiceRepository $serviceRepository): Response
    {

        $service = $serviceRepository->findAll();

        return $this->render('pages/home.html.twig', [
            'service' => $service,
        ]);
    }
}
