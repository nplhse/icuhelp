<?php

namespace App\Form\Steps;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class PhysicalExaminationStep36Form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('druckschmerz_lokalisation', ChoiceType::class, [
            'choices' => [
                'im gesamten Abdomen' => 'im gesamten Abdomen',
                'im Oberbauch' => 'im Oberbauch',
                'im rechten Oberbauch' => 'im rechten Oberbauch',
                'im linken Oberbauch' => 'im linken Oberbauch',
                'im Mittelbauch' => 'im Mittelbauch',
                'im Unterbauch' => 'im Unterbauch',
                'im rechten Unterbauch' => 'im rechten Unterbauch',
                'im linken Unterbauch' => 'im linken Unterbauch',
                'paravesikal' => 'paravesikal',
            ],
            'required' => true,
        ]);
    }

    public function getBlockPrefix()
    {
        return 'PhysicalExaminationStep36';
    }
}
