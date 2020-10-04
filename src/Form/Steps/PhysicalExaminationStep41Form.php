<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep41Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('bilanz', ChoiceType::class, [
            'choices' => [
                'negativ' => 'negativ',
                'ausgeglichen' => 'ausgeglichen',
                'positiv' => 'positiv',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep41';
    }
}
