<?php

namespace App\Form;

use App\Entity\Profil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('birthDate')
            ->add('sex',ChoiceType::class,['label'=>"Genre", 'choices'=>["Homme"=>0,"Femme"=>1,"Autre"=>2]])
            ->add('postalCode')
            ->add('town')
            ->add('description')
            ->add('submit',SubmitType::class,
                ['label'=>'Valider']
            )

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Profil::class,
        ]);
    }
}
