<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep38Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nierenfunktion', ChoiceType::class, [
            'choices' => [
                'Gute Ausscheidung' => 'Gute Ausscheidung',
                'Eingeschränkte Ausscheidung' => 'Eingeschränkte Ausscheidung',
                'Anurisch' => 'Anurisch',
                'Dialyse' => 'Dialyse',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep38';
    }
}
