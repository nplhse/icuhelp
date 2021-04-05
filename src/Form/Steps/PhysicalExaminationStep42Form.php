<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep42Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oedeme', ChoiceType::class, [
            'choices' => [
                'nicht vorhanden' => 'nicht vorhanden',
                'vorhanden' => 'vorhanden',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep42';
    }
}
