<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep3Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('orientierung', ChoiceType::class, [
            'choices' => [
                'orientiert' => 'orientiert',
                'teilweise orientiert' => 'teilweise orientiert',
                'nicht orientiert' => 'nicht orientiert',
            ],
            'required' => false,
            'data' => 'orientiert',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep3';
    }
}
