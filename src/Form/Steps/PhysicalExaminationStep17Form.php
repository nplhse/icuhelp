<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep17Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('gasaustausch_detail', TextareaType::class, [
            'required' => true,
                ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep17';
    }
}
