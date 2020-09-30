<?php

namespace App\Form;

use Craue\FormFlowBundle\Form\FormFlow;
use Craue\FormFlowBundle\Form\FormFlowInterface;

class PhysicalExaminationFlow extends FormFlow
{
    protected function loadStepsConfig()
    {
        return [
            1 => [
                'label' => 'Vigilanz',
                'form_type' => PhysicalExaminationStep1Form::class,
            ],
            2 => [
                'label' => 'Ansprechbarkeit',
                'form_type' => PhysicalExaminationStep2Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveAnsprechbarkeit();
                },
            ],
            3 => [
                'label' => 'Orientierung',
                'form_type' => PhysicalExaminationStep3Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveOrientierung();
                },
            ],
            4 => [
                'label' => 'RASS',
                'form_type' => PhysicalExaminationStep4Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveRASS();
                },
            ],
            5 => [
                'label' => 'CAM-ICU',
                'form_type' => PhysicalExaminationStep5Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveCAM();
                },
            ],
            6 => [
                'label' => 'Pupillen',
                'form_type' => PhysicalExaminationStep6Form::class,
            ],
            7 => [
                'label' => 'Sensomotorische Defizite',
                'form_type' => PhysicalExaminationStep7Form::class,
            ],
            8 => [
                'label' => 'Sensomotorische Defizite',
                'form_type' => PhysicalExaminationStep8Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveSensomotorischesDefizitDetail();
                },
            ],
            9 => [
                'label' => 'Bestätigung',
            ],
        ];
    }
}
