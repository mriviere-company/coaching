<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewImageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'imageFile',
                FileType::class,
                [
                    'label' => 'form.imageFile',
                    'data' => null,
                    'attr'  => [
                        'placeholder' => 'form.imageFile',
                        'class' => 'ml-5',
                        'maxlength' => '30',
                        'autocomplete' => 'off',
                    ],
                    'mapped' => false,
                    'constraints' => [
                        new File([
                                     'maxSize' => '1024k',
                                     'mimeTypes' => [ "image/png", "image/jpeg", "image/bmp", "image/webp"],
                                     'mimeTypesMessage' => 'Please upload a valid image',
                                 ])
                    ],
                ]
            )
            ->add(
                'position',
                IntegerType::class,
                [
                    'label' => 'form.position',
                    'attr'  => [
                        'placeholder' => 'form.position',
                        'min' => '0',
                        'autocomplete' => 'off',
                    ]
                ]
            )
            ->add('sendForm', SubmitType::class, ['label' => 'form.newImage']);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'         => Image::class,
                'translation_domain' => 'admin_form',
                'csrf_protection' => true,
                'csrf_field_name' => '_token',
                'csrf_token_id'   => 'task_item'
            ]
        );
    }
}