<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep22Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rhythmus', ChoiceType::class, [
            'choices' => [
                'Sinusrhythmus' => 'Sinusrhythmus',
                'Sinusbradykardie' => 'Sinusbradykardie',
                'Sinustachykardie' => 'Sinustachykardie',
                'Absolute arrhythmie' => 'Absolute arrhythmie',
                'Vorhofflattern' => 'Vorhofflattern',
                'Schrittmacherrhythmus' => 'Schrittmacherrhythmus',
                'Sonstiges' => 'Sonstiges',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep22';
    }
}
