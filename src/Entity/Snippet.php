<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SnippetRepository")
 */
class Snippet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity=SnippetCategory::class)
     * @ORM\JoinColumn()
     */
    private $category;

    /**
     * @ORM\Column(type="text")
     */
    private $text;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?SnippetCategory
    {
        return $this->category;
    }

    public function setCategory(?SnippetCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
