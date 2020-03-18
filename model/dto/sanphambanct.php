<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sanphambanct
 *
 * @author DELL
 */
class sanphambanct {
    //put your code here
    
    private $IdSPB;
    private $IdSP;
    private $SLBan;
    
    public function __construct($IdSPB, $IdSP, $SLBan) {
        $this->IdSPB = $IdSPB;
        $this->IdSP = $IdSP;
        $this->SLBan = $SLBan;
    }

    public function getIdSPB() {
        return $this->IdSPB;
    }

    public function getIdSP() {
        return $this->IdSP;
    }

    public function getSLBan() {
        return $this->SLBan;
    }

    public function setIdSPB($IdSPB) {
        $this->IdSPB = $IdSPB;
    }

    public function setIdSP($IdSP) {
        $this->IdSP = $IdSP;
    }

    public function setSLBan($SLBan) {
        $this->SLBan = $SLBan;
    }
}
