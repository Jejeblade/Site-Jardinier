<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\Haie;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesureController extends AbstractController
{
    #[Route('/mesure', name: 'app_mesure')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $mesHaie = $doctrine->getRepository(Haie::class)->findAll();

        $request = Request::createFromGlobals();
        $session = new Session();
        $choix=$request->get('feur');
        $p= $session->set('p', $choix);
        return $this->render('mesure/index.html.twig', [
            'controller_name' => 'MesureController',
            'mesHaie' => $mesHaie,
        ]);
    }
}
