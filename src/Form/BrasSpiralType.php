<?php

namespace App\Form;

use App\Entity\BrasSpiral;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BrasSpiralType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Nom')
            ->add('Longueur')
            ->add('Largeur')
            ->add('Description')
            ->add('Galaxie')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BrasSpiral::class,
        ]);
    }
}
