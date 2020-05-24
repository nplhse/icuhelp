<?php

namespace App\Service;

use App\Form\Model\LetterTypeModel;

class LetterBuilder
{
    public function build(LetterTypeModel $letterTypeModel, SnippetHelper $snippetHelper)
    {
        $result = [];
        $i = 0;

        $snippets = $letterTypeModel->getSnippets();
        $snippets = $snippetHelper->sortSnippets($snippets);

        foreach ($snippets as $snippet) {
            $text = $snippet->getText();

            $text = $this->renderName($text, $letterTypeModel->getName());
            $text = $this->renderGender($text, $letterTypeModel->getGender());

            $result[$i++] = $text;
        }

        return $result;
    }

    private function renderName($text, $name)
    {
        return preg_replace('#\#(.*)\##', $name, $text);
    }

    private function renderGender($text, $gender)
    {
        if ('label.choice.male' === $gender) {
            preg_match('#\^(.*)\^#', $text, $match, PREG_UNMATCHED_AS_NULL);

            if (!empty($match)) {
                $text = preg_replace('#\^(.*)\^#', $match[1], $text);
                $text = preg_replace('#\~(.*)\~#', '', $text);
            }
        } elseif ('label.choice.female' === $gender) {
            preg_match('#\~(.*)\~#', $text, $match, PREG_UNMATCHED_AS_NULL);

            if (!empty($match)) {
                $text = preg_replace('#\^(.*)\^#', '', $text);
                $text = preg_replace('#\~(.*)\~#', $match[1], $text);
            }
        } else {
            return false;
        }

        return $text;
    }
}
