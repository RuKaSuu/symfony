<?php

namespace App\Form\Type;

use App\Entity\Jobs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JobsType extends AbstractType
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
            ->add('jobName', TextType::class)
            ->add('jobCreator', TextType::class)
            ->add('jobDegree', ChoiceType ::class, [
                'choices' => [
                    'Bac+1' => '1',
                    'Bac+2' => '2',
                    'Bac+3' => '3',
                    'Bac+4' => '4',
                    'Bac+5' => '5',
                ],
            ])
            ->add('jobDescription', TextType::class)
//            ->add('jobSkills', ChoiceType::class, [
//                'choices' => $skills,
//                'multiple' => true,
//            ])
            ->add('jobLocation', TextType::class)
//            ->add('jobPicture', TextType::class)
            ->add('save', SubmitType::class , [
                'label' => 'Post',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'data_class' => Jobs::class,
        ]);
    }

}