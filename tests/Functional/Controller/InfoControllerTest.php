<?php

namespace App\Tests\Functional\Controller;

use App\Tests\Functional\AbstractWebTest;
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
        $this->assertSelectorTextContains('html body', 'Successfully created new info.');
        $this->assertSelectorTextContains('html body', 'Updated at a few seconds ago');

        $crawler = $client->clickLink($title);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html body', 'Edit info');

        $crawler = $client->clickLink('Edit info');
        $client->followRedirects(true);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html h1', 'Edit info');

        $crawler = $client->submitForm('Save info', [
            'info[name]' => $title.'edited',
            'info[text]' => $text.'edited',
        ]);

        dump($client->getResponse()->getContent());

        //$this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('html h5', $title.'edited');
        $this->assertSelectorTextContains('html body', 'Successfully edited the info.');
        $this->assertSelectorTextContains('html body', 'Updated at a few seconds ago');
    }
}
