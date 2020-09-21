<?php

namespace App\DataFixtures;

use App\Factory\ContactFactory;
use App\Factory\InfoFactory;
use App\Factory\NoteFactory;
use App\Factory\SnippetCategoryFactory;
use App\Factory\SnippetFactory;
use App\Factory\SOPFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        ContactFactory::new()->createMany(rand(10, 20));
        InfoFactory::new()->createMany(rand(1, 5));
        SOPFactory::new()->createMany(rand(1, 10));
        NoteFactory::new()->createMany(rand(1, 5));
        NoteFactory::new()->asOnboarding()->createMany(rand(1, 5));
        SnippetCategoryFactory::new()->createMany(rand(1, 5));
        SnippetFactory::new()->createMany(rand(5, 15), function () {
            return [
                'category' => SnippetCategoryFactory::random(),
            ];
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
