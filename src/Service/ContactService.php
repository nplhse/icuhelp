<?php

namespace App\Service;

use App\Repository\ContactRepository;

class ContactService
{
    private $contactRepository;

    public function __construct(ContactRepository $contactRepository)
    {
        $this->contactRepository = $contactRepository;
    }

    public function getAllContacts()
    {
        return $this->contactRepository->findAll();
    }
}
