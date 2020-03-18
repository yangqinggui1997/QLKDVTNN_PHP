<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sanphamban
 *
 * @author DELL
 */
class sanphamban {
    //put your code here
    
    private $IdSPB;
    private $IdNV;
    private $TSLBanNgay;
    private $NgayTK;
    private $NgayCN;
    
    public function __construct($IdSPB, $IdNV, $TSLBanNgay, $NgayTK, $NgayCN) {
        $this->IdSPB = $IdSPB;
        $this->IdNV = $IdNV;
        $this->TSLBanNgay = $TSLBanNgay;
        $this->NgayTK = $NgayTK;
        $this->NgayCN = $NgayCN;
    }

    public function getIdSPB() {
        return $this->IdSPB;
    }

    public function getIdNV() {
        return $this->IdNV;
    }

    public function getTSLBNgay() {
        return $this->TSLBanNgay;
    }

    public function getNgayTK() {
        return $this->NgayTK;
    }

    public function getNgayCN() {
        return $this->NgayCN;
    }

    public function setIdSPB($IdSPB) {
        $this->IdSPB = $IdSPB;
    }

    public function setIdNV($IdNV) {
        $this->IdNV = $IdNV;
    }

    public function setTSLBNgay($TSLBanNgay) {
        $this->TSLBanNgay = $TSLBanNgay;
    }

    public function setNgayTK($NgayTK) {
        $this->NgayTK = $NgayTK;
    }

    public function setNgayCN($NgayCN) {
        $this->NgayCN = $NgayCN;
    }

}
