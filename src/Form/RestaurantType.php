<?php

namespace App\Form;

use App\Entity\Regions;
use App\Entity\Restaurant;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\BooleanType;
use Doctrine\ORM\EntityRepository;
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
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
            ->add('userId', EntityType::class, [
                'attr' => [
                    'class' => 'select2'
                ],
                'class' => User::class,
                'choice_label' => function ($region) {
                    return $region->getUsername();
                }
            ])
            ->add('hall1')
            ->add('hall2')
            ->add('menu', TextareaType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'tinycme'
                ]
            ])
            ->add('region', EntityType::class, [
                'attr' => [
                    'class' => 'select2'
                ],
                'class' => Regions::class,
                'choice_label' => function ($regions) {
                    return $regions->getName();
                }
            ])
            ->add('active', CheckboxType::class, [
                'required' => false
            ])
            ->add('comment')
            ->add('coverPath', FileType::class, [
                'required' => false,
                'data_class' => null
            ])
            ->add('image1', FileType::class, [
                'required' => false,
                'data_class' => null
            ])
            ->add('image2', FileType::class, [
                'required' => false,
                'data_class' => null
            ])
            ->add('image3', FileType::class, [
                'required' => false,
                'data_class' => null
            ])
            ->add('image4', FileType::class, [
                'required' => false,
                'data_class' => null
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary pull-right'
                ]
            ]);
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
