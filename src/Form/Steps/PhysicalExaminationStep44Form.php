<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep44Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('fusspulse', ChoiceType::class, [
            'choices' => [
                'beidseits vorhanden' => 'beidseits vorhanden',
                'links nicht vorhanden' => 'links nicht vorhanden',
                'rechts nicht vorhanden' => 'rechts nicht vorhanden',
                'nicht vorhanden' => 'nicht vorhanden',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep44';
    }
}
