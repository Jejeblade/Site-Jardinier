<?php

namespace App\Form;

use App\Entity\Devis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('longueur', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('hauteur', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('client', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('haie', TextType::class, array('attr' => ['class' => 'form-mid']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
