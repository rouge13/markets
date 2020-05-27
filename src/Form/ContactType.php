<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control',
                    'placeholder'=> "Email"],
                'label' => 'Email'
            ])
            ->add('obmessage', TextType::class, [
                'attr' => [
                    'class' => 'form-control' ,
                    "placeholder"=>"Objet du message"
                    ],
                'label' => 'Objet'
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'rows'=>5,
                    'class' => 'form-control',
                    "placeholder" => "Ecrire ici"
                ]
            ])

            ->add('Soumettre', SubmitType::class ,[
                'attr' => ['class' => 'btn-success btn my-2']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
