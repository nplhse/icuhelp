<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep26Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('kreislauf', ChoiceType::class, [
            'choices' => [
                'Noradrenalin' => 'Noradrenalin',
                'Epinephrin' => 'Epinephrin',
                'Milrinon' => 'Milrinon',
                'Sonstiges' => 'Sonstiges',
            ],
            'multiple' => true,
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep26';
    }
}
