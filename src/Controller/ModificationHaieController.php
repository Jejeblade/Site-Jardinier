<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\nomClasseMetier;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Haie;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModificationHaieController extends AbstractController
{
    #[Route('/modification/haie', name: 'app_modification_haie')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {
        $request = Request::createFromGlobals();
        $code = $request->get('code');

        $entityManager = $doctrine->getManager();

        $mahaie = new Haie();

        $mahaie = $doctrine->getRepository(Haie::class)->find($code);

        $form = $this->createFormBuilder($mahaie)
        ->add('code', TextType::class, array('label'=>'Code haie'))
        ->add('nom', TextType::class, array('label'=>'Nom haie'))
        ->add('prix', NumberType::class, array('label'=>'Tarif haie', 'invalid_message'=>'Saisir un nombre'))
        ->add('save', SubmitType::class, array('label' => 'Modifer'))
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($mahaie);
            $entityManager->flush();
        }
 

        return $this->render('modification_haie/index.html.twig', 
            array('form' => $form->createView())
        );
    }
}
