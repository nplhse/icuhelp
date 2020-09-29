<?php

namespace App\Entity;

use App\Model\AbstractFileModel;
use App\Repository\UploadRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=UploadRepository::class)
 */
class Upload extends AbstractFileModel
{
    /**
     * @ORM\Column(type="uuid")
     */
    private $uuid;

    public function __construct()
    {
        parent::__construct(true);
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setOriginalName(?string $originalName): self
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function setExtension(?string $extension): self
    {
        $this->extension = $extension;

        return $this;
    }

    public function setMimeType(?string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setPath(?string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function setPrivate(?bool $private): self
    {
        $this->private = $private;

        return $this;
    }

    public function setFile(?File $file): self
    {
        $this->file = $file;

        return $this;
    }
}
