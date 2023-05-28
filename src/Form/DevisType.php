<?php

namespace App\Form;

use App\Entity\Devis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class,['widget' => 'single_text', 'attr' => ['class' => 'form-mid']])
            ->add('longueur', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('hauteur', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('client', EntityType::class, ['class' => 'App\Entity\Client', 'attr' => ['class' => 'form-mid'], 'choice_label' => 'nom'])
            ->add('haie', EntityType::class, ['class' => 'App\Entity\Haie', 'attr' => ['class' => 'form-mid'], 'choice_label' => 'nom'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
