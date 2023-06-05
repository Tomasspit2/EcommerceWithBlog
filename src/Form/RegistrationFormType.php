<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('fullName', TextType::class, [
                'label' => 'Full name:',
                'label_attr' => ['class' => 'form-label'],
                "attr" => [
                    'placeholder' => "Your full name.",
                    "class" => 'form-control',
                ],
                "required" => true
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email Address:',
                'label_attr' => ['class' => 'form-label'],
                "attr" => [
                    'placeholder' => "Your email-address.",
                    "class" => 'form-control',
                ],
                "required" => true
            ])
           /* ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'attr' => ['class'=>'form-check-input me-2'],
                'label_attr' => ['class' => 'form-label'],
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ]) */
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'required' => true,

                'first_options' => ['label' => 'Password',
                    'attr' => ['placeholder' => 'Your password',
                        'class' => 'form-control'],
                    'label_attr' => ['class' => 'form-label'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    ],
                'second_options' => ['label' => 'Repeat Password',
                    'attr' => ['placeholder' => 'Repeat your password',
                        'class' => 'form-control'],
                    'label_attr' => ['class' => 'form-label'],
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    ],
                'mapped' => false,
            ])

            ->add('Register', SubmitType::class, ['label' => 'Sign up.',
                "attr" => ["class" => 'button'],
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
