<?php

namespace App\Form;

use App\Entity\Page;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewPageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'form.name',
                    'data' => null,
                    'attr'  => [
                        'placeholder' => 'form.name',
                        'class' => 'ml-5',
                        'maxlength' => '30',
                        'autocomplete' => 'off',
                    ]
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
            ->add('sendForm', SubmitType::class, ['label' => 'form.newPage']);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class'         => Page::class,
                'translation_domain' => 'admin_form',
                'csrf_protection' => true,
                'csrf_field_name' => '_token',
                'csrf_token_id'   => 'task_item'
            ]
        );
    }
}