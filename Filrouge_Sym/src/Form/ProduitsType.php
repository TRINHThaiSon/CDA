<?php

namespace App\Form;

use App\Entity\Fournisseurs;
use App\Entity\Produits;
use App\Entity\SousCategories;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelleCourteArticle',TextType::class)
            ->add('libelleLongArticle',TextareaType::class,[
                'attr' => ['class' => 'tinymce'], 'required'=>false,
            ])
            ->add('imageArticle',)
            ->add('prixunitArticle')
            ->add('nombreStkArticle')
            ->add('souscategorie', EntityType::class, [
                "class" => SousCategories::class
            ])
            ->add('Fournisseurs', EntityType::class, [
                "class" => Fournisseurs::class,
                'multiple' => true,
                'expanded' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produits::class,
        ]);
    }
}
