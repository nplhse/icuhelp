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

    public $atmung;

    public $o2_flow;

    public $peep;

    public $asb;

    public $fio2;

    public $pinsp;

    public $beatmung_modus;

    public $atemfrequenz;

    public $gasaustausch;

    public $gasaustausch_detail;

    public $atemgeraeusch;

    public $atemgeraeusch_lokalisation;

    public $rasselgeraeusch_charakter;

    public $hustenstoss;

    public $rhythmus;

    public $herzfrequenz;

    public $rhythmus_sonstiges;

    public $vorhofflimmern_detail;

    public $kreislauf = [];

    public $noradrenalin;

    public $epinephrin;

    public $milrinon;

    public $kreislauf_sonstiges;

    public $kreislauf_stabil;

    public $legraise_test;

    public $abdomen;

    public $darmgeraeusche;

    public $druckschmerz;

    public $druckschmerz_lokalisation;

    public $stuhlgang;

    public $nierenfunktion;

    public $diuretika;

    public $bilanz;

    public $oedeme;

    public $extremitaeten;

    public $extremitaeten_seite;

    public $fusspulse;

    public $ernaehrung;

    public $ernaehrungsform;

    public $punktionsstellen;

    public $punktionsstellen_details;

    public $ecmo;

    public $blutfluss;

    public $sweepgasfluss;

    public $impella;

    public $sonstiges;

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

    public function canHaveO2Gabe()
    {
        if ('spontan atmend' == $this->atmung) {
            return true;
        }

        return false;
    }

    public function canHaveNIV()
    {
        if ('CPAP' == $this->atmung) {
            return true;
        }

        return false;
    }

    public function canHaveHighflow()
    {
        if ('high flow' == $this->atmung) {
            return true;
        }

        return false;
    }

    public function canHaveBeatmung()
    {
        if ('intubiert' == $this->atmung) {
            return true;
        }

        return false;
    }

    public function canHaveCPAP()
    {
        if ($this->canHaveBeatmung() && 'CPAP' == $this->beatmung_modus) {
            return true;
        }

        return false;
    }

    public function canHaveBiPAP()
    {
        if ($this->canHaveBeatmung() && 'BiPAP' == $this->beatmung_modus) {
            return true;
        }

        return false;
    }

    public function canHaveGasaustauschDetail()
    {
        if ('eingeschränkt' == $this->gasaustausch) {
            return true;
        }

        return false;
    }

    public function canHaveAtemgeraeuschLokalisation()
    {
        if ('vesikulär beidseits' == $this->atemgeraeusch) {
            return false;
        }

        return true;
    }

    public function canHaveRasselgeraeuschCharakter()
    {
        if ('Rasselgeräusche' == $this->atemgeraeusch) {
            return true;
        }

        return false;
    }

    public function canHaveHustenstoss()
    {
        if ('intubiert' == $this->atmung) {
            return false;
        }

        return true;
    }

    public function canHaveHerzfrequenz()
    {
        if ('Sinusbradykardie' == $this->rhythmus or 'Sinustachykardie' == $this->rhythmus or 'Absolute arrhythmie' == $this->rhythmus) {
            return true;
        }

        return false;
    }

    public function canHaveRhythmusSonstiges()
    {
        if ('Sonstiges' == $this->rhythmus) {
            return true;
        }

        return false;
    }

    public function canHaveVorhofflimmernDetail()
    {
        if ('Absolute arrhythmie' == $this->rhythmus) {
            return true;
        }

        return false;
    }

    public function canHaveNoradrenalin()
    {
        if (in_array('Noradrenalin', $this->kreislauf)) {
            return true;
        }

        return false;
    }

    public function canHaveEpinephrin()
    {
        if (in_array('Epinephrin', $this->kreislauf)) {
            return true;
        }

        return false;
    }

    public function canHaveMilrinon()
    {
        if (in_array('Milrinon', $this->kreislauf)) {
            return true;
        }

        return false;
    }

    public function canHaveKreislaufSonstiges()
    {
        if (in_array('Sonstiges', $this->kreislauf)) {
            return true;
        }

        return false;
    }

    public function canHaveLegRaiseTest()
    {
        if ('instabil' == $this->kreislauf_stabil) {
            return true;
        }

        return false;
    }

    public function canHaveDruckschmerzLokalisation()
    {
        if ('vorhanden' == $this->druckschmerz) {
            return true;
        }

        return false;
    }

    public function canHaveDiuretika()
    {
        if ('Gute Ausscheidung' == $this->nierenfunktion or 'Eingeschränkte Ausscheidung' == $this->nierenfunktion) {
            return true;
        }

        return false;
    }

    public function canHaveRestausscheidung()
    {
        if ('Dialyse' == $this->nierenfunktion) {
            return true;
        }

        return false;
    }

    public function canHaveErnaehrungsform()
    {
        if ('Ja' == $this->ernaehrung) {
            return true;
        }

        return false;
    }

    public function canHavePunktionsstellen()
    {
        if ('auffällig' == $this->punktionsstellen) {
            return true;
        }

        return false;
    }

    public function canHaveECMO()
    {
        if ('veno-arteriell' == $this->ecmo) {
            return true;
        }

        return false;
    }

    public function canHaveImpella()
    {
        if ('keine' == $this->ecmo) {
            return false;
        }

        return true;
    }

    public function generate()
    {
        $output = ucfirst($this->vigilanz);

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

        $output .= ' '.ucfirst($this->atmung);
        if ($this->canHaveO2Gabe() && isset($this->o2_flow)) {
            $output .= ' ('.$this->o2_flow.'l O2/min)';
        }

        if ('CPAP' == $this->atmung && isset($this->o2_flow)) {
            $output .= ' (PEEP '.$this->peep.'mmHg, ASB '.$this->asb.'mmHg, FiO2 '.$this->fio2.'%)';
        } elseif ('high flow' == $this->atmung) {
            $output .= ' ('.$this->o2_flow.'l O2/min, FiO2 '.$this->fio2.'%)';
        } elseif ('intubiert' == $this->atmung && 'CPAP' == $this->beatmung_modus) {
            $output .= ' ('.$this->beatmung_modus.', PEEP '.$this->peep.'mmHg, ASB '.$this->asb.'mmHg, AF '.$this->atemfrequenz.'/min, FiO2 '.$this->fio2.'%)';
        } elseif ('intubiert' == $this->atmung && 'BiPAP' == $this->beatmung_modus) {
            $output .= ' ('.$this->beatmung_modus.', PEEP '.$this->peep.'mmHg, ASB '.$this->asb.'mmHg, Pinsp '.$this->atemfrequenz.', AF '.$this->atemfrequenz.'/min, FiO2 '.$this->fio2.'%)';
        }

        $output .= ' Gasaustausch '.$this->gasaustausch;

        if ('eingeschränkt' == $this->gasaustausch) {
            $output .= ' ('.$this->gasaustausch_detail.')';
        }

        return $output;
    }
}
