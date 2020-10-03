<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep34Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('darmgeraeusche', ChoiceType::class, [
            'choices' => [
                'lebhaft' => 'lebhaft',
                'spärlich' => 'spärlich',
                'hochgestellt' => 'hochgestellt',
                'keine' => 'keine',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep34';
    }
}
