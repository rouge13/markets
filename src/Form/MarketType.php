<?php

namespace App\Form;

use App\Entity\Day;
use App\Entity\Market;
use App\Entity\Stand;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MarketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class)
            ->add('track',TextType::class)
            ->add('pc')
            ->add('city', TextType::class)
            ->add('region', TextType::class)
            ->add('time_from')
            ->add('time_to')
            ->add('day',EntityType::class, [
                'class' => Day::class,
                'multiple'=>true,
                'expanded'=>true,
                'choice_label' => 'name'
            ])
            ->add('stand',EntityType::class, [
                'class' => Stand::class,
                'multiple'=>true,
                'expanded'=>true,
                'choice_label' => 'name'
            ])
            ->add('Ajouter', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Market::class,
        ]);
    }
}
