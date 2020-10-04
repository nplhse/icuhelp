<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep6Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('pupillen_isokorie', ChoiceType::class, [
            'choices' => [
                'isokor' => 'isokor',
                'anisokor' => 'anisokor',
            ],
            'required' => false,
            'data' => 'isokor',
        ]);
        $builder->add('pupillen_lichtreagibilitaet', ChoiceType::class, [
            'choices' => [
                'seitengleich' => 'seitengleich',
                'nicht seitengleich' => 'nicht seitengleich',
            ],
            'required' => false,
            'data' => 'seitengleich',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep6';
    }
}
