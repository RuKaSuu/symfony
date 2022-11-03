<?php

namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//use Symfony\Component\Form\Test\FormBuilderInterface;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Name'])
            ->add('surname', TextType::class, ['label' => 'Surname'])
            ->add('age', IntegerType::class, ['label' => 'Age'])
            ->add('address', TextType::class, ['label' => 'Address'])
            ->add('levels', IntegerType::class, ['label' => 'Levels'])
            ->add('save', SubmitType::class, ['label' => 'Enregistrer et continuer'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
