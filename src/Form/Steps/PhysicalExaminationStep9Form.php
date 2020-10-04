<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep9Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('atmung', ChoiceType::class, [
            'choices' => [
                'spontan atmend' => 'spontan atmend',
                'NIV-Therapie' => 'CPAP',
                'high flow' => 'high flow',
                'intubiert' => 'intubiert',
            ],
            'required' => false,
            'data' => 'spontan atmend',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep9';
    }
}
