<?php

namespace App\Form;

use App\Entity\Haie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HaieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('nom', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('prix', TextType::class, array('attr' => ['class' => 'form-mid']))
            ->add('categorie', EntityType::class, ['class' => 'App\Entity\Categorie', 'attr' => ['class' => 'form-mid'], 'choice_label' => 'libelle'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Haie::class,
        ]);
    }
}
