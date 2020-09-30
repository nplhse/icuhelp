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
        $formData = new PhysicalExaminationModel();

        $flow->bind($formData);

        // form of the current step
        $form = $flow->createForm();
        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                dump($formData);
                $flow->reset(); // remove step data from the session

                return $this->redirect($this->generateUrl('homepage'));
            }
        }

        return $this->render('finding_generator/index.html.twig', [
            'form' => $form->createView(),
            'flow' => $flow,
        ]);
    }
}
