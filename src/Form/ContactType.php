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
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => 'Full name:',
                "attr" => [
                    'placeholder' => "Your Full Name.",
                    "class" => 'form-control',
                ],
                "row_attr" => [
                    "class" => 'form-outline mb-4'
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email Address:',
                "attr" => [
                    'placeholder' => "Your email-address.",
                    "class" => 'form-control',
                ],
                "row_attr" => [
                    "class" => 'form-outline mb-4'
                ],
                "required" => true
            ])
            ->add('subject', TextType::class, [
        'label' => 'Subject:',
        "attr" => [
            'placeholder' => "The reason for contacting us.",
            "class" => 'form-control',
        ],
        "row_attr" => [
            "class" => 'form-outline mb-4'
        ],
                "required" => true
    ])
            ->add('message', TextareaType::class, [
                'label' => 'Your message to us:',
                "attr" => [
                    'placeholder' => "Write your message here.",
                    "class" => 'form-control',
                ],
                "row_attr" => [
                    "class" => 'form-outline mb-4'
                ],
                "required" => true
            ])
            ->add('Send_Message', SubmitType::class, ['label' => 'Send Message',
                "attr" => ["class" => 'button'],
                "row_attr" => [
                    "class" => 'button-div'
                ]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
