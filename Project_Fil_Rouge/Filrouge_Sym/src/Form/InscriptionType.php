<?php

namespace App\Form;

use App\Entity\Clients;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomClient',TextType::class,[
                'attr' => [
                    'placeholder'=>"Saisir votre nom",
                    
                ],
                
            ])
            ->add('prenomClient',TextType::class,[
                'attr' => [
                    'placeholder'=>"Saisir votre prénom",
                    
                ]
            ])
            ->add('adressClient',TextType::class,[
                'attr' => [
                    'placeholder'=>"Saisir votre adresse",
                    
                ]
            ])
            ->add('cpClient',IntegerType::class,[
                'attr' => [
                    'placeholder'=>"Saisir votre code postale",
                    
                ]
            ])
            ->add('villeClient',TextType::class,[
                'attr' => [
                    'placeholder'=>"Saisir votre ville",
                   
                ]
            ])
            ->add('contactClient',IntegerType::class,[
                'attr' => [
                    'placeholder'=>"Saisir votre numéro de téléphone",
                    
                ]
            ])
            ->add('typeClient',TextType::class,[
                'attr' => [
                    'placeholder'=>"Saisir votre type : PRO pour un professionel client, PAR pour un particulier",
                    
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Clients::class,
        ]);
    }
}
