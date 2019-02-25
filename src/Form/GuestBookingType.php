<?php

namespace App\Form;

use App\Entity\Restaurant;
use App\Entity\User;
use App\Entity\UserNotifications;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuestBookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('mobile')
            ->add('email', EmailType::class)
            ->add('applydate', DateType::class)
            ->add('restaurantId', EntityType::class, [
                'attr' => [
                    'class' => 'select2'
                ],
                'class' => Restaurant::class,
                'choice_label' => function($restaurant) {
                    return $restaurant->getName();
                },
                'placeholder' => 'Select Restaurant',
                'required' => false
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => UserNotifications::class,
        ]);
    }
}
