<?php

namespace App\Tests\Controller;

use App\Tests\AbstractWebTest;

class HomepageControllerTest extends AbstractWebTest
{
    public function testHomepage()
    {
        $client = $this->getAuthenticatedClient();
        $client->followRedirects();

        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html h1', 'Welcome to ICUhelp');
    }
}