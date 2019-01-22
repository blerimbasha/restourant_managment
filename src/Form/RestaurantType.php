<?php

namespace App\Form;

use App\Entity\Regions;
use App\Entity\Restaurant;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\BooleanType;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('userId')
            ->add('hall1')
            ->add('hall2')
            ->add('region', EntityType::class, [
                'class' => Regions::class,
                'choice_label' => function ($regions) {
                return $regions->getName();
                }
            ])
            ->add('active', CheckboxType::class)
            ->add('comment')
            ->add('submit', SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-primary pull-right'
                ]
            ])
        ;
    }

    private $router;
    public function __construct(UserRepository $userRepository, RouterInterface $router)
    {
        $this->router = $router;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class
        ]);
    }
}
