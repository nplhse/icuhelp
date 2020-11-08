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
        return preg_replace('/\#Name\#/', $name, $text);
    }

    private function renderGender($text, $gender)
    {
        if ('label.choice.male' === $gender) {
            $text = preg_replace_callback(
                '/\^(.*?)\^/si',
                function ($match) {
                    return str_replace('/\^(.*?)\^/si', $match[0], $match[1]);
                },
                $text
            );

            $text = preg_replace_callback(
                '/~(.*?)~/si',
                function ($match) {
                    return str_replace('/~(.*?)~/si', $match[1], '');
                },
                $text
            );
        } elseif ('label.choice.female' === $gender) {
            $text = preg_replace_callback(
                '/\^(.*?)\^/si',
                function ($match) {
                    return str_replace('/\^(.*?)\^/si', $match[1], '');
                },
                $text
            );

            $text = preg_replace_callback(
                '/~(.*?)~/si',
                function ($match) {
                    return str_replace('/~(.*?)~/si', $match[0], $match[1]);
                },
                $text
            );
        } else {
            return false;
        }

        return $text;
    }
}
