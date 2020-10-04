<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep1Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('vigilanz', ChoiceType::class, [
            'choices' => [
                'wach' => 'wach',
                'somnolent' => 'somnolent',
                'flach analgosediert' => 'flach analgosediert',
                'tief analgosediert' => 'tief analgosediert',
            ],
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep1';
    }
}
