<?php


namespace App\Exception;

use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;

class UserIsInactiveException extends CustomUserMessageAccountStatusException
{
}