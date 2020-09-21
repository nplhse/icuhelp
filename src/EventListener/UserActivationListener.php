<?php

namespace App\EventListener;

use App\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserActivationListener
{
    private TokenStorageInterface $security;

    private RouterInterface $router;

    private array $excludedRoutes = [
        'security_login',
        'security_logout',
        'security_inactive_user',
        'security_verify_email',
    ];

    public function __construct(TokenStorageInterface $security, RouterInterface $router)
    {
        $this->security = $security;
        $this->router = $router;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        if (false === $event->isMasterRequest()) {
            return;
        }

        if ($event->getRequest()->isXmlHttpRequest()) {
            return;
        }

        $currentRoute = $event->getRequest()->get('_route');
        if (\in_array($currentRoute, $this->excludedRoutes, true)) {
            return;
        }

        $token = $this->security->getToken();

        if (null === $token) {
            return;
        }

        $user = $token->getUser();

        if ($user instanceof User && !$user->getIsActive()) {
            $response = new RedirectResponse($this->router->generate('security_inactive_user'));
            $event->setResponse($response);
        }
    }
}
