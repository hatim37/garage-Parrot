<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\CommentRepository;
use App\Repository\HourlyRepository;
use App\Repository\InformationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    
    
    /**
     * Cette fonction permet d'afficher les commentaires
     *
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @param CommentRepository $commentRepository
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/commentaire', name: 'comment.index')]
    public function index(InformationRepository $informationRepository,
     HourlyRepository $hourlyRepository, CommentRepository $commentRepository, Request $request, 
     PaginatorInterface $paginator): Response
    {
        //On récupère les liste des commentaires et on utilise la pagination pour l'affichage
        $comment = $paginator->paginate(
            $commentRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();


        return $this->render('pages/comment/index.html.twig', [
            'comment'=> $comment,
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }

    
    /**
     * Cette fonction permet de créer un commentaire
     *
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/commentaire/creation', name: 'comment.new', methods: ['GET', 'POST'])]
    public function new(InformationRepository $informationRepository,
     HourlyRepository $hourlyRepository, Request $request, EntityManagerInterface $manager): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $comment = $form->getData();
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre commentaire a été créé avec succès, il sera soumis à modération dans les plus brefs délais.'
            );

            return $this->redirectToRoute('home.index');
        }

        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/comment/new.html.twig', [
           
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
            'form' => $form->createView(),
        ]);
    }

    
    
    /**
     * Cette fonction permet de modifier un commentaire
     *
     * @param Comment $comment
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param InformationRepository $informationRepository
     * @param HourlyRepository $hourlyRepository
     * @return Response
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/commentaire/edition/{id}', name: 'comment.edit', methods: ['GET', 'POST'])]
    public function edit(Comment $comment, Request $request, EntityManagerInterface $manager,
     InformationRepository $informationRepository, HourlyRepository $hourlyRepository): Response
    {
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $comment = $form->getData();
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre commentaire a été modifié avec succès !'
            );

            return $this->redirectToRoute('comment.index');
        }
        
        //repository pour afficher les variables dans le footer
        $informationRepository = $informationRepository->findAll();
        $hourlyRepository = $hourlyRepository->findAll();

        return $this->render('pages/comment/edit.html.twig', [
            'form' => $form->createView(),
            'comment' => $comment,
            'information' => $informationRepository,
            'horaire' => $hourlyRepository,
        ]);
    }


    
    /**
     * Cette fonction permet de supprimer un commentaire
     *
     * @param EntityManagerInterface $manager
     * @param Comment $comment
     * @return Response
     */
    #[IsGranted('ROLE_USER')]
    #[Route('/commentaire/suppression/{id}', name: 'comment.delete', methods: ['GET'])]
    public function delete(EntityManagerInterface $manager, Comment $comment): Response
    {
        
        //On supprime l'annonce
        $manager->remove($comment);
        $manager->flush();

        //message flash
        $this->addFlash(
            'success',
            'Votre commentaire a été supprimé avec succès !'
        );

        return $this->redirectToRoute('comment.index');
    }

}
