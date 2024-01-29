<?php

namespace App\Form;

use App\Entity\Recettes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('title')
            // ->add('description')
            // ->add('ingredients')
            // ->add('Etapes',TextType::class, [
            //     'label' => 'Étapes',
            //     'attr' => ['id' => 'etapes'], 
            // ])
            // ->add('image_src')
            // ->add('categorie')
            ->add('title', null, ['label' => ' '])
            ->add('description', TextareaType::class, ['label' => ' '])
            ->add('ingredients', null, ['label' => ' '])
            ->add('Etapes', TextType::class, ['label' => ' '])
            // ->add('image_src', null, ['label' => ''])
            // ->add('image_src', VichFileType::class, [
            //     'label' => ' ',
            //     'required' => false,
            //     'allow_delete' => true,
            //     'download_label' => 'Download Image',
            //     'download_uri' => true,
            //     'image_uri' => true,
            //     'asset_helper' => true,
            // ])
            // ->add('image_src', VichFileType::class, [
            //     'required' => false,
            //     'allow_delete' => true,
            //     'download_uri' => true,
            //     'download_label' => 'Download Image',
            //     'asset_helper' => true,
            // ])
            ->add('image_src', VichImageType::class, [
                'required' => false,
                'download_link' => false,
                'image_uri' => false
            ])  
            ->add('categorie', null, ['label' => ' '])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recettes::class,
        ]);
    }
}
