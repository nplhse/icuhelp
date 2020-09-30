<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep14Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('peep', NumberType::class, [
                'required' => true,
            ])
            ->add('asb', NumberType::class, [
                'required' => true,
            ])
            ->add('fio2', NumberType::class, [
                'required' => true,
            ])
            ->add('atemfrequenz', NumberType::class, [
                'required' => true,
            ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep14';
    }
}
