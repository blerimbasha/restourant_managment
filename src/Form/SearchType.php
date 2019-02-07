<?php

namespace App\Form;

use App\Entity\Regions;
use App\Entity\Restaurant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setMethod('GET')
            ->add('name', TextType::class, [
                'attr' =>  [
                    'placeholder' => 'Search...'
                ],
                'required' => false
            ])
//            ->add('hall_1')
//            ->add('hall_2')
//            ->add('active')
//            ->add('comment')
//            ->add('create_date')
//            ->add('menu')
//            ->add('cover_path')
//            ->add('image_1')
//            ->add('image_2')
//            ->add('image_3')
//            ->add('image_4')
//            ->add('userId')
            ->add('region', EntityType::class, [
                'attr' => [
                    'class' => 'select2 select22'
                ],
                'class' => Regions::class,
                'choice_label' => function($regions) {
                return $regions->getName();
                }
            ])
        ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
//            'data_class' => Restaurant::class,
        ]);
    }
}
