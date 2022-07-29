<?php

namespace App\Form;

use App\Entity\Slider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SliderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('photo', FileType::class, [
                'label' => 'Photo',
                'data_class' => null,
                'required' => false,
                'mapped' => false,
            ])
            ->add('ordre', IntegerType::class, [
                'label' => 'Ordre'
            ])
            ->add('date_enregistrement', DateTimeType::class, [
                'date_label' => 'Enregistré le'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'valider',
                'validate' => false,
                'attr' => [
                    'class' => 'd-block mx-auto col-3 my-3 btn btn-success'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Slider::class,
        ]);
    }
}
