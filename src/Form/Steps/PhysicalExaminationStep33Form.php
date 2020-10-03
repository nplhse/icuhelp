<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep33Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('abdomen', ChoiceType::class, [
            'choices' => [
                'weich' => 'weich',
                'gespannt' => 'gespannt',
                'gebläht' => 'gebläht',
                'gummiartig' => 'gummiartig',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep33';
    }
}
