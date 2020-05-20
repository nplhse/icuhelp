<?php

namespace App\DataFixtures;

use App\Entity\SnippetCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SnippetCategoryFixtures extends Fixture
{
    public const SNIPPET_CATEGORY_REFERENCE = 'SnippetCategory';

    public function load(ObjectManager $manager)
    {
        $snippet = new SnippetCategory();
        $snippet->setName('Demo category');

        $manager->persist($snippet);
        $manager->flush();

        $this->addReference(self::SNIPPET_CATEGORY_REFERENCE, $snippet);
    }
}