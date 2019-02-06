<?php

namespace App\Form;

use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('hall_1')
            ->add('hall_2')
            ->add('active')
            ->add('comment')
            ->add('create_date')
            ->add('menu')
            ->add('cover_path')
            ->add('image_1')
            ->add('image_2')
            ->add('image_3')
            ->add('image_4')
            ->add('userId')
            ->add('region')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
