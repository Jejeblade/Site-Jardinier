<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom' , TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('prenom', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('adresse', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('ville', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('cp', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('type_client', TextType::class, array('attr' => ['class' => 'form-mid']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
