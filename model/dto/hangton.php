<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hangton
 *
 * @author DELL
 */
class hangton {
    //put your code here
    
    private $IdHT;
    private $IdNV;
    private $TongSLTNgay;
    private $NgayTK;
    private $NgayCN;
    
    public function __construct($IdHT, $IdNV, $TongSLTNgay, $NgayTK, $NgayCN) {
        $this->IdHT = $IdHT;
        $this->IdNV = $IdNV;
        $this->TongSLTNgay = $TongSLTNgay;
        $this->NgayTK = $NgayTK;
        $this->NgayCN = $NgayCN;
    }
    
    public function getIdHT() {
        return $this->IdHT;
    }

    public function getIdNV() {
        return $this->IdNV;
    }

    public function getTongSLTNgay() {
        return $this->TongSLTNgay;
    }

    public function getNgayTK() {
        return $this->NgayTK;
    }

    public function getNgayCN() {
        return $this->NgayCN;
    }

    public function setIdHT($IdHT) {
        $this->IdHT = $IdHT;
    }

    public function setIdNV($IdNV) {
        $this->IdNV = $IdNV;
    }

    public function setTongSLTNgay($TongSLTNgay) {
        $this->TongSLTNgay = $TongSLTNgay;
    }

    public function setNgayTK($NgayTK) {
        $this->NgayTK = $NgayTK;
    }

    public function setNgayCN($NgayCN) {
        $this->NgayCN = $NgayCN;
    }
}
