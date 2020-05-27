<?php

namespace App\Form;


use App\Entity\Stand;
use App\Entity\Type;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StandType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'Nom du stand'],
                'label' =>  'Nom'
            ])
            ->add('description', TextareaType::class, [
                'required'   => false,
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'Ecrire ici']
            ])
            ->add('link', UrlType::class, [
                'required'   => false,
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'Lien'],
                'label' =>  'Site internet'
            ])
            ->add('image',FileType::class, [
                'mapped'=>false,
                'required' =>false,
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'image']
            ])
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'required'=>false,
                'multiple'=>true,
                'expanded'=>true,
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'choice_label' => 'name',
                'attr'=>['class'=>'row m-4 d-flex justify-content-around','style'=>'color : black']
            ])


            ->add("Ajouter", SubmitType::class , [
                'label' =>  'Ajouter un stand'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stand::class
        ]);
    }
}
