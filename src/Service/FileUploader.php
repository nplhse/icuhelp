<?php

namespace App\Service;

use App\Model\AbstractFileModel;
use League\Flysystem\FilesystemInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private $filesystem;

    public function __construct(FilesystemInterface $uploadsStorage)
    {
        $this->filesystem = $uploadsStorage;
    }

    public function upload(AbstractFileModel $file)
    {
        $uniqueName = $this->generateRandomName($file);

        $file->setName($uniqueName);
        $file->setPath('test');
        $file->setSize($file->getFile()->getSize());

        // Sets common metadata depending how the file has been created on the server (uploaded or not).
        if ($file->getFile() instanceof UploadedFile) {
            $file->setOriginalName($file->getFile()->getClientOriginalName());
            $file->setExtension($file->getFile()->getClientOriginalName());
            $file->setMimeType($file->getFile()->getClientMimeType());
        } else {
            $file->setOriginalName($uniqueName);
            $file->setExtension($file->getFile()->getExtension());
            $file->setMimeType($file->getFile()->getMimeType());
        }

        try {
            $stream = fopen($file->getPath(), 'r');
            $result = $this->filesystem->writeStream($uniqueName, $stream);
        } catch (\Exception $e) {
            throw new \Exception(sprintf('Could not write uploaded file "%s"', $uniqueName));
        }

        if (is_resource($stream)) {
            fclose($stream);
        }

        return $uniqueName;
    }

    private function generateRandomName(AbstractFileModel $file): string
    {
        $randomName = bin2hex(random_bytes(24));
        $extension = '';

        if ($file->getFile() instanceof UploadedFile) {
            $extension = $file->getFile()->getClientOriginalExtension();
        } else {
            $extension = $file->getFile()->getExtension();
        }

        // Sanitizes extension.
        $extension = preg_replace('/[^\w-]/', '', $extension);

        if (!empty($extension)) {
            $extension = '.'.$extension;
        }

        return $randomName.$extension;
    }
}
