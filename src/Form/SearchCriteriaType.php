<?php

namespace App\Form;

use App\Entity\SearchCriteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchCriteriaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('minimumAge',IntegerType::class,['label'=>"Age minimum:"])
            ->add('maximumAge',IntegerType::class,['label'=>"Age maximum:"])
            ->add('male',CheckboxType::class,['label'=>"Homme "])
            ->add('female', CheckboxType::class,['label'=>"Femme "])
            ->add('other', CheckboxType::class,['label'=>"Autre "])
            ->add('area1',IntegerType::class,['label'=>"Département recherché:"])
            ->add('area2', IntegerType::class,['label'=>"Département recherché:"])
            ->add('area3',IntegerType::class,['label'=>"Département recherché:"])

            ->add('submit',SubmitType::class,
                ['label'=>'Valider']
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchCriteria::class,
            'attr' => ['novalidate' => 'novalidate']
        ]);
    }
}
