<?php

namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;

class SnippetHelper
{
    public function sortSnippets($snippets)
    {
        if ($snippets instanceof ArrayCollection) {
            $iterator = $snippets->getIterator();

            $iterator->uasort(function ($a, $b) {
                return $this->compareSnippets($a, $b);
            });

            $snippets = new ArrayCollection(iterator_to_array($iterator));

            return $snippets;
        } elseif (is_array($snippets)) {
            uasort($snippets, function ($a, $b) {
                return $this->compareSnippets($a, $b);
            });

            return $snippets;
        }

        return null;
    }

    public function compareSnippets($a, $b)
    {
        $al = strtolower($a->getCategory()->getPriority());
        $bl = strtolower($b->getCategory()->getPriority());

        if ($al == $bl) {
            return 0;
        }

        return ($al > $bl) ? +1 : -1;
    }
}
