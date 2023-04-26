<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Client;
use App\Entity\Devis;
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

use Symfony\Component\HttpFoundation\Session\Session;

class ClientDevisCreationController extends AbstractController
{
    #[Route('/client/devis/creation', name: 'app_client_devis_creation')]
    public function index(Request $request, ManagerRegistry $doctrine): Response
    {

        $req = Request::createFromGlobals();
        $session = $request->getSession();
        
        $typeclient= $session->get('p');
        $typehaie= $session->get('t');
        $longueur= $session->get('l');
        $hauteur= $session->get('h');

      $maHaie = $doctrine->getRepository(Haie::class)->find($typehaie);


    
        $client = new Client();
        $form = $this->createFormBuilder($client)
        ->add('nom', TextType::class, array('label'=>'nom'))
        ->add('prenom', TextType::class, array('label'=>'prenom'))
        ->add('adresse', TextType::class, array('label'=>'adresse'))
        ->add('ville', TextType::class, array('label'=>'ville'))
        ->add('cp', TextType::class, array('label'=>'cp'))
        ->add('save', SubmitType::class, array('label' => 'GENERER'))
        ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();

            $client->setTypeClient($typeclient);

            $entityManager->persist($client);
            $entityManager->flush();

            $devis = new Devis();
            $devis->setClient($client);
            $devis->setHaie($maHaie);
            $devis->setLongueur($longueur);
            $devis->setHauteur($hauteur);
            $devis->setDate(new \DateTime());

            $entityManager->persist($devis);
            $entityManager->flush();
            

            return $this->redirectToRoute('app_accueil', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('client_devis_creation/index.html.twig', 
        array('form' => $form->createView())
        );
    }
}
