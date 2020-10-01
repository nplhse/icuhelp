<?php

namespace App\Controller;

use App\Repository\UploadRepository;
use App\Service\FileUploader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @IsGranted("ROLE_USER")
 */
class UploadController extends AbstractController
{
    /**
     * @Route("/uploads/{path}", name="uploads_showprivatefile")
     */
    public function showPrivateFile(UploadRepository $uploadRepository, FileUploader $fileUploader, $path)
    {
        $result = $uploadRepository->findOneByPath($path);
        $reference = $result[0];

        $response = new StreamedResponse(function () use ($reference, $fileUploader) {
            $outputStream = fopen('php://output', 'wb');
            $fileStream = $fileUploader->readStream($reference->getName(), false);
            stream_copy_to_stream($fileStream, $outputStream);
        });

        $response->headers->set('Content-Type', $reference->getMimeType());

        return $response;
    }
}
