<?php

namespace App\Form;

use App\Form\Steps\PhysicalExaminationStep10Form;
use App\Form\Steps\PhysicalExaminationStep11Form;
use App\Form\Steps\PhysicalExaminationStep12Form;
use App\Form\Steps\PhysicalExaminationStep13Form;
use App\Form\Steps\PhysicalExaminationStep14Form;
use App\Form\Steps\PhysicalExaminationStep15Form;
use App\Form\Steps\PhysicalExaminationStep16Form;
use App\Form\Steps\PhysicalExaminationStep17Form;
use App\Form\Steps\PhysicalExaminationStep18Form;
use App\Form\Steps\PhysicalExaminationStep19Form;
use App\Form\Steps\PhysicalExaminationStep1Form;
use App\Form\Steps\PhysicalExaminationStep20Form;
use App\Form\Steps\PhysicalExaminationStep21Form;
use App\Form\Steps\PhysicalExaminationStep22Form;
use App\Form\Steps\PhysicalExaminationStep23Form;
use App\Form\Steps\PhysicalExaminationStep24Form;
use App\Form\Steps\PhysicalExaminationStep25Form;
use App\Form\Steps\PhysicalExaminationStep26Form;
use App\Form\Steps\PhysicalExaminationStep27Form;
use App\Form\Steps\PhysicalExaminationStep28Form;
use App\Form\Steps\PhysicalExaminationStep29Form;
use App\Form\Steps\PhysicalExaminationStep2Form;
use App\Form\Steps\PhysicalExaminationStep30Form;
use App\Form\Steps\PhysicalExaminationStep31Form;
use App\Form\Steps\PhysicalExaminationStep32Form;
use App\Form\Steps\PhysicalExaminationStep33Form;
use App\Form\Steps\PhysicalExaminationStep34Form;
use App\Form\Steps\PhysicalExaminationStep35Form;
use App\Form\Steps\PhysicalExaminationStep36Form;
use App\Form\Steps\PhysicalExaminationStep37Form;
use App\Form\Steps\PhysicalExaminationStep38Form;
use App\Form\Steps\PhysicalExaminationStep39Form;
use App\Form\Steps\PhysicalExaminationStep3Form;
use App\Form\Steps\PhysicalExaminationStep40Form;
use App\Form\Steps\PhysicalExaminationStep41Form;
use App\Form\Steps\PhysicalExaminationStep42Form;
use App\Form\Steps\PhysicalExaminationStep43Form;
use App\Form\Steps\PhysicalExaminationStep44Form;
use App\Form\Steps\PhysicalExaminationStep45Form;
use App\Form\Steps\PhysicalExaminationStep46Form;
use App\Form\Steps\PhysicalExaminationStep47Form;
use App\Form\Steps\PhysicalExaminationStep48Form;
use App\Form\Steps\PhysicalExaminationStep49Form;
use App\Form\Steps\PhysicalExaminationStep4Form;
use App\Form\Steps\PhysicalExaminationStep50Form;
use App\Form\Steps\PhysicalExaminationStep51Form;
use App\Form\Steps\PhysicalExaminationStep52Form;
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
                    return $estimatedCurrentStepNumber > 1 && !$flow->getFormData()->canHaveHighflow();
                },
            ],
            13 => [
                'label' => 'Beatmungsmodus',
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
                'label' => 'Gasaustausch',
                'form_type' => PhysicalExaminationStep16Form::class,
            ],
            17 => [
                'label' => 'Gasaustausch eingeschränkt',
                'form_type' => PhysicalExaminationStep17Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 16 && !$flow->getFormData()->canHaveGasaustauschDetail();
                },
            ],
            18 => [
                'label' => 'Atemgeräusch',
                'form_type' => PhysicalExaminationStep18Form::class,
            ],
            19 => [
                'label' => 'Atemgeräusch Lokalisation',
                'form_type' => PhysicalExaminationStep19Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 18 && !$flow->getFormData()->canHaveAtemgeraeuschLokalisation();
                },
            ],
            20 => [
                'label' => 'Rasselgeräusch Charakter',
                'form_type' => PhysicalExaminationStep20Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 18 && !$flow->getFormData()->canHaveRasselgeraeuschCharakter();
                },
            ],
            21 => [
                'label' => 'Atemgeräusch Lokalisation',
                'form_type' => PhysicalExaminationStep21Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 18 && !$flow->getFormData()->canHaveHustenstoss();
                },
            ],
            22 => [
                'label' => 'Rhythmus',
                'form_type' => PhysicalExaminationStep22Form::class,
            ],
            23 => [
                'label' => 'Herzfrequenz',
                'form_type' => PhysicalExaminationStep23Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 22 && !$flow->getFormData()->canHaveHerzfrequenz();
                },
            ],
            24 => [
                'label' => 'Rhythmus Sonstiges',
                'form_type' => PhysicalExaminationStep24Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 22 && !$flow->getFormData()->canHaveRhythmusSonstiges();
                },
            ],
            25 => [
                'label' => 'Vorhofflimmern Detail',
                'form_type' => PhysicalExaminationStep25Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 22 && !$flow->getFormData()->canHaveVorhofflimmernDetail();
                },
            ],
            26 => [
                'label' => 'Kreislaufwirksame Medikamente',
                'form_type' => PhysicalExaminationStep26Form::class,
            ],
            27 => [
                'label' => 'Noradrenalin',
                'form_type' => PhysicalExaminationStep27Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 26 && !$flow->getFormData()->canHaveNoradrenalin();
                },
            ],
            28 => [
                'label' => 'Epinephrin',
                'form_type' => PhysicalExaminationStep28Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 26 && !$flow->getFormData()->canHaveEpinephrin();
                },
            ],
            29 => [
                'label' => 'Milrinon',
                'form_type' => PhysicalExaminationStep29Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 26 && !$flow->getFormData()->canHaveMilrinon();
                },
            ],
            30 => [
                'label' => 'Sonstiges',
                'form_type' => PhysicalExaminationStep30Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 26 && !$flow->getFormData()->canHaveKreislaufSonstiges();
                },
            ],
            31 => [
                'label' => 'Kreislaufstabilität',
                'form_type' => PhysicalExaminationStep31Form::class,
            ],
            32 => [
                'label' => 'Leg raise Test',
                'form_type' => PhysicalExaminationStep32Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 31 && !$flow->getFormData()->canHaveLegRaiseTest();
                },
            ],
            33 => [
                'label' => 'Abdomen',
                'form_type' => PhysicalExaminationStep33Form::class,
            ],
            34 => [
                'label' => 'Darmgeräusche',
                'form_type' => PhysicalExaminationStep34Form::class,
            ],
            35 => [
                'label' => 'Druckschmerz',
                'form_type' => PhysicalExaminationStep35Form::class,
            ],
            36 => [
                'label' => 'Druckschmerz Lokalisation',
                'form_type' => PhysicalExaminationStep36Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 35 && !$flow->getFormData()->canHaveDruckschmerzLokalisation();
                },
            ],
            37 => [
                'label' => 'Stuhlgang',
                'form_type' => PhysicalExaminationStep37Form::class,
            ],
            38 => [
                'label' => 'Nierenfuntkion',
                'form_type' => PhysicalExaminationStep38Form::class,
            ],
            39 => [
                'label' => 'Diuretikagabe',
                'form_type' => PhysicalExaminationStep39Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 38 && !$flow->getFormData()->canHaveDiuretika();
                },
            ],
            40 => [
                'label' => 'Restausscheidung',
                'form_type' => PhysicalExaminationStep40Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 35 && !$flow->getFormData()->canHaveRestausscheidung();
                },
            ],
            41 => [
                'label' => 'Bilanz',
                'form_type' => PhysicalExaminationStep41Form::class,
            ],
            42 => [
                'label' => 'Ödeme',
                'form_type' => PhysicalExaminationStep42Form::class,
            ],
            43 => [
                'label' => 'Extremitäten',
                'form_type' => PhysicalExaminationStep43Form::class,
            ],
            44 => [
                'label' => 'Fußpulse',
                'form_type' => PhysicalExaminationStep44Form::class,
            ],
            45 => [
                'label' => 'Ernährung',
                'form_type' => PhysicalExaminationStep45Form::class,
            ],
            46 => [
                'label' => 'Ernährungsform',
                'form_type' => PhysicalExaminationStep46Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 45 && !$flow->getFormData()->canHaveErnaehrungsform();
                },
            ],
            47 => [
                'label' => 'Punktionsstellen',
                'form_type' => PhysicalExaminationStep47Form::class,
            ],
            48 => [
                'label' => 'Restausscheidung',
                'form_type' => PhysicalExaminationStep48Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 47 && !$flow->getFormData()->canHavePunktionsstellen();
                },
            ],
            49 => [
                'label' => 'ECMO',
                'form_type' => PhysicalExaminationStep49Form::class,
            ],
            50 => [
                'label' => 'ECMO Details',
                'form_type' => PhysicalExaminationStep50Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 47 && !$flow->getFormData()->canHaveECMO();
                },
            ],
            51 => [
                'label' => 'Impella',
                'form_type' => PhysicalExaminationStep51Form::class,
                'skip' => function ($estimatedCurrentStepNumber, FormFlowInterface $flow) {
                    return $estimatedCurrentStepNumber > 47 && !$flow->getFormData()->canHaveImpella();
                },
            ],
            52 => [
                'label' => 'Sonstiges',
                'form_type' => PhysicalExaminationStep52Form::class,
            ],
            53 => [
                'label' => 'Bestätigung',
            ],
        ];
    }
}
