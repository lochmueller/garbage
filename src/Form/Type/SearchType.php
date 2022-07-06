<?php

namespace App\Form\Type;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('street', TextType::class, [
                'row_attr' => [
                    'class' => 'form-floating col-md-9',
                ],
            ])
            ->add('houseNumber', TextType::class, [
                'row_attr' => [
                    'class' => 'form-floating col-md-3',
                ],
            ])
            ->add('zip', TextType::class, [
                'row_attr' => [
                    'class' => 'form-floating col-md-3',
                ],
            ])
            ->add('city', TextType::class, [
                'row_attr' => [
                    'class' => 'form-floating col-md-9',
                ],
            ])
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'Deutschland' => 'DE',
                ],
                'row_attr' => [
                    'class' => 'form-floating col-md-12',
                ],
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
            'attr' => ['class' => 'row gy-3'],
        ]);
    }
}
