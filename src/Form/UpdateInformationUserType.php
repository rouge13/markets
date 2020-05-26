<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateInformationUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('image',FileType::class, [
                'mapped'=>false,
                'required' =>false,
                'label_attr'=>['class'=> 'blue-bg', 'style'=> 'color : black'],
                'attr' => ['placeholder' => 'image']
            ])
            ->add('alias' , TextType::class , [ 'attr' => ['class' => 'form-control']])
            ->add('email', EmailType::class , [ 'attr' => ['class' => 'form-control']])
            ->add('region' , TextType::class , [ 'attr' => ['class' => 'form-control']])

            ->add('password' , RepeatedType::class, [
                'type' => PasswordType::class,
                'attr' => ['class' => 'form-row'],
                'first_options'  => [
                    'attr'  => ['class' => ' form-control col'],
                    'label' => 'Mot de passe'
                ],
                'second_options'=> [
                    'attr'  => ['class' => 'form-control col'],
                    'label' => 'Veuillez confimer mot de passe',
                    //'label_attr' => ['class' => 'form-text']
                ],
            ])

            ->add('Update', SubmitType::class ,[
                'attr' => [
                    'class' => 'form-control text-light mt-2',
                    'style' => 'background-color : #297373'
                ]]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
