<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
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
            ])
            ->add('nomUser',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saissiez votre nom!',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre nom doit contenir au moins 2 lettres!',
                    ]),
                    new Regex([
                        'pattern' => "/^[A-Za-z]+$/",
                        'message' => 'Votre nom ne peut pas contenir un numéro ou une lettre spécifique!',
                    ])
                ],
            ])
            ->add('prenomUser',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saissiez votre prénom!',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prénom doit contenir au moins 2 lettres!',
                    ]),
                    new Regex([
                        'pattern' => "/^[A-Za-z]+$/",
                        'message' => 'Votre prénom ne peut pas contenir un numéro ou une lettre spécifique!',
                    ])
                ],
            ])
            ->add('adressUser',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saissiez votre adresse!',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre adresse doit contenir au moins 10 lettres!',
                    ]),
                    new Regex([
                        'pattern' => "/^[0-9A-Za-zéêà'\s]+$/",
                        'message' => 'Votre adresse ne peut pas contenir une lettre spécifique!',
                    ])
                ],
            ])
            ->add('cpUser',IntegerType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saissiez votre code postale!',
                    ]),
                    new Length([
                        'min' => 5,
                        'max' => 5,
                        'exactMessage' => 'La code postale ne contient que 5 chiffres!',
                    ]),                    
                ],
            ])
            ->add('villeUser',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saissiez votre ville!',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom de ville doit contenir au moins 2 lettres!',
                    ]),
                    new Regex([
                        'pattern' => "/^[0-9A-Za-z\séêà']+$/",
                        'message' => 'Le nom de ville ne peut pas contenir une lettre spécifique!',
                    ])
                ],
            ])
            ->add('contactUser',IntegerType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saissiez votre numéro de téléphone!',
                    ]),
                    new Length([
                        'min' => 9,
                        'max' => 9,
                        'exactMessage' => 'Le numéro de téléphone ne contient que 09 chiffres',
                    ]),                    
                ],
            ])
            ->add('typeUser',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Choississez votre type!',
                    ]),
                    new Length([
                        'min' => 3,
                        'max' => 3,
                        'exactMessage' => 'Le type de client ne contient que 3 lettres',
                    ]),
                    new Regex([
                        'pattern' => "/^[A-Z]+$/",
                        'message' => "Le type de client s'incrit en majuscule!",
                    ]),
                    new EqualTo([
                        
                        'value'=>"PRO" || "PAR",
                    ]),
                ],
                'attr' => [
                    'placeholder'=>'PRO pour un professionel, PAR pour un particulier!'
                ]
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
