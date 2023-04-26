<?php

namespace App\Controller;

use App\Entity\Categorie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\nomClasseMetier;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Haie;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CreerHaieController extends AbstractController
{
    #[Route('/creer/haie', name: 'app_creer_haie')]
    public function index(Request $request, ManagerRegistry $doctrine ): Response
    {
        $haie = new Haie();
        $form = $this->createFormBuilder($haie)
        ->add('code', TextType::class, array('label'=>'Code haie'))
        ->add('nom', TextType::class, array('label'=>'Nom haie'))
        ->add('prix', NumberType::class, array('label'=>'Tarif haie', 'invalid_message'=>'Saisir un nombre'))
        ->add('categorie', EntityType::class,[
            'label'=>'Categorie haie',
            'class'=>Categorie::class,
            'choice_label'=>'libelle'
        ])
        ->add('save', SubmitType::class, array('label' => 'AJOUTER'))
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();

            $entityManager->persist($haie);
            $entityManager->flush();
            return $this->redirectToRoute('app_consultation_haie', [], Response::HTTP_SEE_OTHER);
        }
 
        return $this->render('creer_haie/index.html.twig', 
            array('form' => $form->createView())
        );
    }
}
