<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginLogout()
    {
        $username = 'foo';
        $password = 'bar';

        $client = static::createClient();
        $client->followRedirects(true);

        $crawler = $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Anmelden');

        // Fill out the form
        $form = $crawler->selectButton('Anmelden')->form();
        $form['security_login[username]'] = $username;
        $form['security_login[password]'] = $password;

        // Submit the form
        $crawler = $client->submit($form);
        $response = $client->getResponse()->getContent();

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Angemeldet als: '.$username.'")')->count());

        // And logout
        $crawler = $client->request('GET', '/logout');
        $this->assertGreaterThan(0, $crawler->filter('html:contains("Anmelden")')->count());

    }
}
