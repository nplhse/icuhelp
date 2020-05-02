<?php

namespace App\Controller;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends EasyAdminController
{
    protected $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    protected function persistUserEntity($user)
    {
        if (!$user->getPlainPassword()) {
            return;
        }

        $encodedPassword = $this->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($encodedPassword);
        $user->eraseCredentials();

        parent::persistEntity($user);
    }

    protected function updateUserEntity($user)
    {
        if (!$user->getPlainPassword()) {
            return;
        }

        $encodedPassword = $this->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($encodedPassword);
        $user->eraseCredentials();

        parent::updateEntity($user);
    }

    private function encodePassword($user, $password)
    {
        return $this->passwordEncoder->encodePassword($user, $password);
    }
}