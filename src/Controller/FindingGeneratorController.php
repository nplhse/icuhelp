<?php

namespace App\Controller;

use App\Form\Model\PhysicalExaminationModel;
use App\Form\PhysicalExaminationFlow;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FindingGeneratorController extends AbstractController
{
    /**
     * @Route("/findings", name="finding_generator")
     */
    public function index(PhysicalExaminationFlow $flow)
    {
        $exam = new PhysicalExaminationModel();
        $flow->bind($exam);

        // form of the current step
        $form = $flow->createForm();
        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                return $this->render('finding_generator/display.html.twig', [
                    'exam' => $exam,
                ]);
            }
        }

        return $this->render('finding_generator/index.html.twig', [
            'form' => $form->createView(),
            'flow' => $flow,
        ]);
    }
}
