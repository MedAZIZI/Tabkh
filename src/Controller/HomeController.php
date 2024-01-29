<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Recettes;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()) {
            $username = $this->getUser()->getPrenom() . ' ' . $this->getUser()->getNom();
        }
        $recette = $entityManager->getRepository(Recettes::class)->findAll();

        // $dataArray = [];
        // foreach ($recette as $item) {
        //     $dataArray[] = [
        //         'Id' => $item->getId(),
        //         'Title' => $item->getTitle(),
        //         'Description'=> $item->getDescription(),
        //         'image' => $item->getImageSrc(),
        //     ];
        // }

        // Convertire  les données en JSON
        // $jsonContent = json_encode($dataArray, JSON_PRETTY_PRINT);

        // // Save JSON to a file (adjust the path as needed)
        // $filePath = $this->getParameter('kernel.project_dir') . '/assets/data/list-rec.json';
        // file_put_contents($filePath, $jsonContent);

        $recettes = $entityManager->getRepository(Recettes::class)->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'username' => $username ?? null,
            'recettes' => $recettes
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
    #[Route('/recette/liste', name: 'list_recette')]
    public function List(EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()) {
            $username = $this->getUser()->getPrenom() . ' ' . $this->getUser()->getNom();
        }
        $recette = $entityManager->getRepository(Recettes::class)->findAll();
        return $this->render('Recette/list.html.twig', [
            'controller_name' => 'ListController',
            'username' => $username ?? null,
            'recettes' => $recette,

        ]);
    }
    // #[Route('/JsonDATA', name: 'json_rec')]
    // public function JsonDATA(EntityManagerInterface $entityManager): JsonResponse
    // {
    //     $recette = $entityManager->getRepository(Recettes::class)->findAll();

    //     $dataArray = [];
    //     foreach ($recette as $item) {
    //         $dataArray[] = [
    //             'Id' => $item->getId(),
    //             'Title' => $item->getTitle(),
    //             'Description' => $item->getDescription(),
    //             'image' => $item->getImageSrc(),
    //         ];
    //     }


    //     return new JsonResponse($dataArray);
    // }  
    #[Route('/JsonDATA/{page}', name: 'json_data')]
    public function jsonData(int $page = 1, EntityManagerInterface $entityManager): JsonResponse
    {
        $pageSize = 2; // Number of items per page
        $offset = ($page - 1) * $pageSize;

        $recettes = $entityManager->getRepository(Recettes::class)
            ->findBy([], null, $pageSize, $offset);

        $dataArray = [];
        foreach ($recettes as $item) {
            $dataArray[] = [
                'Id' => $item->getId(),
                'Title' => $item->getTitle(),
                'Description' => $item->getDescription(),
                'image' => $item->getImageSrc(),
            ];
        }

        return new JsonResponse($dataArray);
    }

    #[Route('/recette/{id}', name: 'app_rec')] ///{id}
    public function Recette(EntityManagerInterface $entityManager, int $id): Response
    {
        if ($this->getUser()) {
            $username = $this->getUser()->getPrenom() . ' ' . $this->getUser()->getNom();
        }
        $recette = $entityManager->getRepository(Recettes::class)->find($id);

        if (!$recette) {
            throw $this->createNotFoundException(
                'No recette found for id ' . $id
            );
        }

        $recette_ing = $recette->parseIngredient($recette->getIngredients());
        $recette_ing = array_filter($recette_ing, function ($value) {
            return $value !== null;
        });
        $recette_step = $recette->parseEtapes($recette->getEtapes());
        $recette_step = array_filter($recette_step, function ($value) {
            return $value !== null;
        });
        return $this->render('Recette/Recette.html.twig', [
            'controller_name' => 'RecetteController',
            'username' => $username ?? null,
            'recette' => $recette,
            'recette_ing' => $recette_ing,
            'recette_step' => $recette_step

        ]);
    }

}
