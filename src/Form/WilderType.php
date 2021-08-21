<?php

namespace App\Form;

use App\Entity\Wilder;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WilderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'input']
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'input']
            ])
            ->add('birthDate', DateType::class, [
                'label' => 'Née le',
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => ['class' => 'input']
            ])
            ->add('informations', TextType::class, [
                'label' => 'Informations complémentaires',
                'attr' => ['class' => 'input']
            ])
            ->add('wilderImage', FileType::class, [
                'label' => 'Ajouter des images',
                'multiple' => false,
                'required' => false,
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Wilder::class,
        ]);
    }
}
