<?php

namespace App\Form\Type;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//use Symfony\Component\Form\Test\FormBuilderInterface;

//Create an array with all the programming languages


class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $skills = [
            'PHP' => 'PHP',
            'Java' => 'Java',
            'C#' => 'C#',
            'C++' => 'C++',
            'Python' => 'Python',
            'Ruby' => 'Ruby',
            'JavaScript' => 'JavaScript',
            'C' => 'C',
            'Go' => 'Go',
            'Rust' => 'Rust',
            'Swift' => 'Swift',
            'Kotlin' => 'Kotlin',
            'Dart' => 'Dart',
            'Lua' => 'Lua',
            'Assembly' => 'Assembly',
            'Scratch' => 'Scratch',
        ];
        $builder

            ->add('name',TextType::class)
            ->add('surname', TextType::class)
            ->add('age', IntegerType::class)
            ->add('address', TextType::class)
            ->add('profilePicture', TextType::class)
            ->add('levels', ChoiceType ::class, [
                'choices' => [
                    'Bac+1' => '1',
                    'Bac+2' => '2',
                    'Bac+3' => '3',
                    'Bac+4' => '4',
                    'Bac+5' => '5',
                ],
            ])
            ->add('Skills', ChoiceType::class, [
                'choices' => $skills,
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('save', SubmitType::class, ['label' => 'Create User'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
