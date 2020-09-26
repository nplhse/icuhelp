<?php

namespace App\Form\DataTransformer;

use App\Entity\SOPTag;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\DataTransformerInterface;

class SOPTagToCollectionTransformer implements DataTransformerInterface
{
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function transform($entity)
    {
        return $entity;
    }

    public function reverseTransform($entity)
    {
        $tagCollection = new ArrayCollection();
        $tagsRepository = $this->manager->getRepository(SOPTag::class);

        $tags = $entity->getTag();

        foreach ($tags as $tag) {
            $tagInRepo = $tagsRepository->findOneByName($tag->getName());

            if (null !== $tagInRepo) {
                // Add tag from repository if found
                $tagCollection->add($tagInRepo);
            } else {
                // Otherwise add new tag
                $tagCollection->add($tag);
            }
        }

        return $entity;
    }
}
