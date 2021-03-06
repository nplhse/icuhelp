<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep4Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rass_index', NumberType::class, [
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep4';
    }
}
