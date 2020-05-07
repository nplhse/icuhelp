<?php

namespace App\Form\Model;

class LetterTypeModel
{
    public $id;

    public $name;

    public $gender;

    public $snippets;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param mixed $gender
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    /**
     * @return array
     */
    public function getSnippets()
    {
        return $this->snippets;
    }

    /**
     * @param array $snippets
     */
    public function setSnippets($snippets)
    {
        $this->snippets = $snippets;
    }
}
