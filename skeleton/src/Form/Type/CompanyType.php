<?php

namespace App\Form\Type;

use App\Entity\Company;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//use Symfony\Component\Form\Test\FormBuilderInterface;

//Create an array with all the programming languages


class CompanyType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder

            ->add('name',TextType::class)
            ->add('picture')
            ->add('address')
            ->add('websiteLink')
            ->add('save', SubmitType::class, ['label' => 'Create Society'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'data_class' => Company::class,
        ]);
    }
}
