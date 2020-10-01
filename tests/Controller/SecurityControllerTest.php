<?php

namespace App\Tests\Controller;

use App\Tests\AbstractWebTest;
use Faker\Factory;

class SecurityControllerTest extends AbstractWebTest
{
    public function testUserLifecycle()
    {
        $faker = Factory::create();

        $username = $faker->userName;
        $password = $faker->password(6, 10);
        $email = $faker->safeEmail;

        $client = $this->getAnonymousClient();
        $crawler = $client->request('GET', '/register');

        $client->followRedirects();
        $client->enableProfiler();

        $this->assertResponseIsSuccessful();

        // Fill out the form
        $form = $crawler->selectButton('Register')->form();
        $form['registration_form[username]'] = $username;
        $form['registration_form[plainPassword][first]'] = $password;
        $form['registration_form[plainPassword][second]'] = $password;
        $form['registration_form[email]'] = $email;

        // Submit the form
        $crawler = $client->submit($form);
        $response = $client->getResponse()->getContent();

        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertSelectorTextContains('html body', 'Logged in as: '.$username);
        $this->assertSelectorTextContains('html h1', 'Your account is inactive');

        // TODO: Finish the tests with catching the mail, activating the account etc.
    }
}
