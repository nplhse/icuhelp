<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep43Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('extremitaeten', ChoiceType::class, [
            'choices' => [
                'warm, rosig' => 'warm, rosig',
                'blass, kühl' => 'blass, kühl',
                'marmoriert' => 'marmoriert',
                'livide verfärbt' => 'livide verfärbt',
            ],
            'required' => true,
        ])->add('extremitaeten_seite', ChoiceType::class, [
            'choices' => [
                'beidseits' => 'beidseits',
                'links' => 'links',
                'rechts' => 'rechts',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep43';
    }
}
