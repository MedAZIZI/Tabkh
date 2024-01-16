<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use App\Form\UserAuthType;
// use App\Form\SignUpType;


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

}
