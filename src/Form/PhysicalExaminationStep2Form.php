<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep2Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('ansprechbarkeit', ChoiceType::class, [
            'choices' => [
                'ansprechbar' => 'ansprechbar',
                'nicht ansprechbar' => 'nicht_ansprechbar',
            ],
            'required' => false,
            'data' => 'ansprechbar',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep2';
    }
}
