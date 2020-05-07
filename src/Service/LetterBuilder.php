<?php

namespace App\Service;

use App\Form\Model\LetterTypeModel;

class LetterBuilder
{
    public function build(LetterTypeModel $letterTypeModel)
    {
        $result = [];
        $i = 0;

        foreach ($letterTypeModel->getSnippets() as $snippet) {
            $text = $snippet->getText();
            $text = preg_replace('#\@(.*)\@#', $letterTypeModel->getName(), $text);

            if ('label.choice.male' === $letterTypeModel->getGender()) {
                preg_match('#\^(.*)\^#', $text, $match);
                $text = preg_replace('#\^(.*)\^#', $match[1], $text);
                $text = preg_replace('#\~(.*)\~#', '', $text);
            } elseif ('label.choice.female' === $letterTypeModel->getGender()) {
                preg_match('#\~(.*)\~#', $text, $match);
                $text = preg_replace('#\^(.*)\^#', '', $text);
                $text = preg_replace('#\~(.*)\~#', $match[1], $text);
            }

            $result[$i++] = $text;
        }

        return $result;
    }
}
