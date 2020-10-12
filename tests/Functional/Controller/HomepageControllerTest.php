<?php

namespace App\Tests\Functional\Controller;

use App\Tests\Functional\AbstractWebTest;

class HomepageControllerTest extends AbstractWebTest
{
    public function testHomepage()
    {
        $client = $this->getAuthenticatedClient();
        $client->followRedirects();

        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html h1', 'Welcome to ICUhelp');
    }
}
