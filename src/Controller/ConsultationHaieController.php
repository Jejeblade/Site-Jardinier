<?php

namespace App\Controller;
use App\Entity\Haie;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConsultationHaieController extends AbstractController
{
    #[Route('/consultation/haie', name: 'app_consultation_haie')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $mesHaie = $doctrine->getRepository(Haie::class)->findAll();

        return $this->render('consultation_haie/index.html.twig', [
            'controller_name' => 'ConsultationHaieController',
            'mesHaie' => $mesHaie,
        ]);
    }
}
