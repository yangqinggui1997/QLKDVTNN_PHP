<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hangtonct
 *
 * @author DELL
 */
class hangtonct {
    //put your code here
    
    private $IdHT;
    private $IdSP;
    private $SLTon;
    
    public function __construct($IdHT, $IdSP, $SLTon) {
        $this->IdHT = $IdHT;
        $this->IdSP = $IdSP;
        $this->SLTon = $SLTon;
    }

    public function getIdHT() {
        return $this->IdHT;
    }

    public function getIdSP() {
        return $this->IdSP;
    }

    public function getSLTon() {
        return $this->SLTon;
    }

    public function setIdHT($IdHT) {
        $this->IdHT = $IdHT;
    }

    public function setIdSP($IdSP) {
        $this->IdSP = $IdSP;
    }

    public function setSLTon($SLTon) {
        $this->SLTon = $SLTon;
    }

}
