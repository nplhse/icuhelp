<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep19Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('atemgeraeusch_lokalisation', ChoiceType::class, [
            'choices' => [
                'ubiquitär' => 'ubiquitär',
                'linksseitig' => 'linksseitig',
                'rechtsseitig' => 'rechtsseitig',
                'beidseits basal' => 'beidseits basal',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep19';
    }
}
