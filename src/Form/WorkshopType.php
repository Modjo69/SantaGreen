<?php

namespace App\Form;

use App\Entity\Workshop;
use Symfony\Component\Form\AbstractType;
<<<<<<< HEAD
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
=======
>>>>>>> dev
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WorkshopType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
<<<<<<< HEAD
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('picture', FileType::class)
            ->add('user_max')
            ->add('date_time')
            ->add('address', TextType::class)
            ->add('register', SubmitType::class)
=======
            ->add('name')
            ->add('description')
            ->add('picture')
            ->add('user_max')
            ->add('user_registered')
            ->add('date_time')
            ->add('user')
            ->add('address')
>>>>>>> dev
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Workshop::class,
        ]);
    }
}
