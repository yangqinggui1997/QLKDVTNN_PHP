<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hoadonbanct
 *
 * @author DELL
 */
class hoadonbanct {
    //put your code here
    
    private $IdHDB;
    private $IdSP;
    private $SL;
    private $DonGia;
    private $GiamGia;
    private $ThanhTien;
    
    public function __construct($IdHDB, $IdSP, $SL, $DonGia, $GiamGia, $ThanhTien) {
        $this->IdHDB = $IdHDB;
        $this->IdSP = $IdSP;
        $this->SL = $SL;
        $this->DonGia = $DonGia;
        $this->GiamGia = $GiamGia;
        $this->ThanhTien = $ThanhTien;
    }

    public function getIdHDB() {
        return $this->IdHDB;
    }

    public function getIdSP() {
        return $this->IdSP;
    }

    public function getSL() {
        return $this->SL;
    }

    public function getDonGia() {
        return $this->DonGia;
    }

    public function getGiamGia() {
        return $this->GiamGia;
    }

    public function getThanhTien() {
        return $this->ThanhTien;
    }

    public function setIdHDB($IdHDB) {
        $this->IdHDB = $IdHDB;
    }

    public function setIdSP($IdSP) {
        $this->IdSP = $IdSP;
    }

    public function setSL($SL) {
        $this->SL = $SL;
    }

    public function setDonGia($DonGia) {
        $this->DonGia = $DonGia;
    }

    public function setGiamGia($GiamGia) {
        $this->GiamGia = $GiamGia;
    }

    public function setThanhTien($ThanhTien) {
        $this->ThanhTien = $ThanhTien;
    }

}
