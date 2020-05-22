<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [ 'attr' => ['class' => 'form-control']])
            ->add('obmessage', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [ 'attr' => ['class' => 'form-control']])
            ->add('message', \Symfony\Component\Form\Extension\Core\Type\TextareaType::class, [ 'attr' => [
                'rows'=>6,
                'class' => 'form-control']])
            ->add('Soumettre', SubmitType::class ,[ 'attr' => ['class' => 'btn-success btn my-2']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
