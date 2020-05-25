<?php

namespace App\Form;

use App\Entity\CommentMarket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('notice',TextType::class, [
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'Market name']
            ])
            ->add('user')
            ->add('market')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommentMarket::class,
        ]);
    }
}
