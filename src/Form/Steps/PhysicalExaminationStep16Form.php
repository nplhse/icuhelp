<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep16Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('gasaustausch', ChoiceType::class, [
            'choices' => [
                'gut' => 'gut',
                'eingeschränkt' => 'eingeschränkt',
            ],
            'required' => false,
            'data' => 'gut',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep16';
    }
}
