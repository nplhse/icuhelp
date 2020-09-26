<?php

namespace App\Entity;

use App\Repository\SOPTagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SOPTagRepository::class)
 */
class SOPTag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=SOP::class, mappedBy="tag", cascade={"persist"})
     */
    private $SOPs;

    public function __construct()
    {
        $this->SOPs = new ArrayCollection();
    }

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

    /**
     * @return Collection|SOP[]
     */
    public function getSOPs(): Collection
    {
        return $this->SOPs;
    }

    public function addSOP(SOP $sOP): self
    {
        if (!$this->SOPs->contains($sOP)) {
            $this->SOPs[] = $sOP;
            $sOP->addTag($this);
        }

        return $this;
    }

    public function removeSOP(SOP $sOP): self
    {
        if ($this->SOPs->contains($sOP)) {
            $this->SOPs->removeElement($sOP);
            $sOP->removeTag($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
