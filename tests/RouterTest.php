<?php

namespace App\Tests;

use Exception;

class RouterTest extends AbstractWebTest
{
    /**
     * @dataProvider providePublicUrls
     */
    public function testPublicPageAsAnonymousUserIsSuccessful(string $method, string $url): void
    {
        $client = $this->getAnonymousClient();

        $client->request($method, $url);
        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertTrue($this->isExpectedStatusCode($statusCode), "Got $statusCode response");
    }

    /**
     * @dataProvider providePrivateUrls
     */
    public function testPrivatePageAsAnonymousUserIsRedirectToLogin(string $method, string $url): void
    {
        $client = $this->getAnonymousClient();

        $client->request($method, $url);

        $this->assertTrue($client->getResponse()->isRedirect('/login'));
    }

    /**
     * @dataProvider providePrivateUrls
     */
    public function testPrivatePageAsAuthenticatedUserIsSuccessful(string $method, string $url): void
    {
        $client = $this->getAuthenticatedClient();

        $client->request($method, $url);
        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertTrue($this->isExpectedStatusCode($statusCode), "Got $statusCode response");
    }

    public function providePrivateUrls(): array
    {
        return [
            ['GET', '/homepage'],
        ];
    }

    public function providePublicUrls(): array
    {
        // ['METHOD', '/path']
        return [
            ['GET', '/login'],
            ['GET', '/register'],
            ['GET', '/verify-email'],
            ['GET', '/reset-password'],
            ['GET', '/reset-password/check-email'],
            ['GET', '/reset-password/reset/token'],
        ];
    }
}
