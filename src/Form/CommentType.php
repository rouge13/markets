<?php

namespace App\Form;

use App\Entity\CommentMarket;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
                'attr' => ['placeholder' => 'notice name']
            ])
            ->add('user',IntegerType::class, [
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black']
            ])
            ->add('market',IntegerType::class, [
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black']
            ])
            ->add('Commentaire', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommentMarket::class,
        ]);
    }
}
