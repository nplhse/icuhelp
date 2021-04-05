<?php

namespace App\Twig;

use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TimeAgoExtension extends AbstractExtension
{
    private $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('timeago', [$this, 'generateTime']),
        ];
    }

    public function generateTime($datetime)
    {
        $time = time() - $datetime->getTimestamp();

        $units = [
            31536000 => $this->translator->trans('date.year'),
            2592000 => $this->translator->trans('date.month'),
            604800 => $this->translator->trans('date.week'),
            86400 => $this->translator->trans('date.day'),
            3600 => $this->translator->trans('date.hour'),
            60 => $this->translator->trans('date.minute'),
            1 => $this->translator->trans('date.second'),
        ];

        foreach ($units as $unit => $val) {
            if ($time < $unit) {
                continue;
            }

            $numberOfUnits = floor($time / $unit);

            return ($this->translator->trans('date.second') == $val) ? $this->translator->trans('date.seconds.ago') :
                (($numberOfUnits > 1) ? $numberOfUnits : '1')
                .' '.(($numberOfUnits > 1) ? $val : substr($val, 0, -1));
        }
    }
}
