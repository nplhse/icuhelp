<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep52Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sonstiges', TextareaType::class, [
            'required' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep52';
    }
}
