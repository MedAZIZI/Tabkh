<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RecetteType;
use App\Entity\Recettes;


class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        if ($this->getUser()) {
            $username = $this->getUser()->getPrenom() . ' ' . $this->getUser()->getNom();
        }
        return $this->render('profil/profil.html.twig', [
            'user' => $this->getUser(),
            'username' => $username ?? null
        ]);
    }

    #[Route('/Add', name: 'rec_add')]
    public function add(Request $request,EntityManagerInterface $entityManager): Response
    {
        $Recettes = new Recettes();
        $form = $this->createForm(RecetteType::class, $Recettes);

        $form->handleRequest($request);
       
        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrez les données dans la base de données, par exemple
            $entityManager->persist($Recettes);
            $entityManager->flush();

            // Redirigez vers la page d'affichage ou effectuez d'autres actions
            return $this->redirectToRoute('app_rec', ['id' => $Recettes->getId()]);
        }

        if ($this->getUser()) {
            $username = $this->getUser()->getPrenom() . ' ' . $this->getUser()->getNom();
        }
        return $this->render('Recette/AddRecc.html.twig', [
            'form' => $form->createView(),
            'user' => $this->getUser(),
            'username' => $username ?? null
        ]);
    }
    

}
