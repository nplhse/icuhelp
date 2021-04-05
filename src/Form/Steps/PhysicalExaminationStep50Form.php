<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep50Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('blutfluss', NumberType::class, [
                'required' => true,
                'help' => 'Angabe in l/min',
            ])->add('sweepgasfluss', NumberType::class, [
                'required' => true,
                'help' => 'Angabe in l/min',
            ])->add('ecmo_fio2', NumberType::class, [
                'required' => true,
                'help' => 'Angabe in %',
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep50';
    }
}
