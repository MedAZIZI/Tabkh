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
            
            ->add('title', null, ['label' => ' '])
            ->add('description', TextareaType::class, ['label' => ' '])
            ->add('ingredients', null, ['label' => ' '])
            ->add('Etapes', TextType::class, ['label' => ' '])
            
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                // 'download_link' => false,
            
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
