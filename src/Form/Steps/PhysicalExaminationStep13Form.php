<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep13Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('beatmung_modus', ChoiceType::class, [
            'choices' => [
                'CPAP' => 'CPAP',
                'BiPAP' => 'BiPAP',
            ],
            'required' => false,
            'data' => 'CPAP',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep13';
    }
}
