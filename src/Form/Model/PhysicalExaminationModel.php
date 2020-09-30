<?php

namespace App\Form\Model;

class PhysicalExaminationModel
{
    public $vigilanz;

    public $ansprechbarkeit;

    public $rass_index;

    public $orientierung;

    public $cam_index;

    public $pupillen_isokorie;

    public $pupillen_lichtreagibilitaet;

    public $sensomotorischedefizite;

    public $sensomotorischedefizite_detail;

    public function canHaveAnsprechbarkeit()
    {
        if ('analgosediert' == $this->vigilanz) {
            return false;
        }

        return true;
    }

    public function canHaveOrientierung()
    {
        if ('analgosediert' == $this->vigilanz) {
            return false;
        }

        return true;
    }

    public function canHaveRASS()
    {
        if ('analgosediert' == $this->vigilanz) {
            return true;
        }

        return false;
    }

    public function canHaveCAM()
    {
        if ('analgosediert' == $this->vigilanz or 'desorientiert' == $this->orientierung) {
            return false;
        }

        return true;
    }

    public function canHaveSensomotorischesDefizitDetail()
    {
        if ('vorhanden' == $this->sensomotorischedefizite) {
            return true;
        }

        return false;
    }

    public function generate()
    {
        $output = '';
        $output .= ucfirst($this->vigilanz);
        if ($this->canHaveAnsprechbarkeit()) {
            $output .= ', '.$this->ansprechbarkeit;
        }
        if ($this->canHaveOrientierung()) {
            $output .= ', '.$this->orientierung;
        }
        if ($this->canHaveRASS()) {
            $output .= ', RAAS: '.$this->rass_index.'.';
        }
        if ($this->canHaveCAM()) {
            $output .= ', CAM-ICU: '.$this->cam_index.'.';
        }
        $output .= ' Pupillen '.$this->pupillen_isokorie.', '.$this->pupillen_lichtreagibilitaet.' lichtreagibel.';
        $output .= ' Sensomotorische Defizite '.$this->sensomotorischedefizite;
        if ($this->canHaveSensomotorischesDefizitDetail()) {
            $output .= ': '.$this->sensomotorischedefizite_detail.'.';
        } else {
            $output .= '.';
        }

        return $output;
    }
}
