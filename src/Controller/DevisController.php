<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\Haie;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevisController extends AbstractController
{
    #[Route('/devis', name: 'app_devis')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $request = Request::createFromGlobals();
        $session = new Session();
        $longueur=$request->get('longueur');
        $hauteur=$request->get('hauteur');
        $type=$request->get('type');
        $choix= $session->get('p');

        $l= $session->set('l', $longueur);
        $h= $session->set('h', $hauteur);
        $t= $session->set('t', $type);

        $maHaie = $doctrine->getRepository(Haie::class)->find($type);


        return $this->render('devis/index.html.twig', [
            'controller_name' => 'DevisController',
            'longueur'=>$longueur,
            'hauteur'=>$hauteur,
            'choix'=>$choix,
            'maHaie'=>$maHaie
        ]);
    }
}
