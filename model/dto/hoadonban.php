<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hoadonban
 *
 * @author DELL
 */
class hoadonban {
    //put your code here
    
    private $IdHDB;
    private $IdNV;
    private $IdKH;
    private $NgayLap;
    private $HinhThucTT;
    private $DaThanhToan;
    private $TongSL;
    private $TongTien;
    private $TinhTrang;
    private $DaNhan;
    private $NgayCN;
    
    public function __construct($IdHDB, $IdNV, $IdKH, $NgayLap, $HinhThucTT, $DaThanhToan, $TongSL, $TongTien, $TinhTrang, $DaNhan, $NgayCN) {
        $this->IdHDB = $IdHDB;
        $this->IdNV = $IdNV;
        $this->IdKH = $IdKH;
        $this->NgayLap = $NgayLap;
        $this->HinhThucTT = $HinhThucTT;
        $this->DaThanhToan = $DaThanhToan;
        $this->TongSL = $TongSL;
        $this->TongTien = $TongTien;
        $this->TinhTrang = $TinhTrang;
        $this->DaNhan = $DaNhan;
        $this->NgayCN = $NgayCN;
    }

    public function getIdHDB() {
        return $this->IdHDB;
    }

    public function getIdNV() {
        return $this->IdNV;
    }

    public function getIdKH() {
        return $this->IdKH;
    }

    public function getNgayLap() {
        return $this->NgayLap;
    }

    public function getHinhThucTT() {
        return $this->HinhThucTT;
    }

    public function getDaThanhToan() {
        return $this->DaThanhToan;
    }

    public function getTongSL() {
        return $this->TongSL;
    }

    public function getTongTien() {
        return $this->TongTien;
    }

    public function getTinhTrang() {
        return $this->TinhTrang;
    }

    public function getDaNhan() {
        return $this->DaNhan;
    }

    public function getNgayCN() {
        return $this->NgayCN;
    }

    public function setIdHDB($IdHDB) {
        $this->IdHDB = $IdHDB;
    }

    public function setIdNV($IdNV) {
        $this->IdNV = $IdNV;
    }

    public function setIdKH($IdKH) {
        $this->IdKH = $IdKH;
    }

    public function setNgayLap($NgayLap) {
        $this->NgayLap = $NgayLap;
    }

    public function setHinhThucTT($HinhThucTT) {
        $this->HinhThucTT = $HinhThucTT;
    }

    public function setDaThanhToan($DaThanhToan) {
        $this->DaThanhToan = $DaThanhToan;
    }

    public function setTongSL($TongSL) {
        $this->TongSL = $TongSL;
    }

    public function setTongTien($TongTien) {
        $this->TongTien = $TongTien;
    }

    public function setTinhTrang($TinhTrang) {
        $this->TinhTrang = $TinhTrang;
    }

    public function setDaNhan($DaNhan) {
        $this->DaNhan = $DaNhan;
    }

    public function setNgayCN($NgayCN) {
        $this->NgayCN = $NgayCN;
    }

}
