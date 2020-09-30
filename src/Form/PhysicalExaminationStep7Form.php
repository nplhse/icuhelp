<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep7Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sensomotorischedefizite', ChoiceType::class, [
            'choices' => [
                'nicht vorhanden' => 'nicht_vorhanden',
                'vorhanden' => 'vorhanden',
            ],
            'required' => false,
            'data' => 'nicht_vorhanden',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep7';
    }
}
