<?php

namespace App\Security;

use App\Entity\User as AppUser;
use App\Exception\UserCredentialsExpiredException;
use App\Exception\UserIsInactiveException;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        if (!$user->getIsActive()) {
            // the message passed to this exception is meant to be displayed to the user
            throw new UserIsInactiveException('Your user account is inactive, for more information contact your administrator.');
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user account is expired, the user may be notified
        if (!$user->getIsCredentialsNonExpired()) {
            throw new UserCredentialsExpiredException('Your credentials are expired. Click on Forgot password to change them.');
        }
    }
}
