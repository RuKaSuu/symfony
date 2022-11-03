<?php

namespace App\Form\Type;

use App\Entity\Entreprises;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//use Symfony\Component\Form\Test\FormBuilderInterface;

//Create an array with all the programming languages


class SocietyType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder

            ->add('compagnyName',TextType::class)
            ->add('compagnyPicture')
            ->add('location', TextType::class)
            ->add('websiteLink', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Society'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver) : void
    {
        $resolver->setDefaults([
            'data_class' => Entreprises::class,
        ]);
    }
}
