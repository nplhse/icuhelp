<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep8Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('sensomotorischedefizite_detail', TextType::class, [
            'required' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep8';
    }
}
