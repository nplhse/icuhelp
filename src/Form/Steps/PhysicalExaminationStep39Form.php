<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep39Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('diuretika', ChoiceType::class, [
            'choices' => [
                'ohne Diuretikagabe' => 'ohne Diuretikagabe',
                'mit Diuretikagabe' => 'mit Diuretikagabe',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep39';
    }
}
