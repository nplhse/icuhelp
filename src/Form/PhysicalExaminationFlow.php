<?php

namespace App\Form;

use App\Form\Steps\PhysicalExaminationStep10Form;
use App\Form\Steps\PhysicalExaminationStep11Form;
use App\Form\Steps\PhysicalExaminationStep12Form;
use App\Form\Steps\PhysicalExaminationStep13Form;
use App\Form\Steps\PhysicalExaminationStep14Form;
use App\Form\Steps\PhysicalExaminationStep15Form;
use App\Form\Steps\PhysicalExaminationStep1Form;
use App\Form\Steps\PhysicalExaminationStep2Form;
use App\Form\Steps\PhysicalExaminationStep3Form;
use App\Form\Steps\PhysicalExaminationStep4Form;
use App\Form\Steps\PhysicalExaminationStep5Form;
use App\Form\Steps\PhysicalExaminationStep6Form;
use App\Form\Steps\PhysicalExaminationStep7Form;
use App\Form\Steps\PhysicalExaminationStep8Form;
use App\Form\Steps\PhysicalExaminationStep9Form;
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
                    return $estimatedCurrentStepNumber > 4 && !$flow->getFormData()->canHaveCAM();
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
                    return $estimatedCurrentStepNumber > 7 && !$flow->getFormData()->canHaveSensomotorischesDefizitDetail();
                },
            ],
            9 => [
                'label' => 'Atmung',
                'form_type' => PhysicalExaminationStep9Form::class,
            ],
            10 => [
                'label' => 'O2-Gabe',
                'form_type' => PhysicalExaminationStep10Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 9 && !$flow->getFormData()->canHaveO2Gabe();
                },
            ],
            11 => [
                'label' => 'CPAP/NIV',
                'form_type' => PhysicalExaminationStep11Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveNIV();
                },
            ],
            12 => [
                'label' => 'High flow',
                'form_type' => PhysicalExaminationStep12Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveNIV();
                },
            ],
            13 => [
                'label' => 'High flow',
                'form_type' => PhysicalExaminationStep13Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveBeatmung();
                },
            ],
            14 => [
                'label' => 'Intubiert: CPAP',
                'form_type' => PhysicalExaminationStep14Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveCPAP();
                },
            ],
            15 => [
                'label' => 'Intubiert: BiPAP',
                'form_type' => PhysicalExaminationStep15Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveBiPAP();
                },
            ],
            16 => [
                'label' => 'Bestätigung',
            ],
        ];
    }
}
