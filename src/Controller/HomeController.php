<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        if ($this->getUser()) {
            $username = $this->getUser()->getPrenom() . ' ' . $this->getUser()->getNom();
        }
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'username' => $username ?? null
        ]);
    }
    #[Route('/About', name: 'app_about')]
    public function About(): Response
    {
        if ($this->getUser()) {
            $username = $this->getUser()->getPrenom() . ' ' . $this->getUser()->getNom();
        }
        return $this->render('home/About.html.twig', [
            'controller_name' => 'AboutController',
            'username' => $username ?? null
        ]);
    }
    #[Route('/Cat', name: 'app_cat')]
    public function Cat(): Response
    {
        if ($this->getUser()) {
            $username = $this->getUser()->getPrenom() . ' ' . $this->getUser()->getNom();
        }
        return $this->render('Cat/Cat.html.twig', [
            'controller_name' => 'HomeController',
            'username' => $username ?? null
        ]);
    }

    #[Route('/recette', name: 'app_rec')]
    public function Recette(): Response
    {
        if ($this->getUser()) {
            $username = $this->getUser()->getPrenom() . ' ' . $this->getUser()->getNom();
        }
        $recette = [
            'title' => 'CHARLOTTE AUX ABRICOTS',
            'description' => 'Une charlotte abricot fraîche, légère avec le fromage blanc, simple à préparer et sans cuisson',
            'ingredient' => ['150 g dabricots secs', '  7 cuillerées à soupe de sucre en poudre', ' 1 sachet de sucre vanillé', ' 20 g de Maïzena (2 c à soupe rases)', ' 1/4 de litre de lait, 1 oeuf', ' 1 jaune d oeuf', 'facultatif: fruits confits.'],
        ];
        return $this->render('Recette/Recette.html.twig', [
            'controller_name' => 'RecetteController',
            'username' => $username ?? null,
            'recette' => $recette

        ]);
    }
}
