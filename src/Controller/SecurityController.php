<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\HourlyRepository;
use App\Repository\InformationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    
    /**
     * Cette fonction permet de se connecter
     *
     * @param AuthenticationUtils $authenticationUtils
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @return Response
     */
    #[Route('/connexion', name: 'security.login', methods:['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils, 
    InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
    {

        //Repository pour afficher les variables dans le foote
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();
 
        return $this->render('pages/security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }

    
    /**
     * Cette fonction permet de se déconnecter
     *
     * @return void
     */
    #[Route('/deconnexion', name: 'security.logout')]
    public function logout()
    {
        //Nothing to do here..
    }


    
}
