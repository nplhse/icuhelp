<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep27Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('noradrenalin', NumberType::class, [
            'required' => true,
            'help' => 'Angabe in mg/h',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep27';
    }
}
