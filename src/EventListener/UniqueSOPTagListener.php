<?php

namespace App\EventListener;

use App\Entity\SOP;
use App\Entity\SOPTag;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class UniqueSOPTagListener
{
    public function prePersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof SOP) {
            return;
        }

        $entityManager = $args->getEntityManager();
        $tags = $entity->getTag();

        foreach ($tags as $key => $tag) {
            $results = $entityManager->getRepository(SOPTag::class)->findBy(['name' => $tag->getName()], ['id' => 'ASC']);

            if (count($results) > 0) {
                $tags[$key] = $results[0];
            }
        }
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof SOP) {
            return;
        }

        $entityManager = $args->getEntityManager();
        $tags = $entity->getTag();

        foreach ($tags as $tag) {
            $results = $entityManager->getRepository(SOPTag::class)->findBy(['name' => $tag->getName()], ['id' => 'ASC']);

            if (count($results) > 1) {
                $knownTag = $results[0];
                $entity->addTag($knownTag);

                $duplicatedTag = $results[1];
                $entityManager->remove($duplicatedTag);
            } else {
                $entity->addTag($tag);
            }
        }
    }
}
