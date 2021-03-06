<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep23Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('herzfrequenz', NumberType::class, [
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep23';
    }
}
