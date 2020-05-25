<?php

namespace App\Form;

use App\Entity\Day;
use App\Entity\Market;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchMarketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('city' , TextType::class , [
                'attr' => ['placeholder' => 'Ville ?']
                ])

            ->add('day', EntityType::class , [
                'class' => Day::class,
                'multiple'=>true,
                'expanded'=>true ,
                'choice_label' => 'name',
                'attr' => ['class' => 'row justify-content-between px-3 ']
            ])

            ->add('rechercher', SubmitType::class, [
                'attr'=> ['style' => 'background-color: #E9D758' ,
                    'class'=> 'border-white px-2']
            ] );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Market::class,
        ]);
    }
}
