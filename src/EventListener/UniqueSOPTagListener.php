<?php

namespace App\EventListener;

use App\Entity\SOP;
use App\Entity\SOPTag;
use Doctrine\ORM\Event\LifecycleEventArgs;

class UniqueSOPTagListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // we're interested in Dishes only
        if ($entity instanceof SOP) {
            $entityManager = $args->getEntityManager();
            $tags = $entity->getTag();

            foreach ($tags as $key => $tag) {
                // let's check for existance of this ingredient
                $results = $entityManager->getRepository(SOPTag::class)->findBy(['name' => $tag->getName()], ['id' => 'ASC']);

                // if ingredient exists use the existing ingredient
                if (count($results) > 0) {
                    $tags[$key] = $results[0];
                }
            }
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        // we're interested in Dishes only
        if ($entity instanceof SOP) {
            $entityManager = $args->getEntityManager();
            $tags = $entity->getTag();

            foreach ($tags as $tag) {
                // let's check for existance of this ingredient
                // find by name and sort by id keep the older ingredient first
                $results = $entityManager->getRepository(SOPTag::class)->findBy(['name' => $tag->getName()], ['id' => 'ASC']);

                // if ingredient exists at least two rows will be returned
                // keep the first and discard the second
                if (count($results) > 1) {
                    $knownTag = $results[0];
                    $entity->addTag($knownTag);

                    // remove the duplicated ingredient
                    $duplicatedTag = $results[1];
                    $entityManager->remove($duplicatedTag);
                } else {
                    // ingredient doesn't exist yet, add relation
                    $entity->addTag($tag);
                }
            }
        }
    }
}
