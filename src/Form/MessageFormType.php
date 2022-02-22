<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MessageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Dupont'
                ],
                'label' => 'Nom *'
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'autoSizingInput',
                    'placeholder' => 'Pierre'
                ],
                'label' => 'Prénom *'
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'autoSizingInput',
                    'placeholder' => 'contact@mail.com'
                ],
                'label' => 'Email *'
            ])
            ->add('telephone', TextType::class,  [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'autoSizingInput',
                    'placeholder' => '0123456789'
                ],
                'label' => 'Téléphone *'
            ])
            ->add('message', TextareaType::class,  [
                'attr' => [
                    'class' => 'form-control',
                    'id' => 'autoSizingInput',
                    'placeholder' => 'Votre Message...'
                ],
                'label' => 'Message *'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
