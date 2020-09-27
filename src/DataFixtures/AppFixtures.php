<?php

namespace App\DataFixtures;

use App\Factory\ContactCategoryFactory;
use App\Factory\ContactFactory;
use App\Factory\InfoFactory;
use App\Factory\NoteFactory;
use App\Factory\SnippetCategoryFactory;
use App\Factory\SnippetFactory;
use App\Factory\SOPFactory;
use App\Factory\SOPTagFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Before adding any content clear up the /public/uploads directory
        $filesystem = new Filesystem();
        $dir = getcwd().'/public/uploads';

        try {
            if ($filesystem->exists($dir)) {
                $filesystem->remove($dir);
            }

            $filesystem->mkdir($dir, 0775);
        } catch (IOExceptionInterface $exception) {
            echo 'Warning: Could not clean up the uploads directory';
        }

        // Adding new contents for the whole app
        ContactCategoryFactory::new()->createMany(rand(1, 3));
        ContactFactory::new()->createMany(rand(10, 20), function () {
            return [
                'category' => ContactCategoryFactory::random(),
            ];
        });
        InfoFactory::new()->createMany(rand(1, 5));
        SOPTagFactory::new()->createMany(2);
        SOPFactory::new()->createMany(rand(5, 10), function () {
            return [
                'tag' => SOPTagFactory::randomRange(1, 2),
            ];
        });
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
