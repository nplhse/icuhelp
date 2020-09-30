<?php

namespace App\Form;

use Craue\FormFlowBundle\Form\FormFlow;

class PhysicalExaminationFlow extends FormFlow
{
    protected function loadStepsConfig()
    {
        return [
            [
                'label' => 'wheels',
                'form_type' => PhysicalExaminationStep1Form::class,
            ],
            [
                'label' => 'confirmation',
            ],
        ];
    }
}
