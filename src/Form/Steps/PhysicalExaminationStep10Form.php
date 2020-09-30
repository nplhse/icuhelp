<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep10Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('o2_flow', NumberType::class, [
            'required' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep10';
    }
}
