<?php

namespace App\Form;

use App\Entity\Regions;
use App\Entity\Restaurant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
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
            ->add('region', EntityType::class, [
                    'attr' => [
                        'class' => 'select2'
                    ],
                'class' => Regions::class,
                'choice_label' => function($regions) {
                return $regions->getName();
                },
                'placeholder' => 'Select Region',
                'required' => false
            ])
            ->add('from_date', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
//                'data' => new \DateTime("now")
            ])
            ->add('to_date', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
//                'data' => new \DateTime("now")
            ])
            ->add('period', ChoiceType::class,[
                'required' => false,
                'choices' => [
                    'All Day' => '3',
                    'Day' => '0',
                    'Night' => '1',
                ],
                'data' => '3',
            ])
            ->add('reserved', CheckboxType::class,[
                'required' => false,
                'error_bubbling' => true,
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
