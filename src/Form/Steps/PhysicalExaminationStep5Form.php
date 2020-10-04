<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep5Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cam_index', ChoiceType::class, [
            'choices' => [
                'negativ' => 'negativ',
                'positiv' => 'positiv',
            ],
            'required' => false,
            'data' => 'negativ',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep5';
    }
}
