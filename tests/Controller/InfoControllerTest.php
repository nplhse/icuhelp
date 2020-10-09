<?php

namespace App\Tests\Controller;

use App\Tests\AbstractWebTest;
use Faker\Factory;

class InfoControllerTest extends AbstractWebTest
{
    public function testInfoLifecycle()
    {
        $faker = Factory::create();

        $title = $faker->sentence(3);
        $text = $faker->paragraph(5);

        $client = $this->getAuthenticatedClient('ROLE_ADMIN');
        $client->followRedirects();

        $client->request('GET', '/info');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html h1', 'Infos');

        $crawler = $client->clickLink('Create new info');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html h1', 'Create new info');

        $crawler = $client->submitForm('Create info', [
            'info[name]' => $title,
            'info[text]' => $text,
        ]);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html h5', $title);
    }
}
