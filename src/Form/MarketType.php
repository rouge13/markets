<?php

namespace App\Form;

use App\Entity\Day;
use App\Entity\Market;
use App\Entity\Stand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'exemple : Marché de la mairie'],
                'label' => 'Nom'
            ])
            ->add('track',TextType::class, [
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'exemple : Rue des tulipes'],
                'label' => 'Voie',

            ])
            ->add('pc', IntegerType::class, [
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'label' => 'Code postal',
                'attr' => ['placeholder' => 'code postal']
            ])
            ->add('city', TextType::class, [
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'ville'],
                'label' => 'Ville'
            ])
            ->add('region', TextType::class, [
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'région'],
                'label' => 'Région'
            ])
            ->add('time_from', IntegerType::class, [
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'de'],
                'label' => 'Heure de début'
            ])
            ->add('time_to', IntegerType::class, [
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'à'],
                'label' => 'Heure de fin'
            ])
            ->add('day',EntityType::class, [
                'class' => Day::class,
                'multiple'=>true,
                'expanded'=>true,
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'choice_label' => 'name',
                'attr'=>['class'=>'row m-4 d-flex justify-content-around','style'=>'color : black'],
                'label'=>'Jour(s) de marché'
            ])
            ->add('Ajouter', SubmitType::class , [
                'label' =>  'Valider'
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Market::class,
        ]);
    }
}
