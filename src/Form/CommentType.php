<?php

namespace App\Form;

use App\Entity\CommentMarket;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('notice',TextareaType::class, [
                'label_attr'=>['class'=> '', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'Ecrire ici'],
                'label' => 'Commentaire'
            ])
            ->add('Commentaire', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CommentMarket::class,
        ]);
    }
}
