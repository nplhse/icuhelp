<?php

namespace App\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

abstract class AbstractFileModel
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $originalName;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $extension;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $mimeType;

    /**
     * File size in bytes.
     *
     * @var int|null
     *
     * Choose column type according to your use case:
     *   - smallint: 32.76KB max (rounded down)
     *   - integer: 2.14GB max (rounded down)
     *   - bigint: 9.22EB max (rounded down)
     * @ORM\Column(type="integer")
     */
    protected $size;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $name;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $path;

    /**
     * Determines if file will be uploaded in /public directory or in a directory outside of /public and therefore
     * reachable only through a controller (probably after some sort of authentication or validation).
     *
     * @var bool
     *
     * @ORM\Column(type="boolean")
     */
    protected $private;

    /**
     * @var File|null
     */
    protected $file;

    /**
     * AbstractFile constructor.
     */
    public function __construct(bool $private = false)
    {
        $this->private = $private;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Overwrite in final child and type hint the return as :self.
     *
     * @return $this
     */
    public function setOriginalName(?string $originalName)
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    /**
     * Overwrite in final child and type hint the return as :self.
     *
     * @return $this
     */
    public function setExtension(?string $extension)
    {
        $this->extension = $extension;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * Overwrite in final child and type hint the return as :self.
     *
     * @return $this
     */
    public function setMimeType(?string $mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    /**
     * Overwrite in final child and type hint the return as :self.
     *
     * @return $this
     */
    public function setSize(?int $size)
    {
        $this->size = $size;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * Overwrite in final child and type hint the return as :self.
     *
     * @return $this
     */
    public function setName(?string $name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Overwrite in final child and type hint the return as :self.
     *
     * @return $this
     */
    public function setPath(?string $path)
    {
        $this->path = $path;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * Overwrite in final child and type hint the return as :self.
     *
     * @return $this
     */
    public function setPrivate(?bool $private)
    {
        $this->private = $private;

        return $this;
    }

    public function isPrivate(): bool
    {
        return $this->private;
    }

    /**
     * Overwrite in final child and type hint the return as :self.
     *
     * @return $this
     */
    public function setFile(?File $file)
    {
        $this->file = $file;

        return $this;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function getOriginalNameWithExtension(): string
    {
        return $this->getOriginalName().'.'.$this->getExtension();
    }
}
