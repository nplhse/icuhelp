<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep37Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('stuhlgang', ChoiceType::class, [
            'choices' => [
                'unauffällig' => 'unauffällig',
                'Durchfälle' => 'Durchfälle',
                'muss abführen' => 'muss abführen',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep37';
    }
}
