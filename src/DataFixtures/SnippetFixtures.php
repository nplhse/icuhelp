<?php

namespace App\DataFixtures;

use App\Entity\Snippet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SnippetFixtures extends Fixture
{
    private $encoder;

    /**
     * Create and store Snippet fixtures in the database.
     */
    public function load(ObjectManager $manager)
    {
        foreach ($this->getData() as $data) {
            $snippet = new Snippet();
            $snippet->setName($data['name']);
            $snippet->setCategory($this->getReference(SnippetCategoryFixtures::SNIPPET_CATEGORY_REFERENCE));
            $snippet->setText($data['text']);

            $manager->persist($snippet);
        }

        $manager->flush();
    }

    /**
     * Returns data for the default User objects we want to create.
     *
     * @return array
     */
    public function getData()
    {
        return
            [
                [
                    'name' => 'Demo snippet',
                    'text' => 'This is just a demo snippet for ^Mr^~Mrs~ #Name#. And it works. Yay!',
                ],
            ];
    }
}