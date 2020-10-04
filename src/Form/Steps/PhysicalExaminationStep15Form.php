<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep15Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('peep', NumberType::class, [
                'required' => true,
                'help' => 'Angabe in mmHg',
            ])
            ->add('asb', NumberType::class, [
                'required' => true,
                'help' => 'Angabe in mmHg',
            ])
            ->add('pinsp', NumberType::class, [
                'required' => true,
                'help' => 'Angabe in mmHg',
            ])
            ->add('fio2', NumberType::class, [
                'required' => true,
                'help' => 'Angabe in %',
            ])
            ->add('atemfrequenz', NumberType::class, [
                'required' => true,
            ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep15';
    }
}
