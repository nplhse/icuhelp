<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep18Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('atemgeraeusch', ChoiceType::class, [
            'choices' => [
                'vesikulär beidseits' => 'vesikulär beidseits',
                'Giemen' => 'Giemen',
                'Rasselgeräusche' => 'Rasselgeräusche',
            ],
            'required' => false,
            'data' => 'vesikulär beidseits',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep18';
    }
}
