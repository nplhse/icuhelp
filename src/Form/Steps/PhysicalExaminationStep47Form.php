<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep47Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('punktionsstellen', ChoiceType::class, [
            'choices' => [
                'unauffällig' => 'unauffällig',
                'auffällig' => 'auffällig',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep47';
    }
}
