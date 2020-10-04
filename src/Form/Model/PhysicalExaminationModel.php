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

    public $restausscheidung;

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

    public $ecmo_fio2;

    public $impella;

    public $sonstiges;

    public function canHaveAnsprechbarkeit()
    {
        if ('flach analgosediert' == $this->vigilanz or 'tief analgosediert' == $this->vigilanz) {
            return false;
        }

        return true;
    }

    public function canHaveOrientierung()
    {
        if ('flach analgosediert' == $this->vigilanz or 'tief analgosediert' == $this->vigilanz) {
            return false;
        }

        return true;
    }

    public function canHaveRASS()
    {
        if ('flach analgosediert' == $this->vigilanz or 'tief analgosediert' == $this->vigilanz) {
            return true;
        }

        return false;
    }

    public function canHaveCAM()
    {
        if ('flach analgosediert' == $this->vigilanz or 'tief analgosediert' == $this->vigilanz or 'desorientiert' == $this->orientierung) {
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
}
