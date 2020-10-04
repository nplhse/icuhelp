<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep7Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sensomotorischedefizite', ChoiceType::class, [
            'choices' => [
                'nicht vorhanden' => 'nicht vorhanden',
                'vorhanden' => 'vorhanden',
            ],
            'required' => false,
            'data' => 'nicht vorhanden',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep7';
    }
}
