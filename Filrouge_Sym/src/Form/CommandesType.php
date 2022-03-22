<?php

namespace App\Form;

use App\Entity\Commandes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CommandesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateComm',DateTimeType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    "readonly" => "readonly"
                ]
            ])
            //->add('montantComm')
            ->add('adressLivr',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saissiez votre adresse!',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre adresse doit contenir au moins 10 caractères!',
                    ]),
                    new Regex([
                        'pattern' => "/^[0-9A-Za-zéêà'\s]+$/",
                        'message' => 'Votre adresse ne peut pas contenir une caractère spécifique!',
                    ]),
                ],
            ])
                            
            ->add('cpLivr',IntegerType::class,[
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
            ->add('villeLivr',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saissiez votre ville!',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom de ville doit contenir au moins 2 caractères!',
                    ]),
                    new Regex([
                        'pattern' => "/^[0-9A-Za-z\séêà']+$/",
                        'message' => 'Le nom de ville ne peut pas contenir une caractère spécifique!',
                    ])
                ],
            ])
            ->add('adressFact',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saissiez votre adresse!',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre adresse doit contenir au moins 10 caractères!',
                    ]),
                    new Regex([
                        'pattern' => "/^[0-9A-Za-zéêà'\s]+$/",
                        'message' => 'Votre adresse ne peut pas contenir une caractère spécifique!',
                    ]),
                ],
            ])
            ->add('cpFact',IntegerType::class,[
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
            ->add('villeFact',TextType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Saissiez votre ville!',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Le nom de ville doit contenir au moins 2 caractères!',
                    ]),
                    new Regex([
                        'pattern' => "/^[0-9A-Za-z\séêà']+$/",
                        'message' => 'Le nom de ville ne peut pas contenir une caractère spécifique!',
                    ])
                ],
            ])
            /*>add('tauxTva',NumberType::class,[
                'scale'=>2,
                "attr" => [
                    "readonly" =>"readonly"
                ]
            ])*/
            ->add('typePaiement',TextType::class,[
                'constraints'=>[
                    new EqualTo([
                        
                        'value'=>"DIR" || "APR",
                    ]),
                ],
                'attr'=>[
                    'placeholder'=>' DIR pour un  particulier, APR pour un professionnel',
                    "readonly" =>"readonly"
                ]
            ])
            // ->add('client')
                
            
            
            ->add('prenomClient', TextType::class,[
                'mapped'=>false,
                "attr" => [
                    "readonly" =>"readonly"
                ]
            ])
            ->add('nomClient', TextType::class,[
                'mapped'=>false,
                "attr" => [
                    "readonly" =>"readonly"
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Commandes::class,
        ]);
    }
}
