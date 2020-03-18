<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sanpham
 *
 * @author DELL
 */
class sanpham {
    //put your code here
    
    private $IdSP;
    private $IdNCU;
    private $TenSP;
    private $NgaySX;
    private $NgayHH;
    private $NhaSX;
    private $NgayNhap;
    private $SLNhap;
    private $DonGiaNhap;
    private $DonGiaTienMat;
    private $DonGiaThanhToanSau;
    private $GiamGia;
    private $AnhSP;
    private $NgayCN;
    
    public function __construct($IdSP, $IdNCU, $TenSP, $NgaySX, $NgayHH, $NhaSX, $NgayNhap, $SLNhap, $DonGiaNhap, $DonGiaTienMat, $DonGiaThanhToanSau, $GiamGia, $AnhSP, $NgayCN) {
        $this->IdSP = $IdSP;
        $this->IdNCU = $IdNCU;
        $this->TenSP = $TenSP;
        $this->NgaySX = $NgaySX;
        $this->NgayHH = $NgayHH;
        $this->NhaSX = $NhaSX;
        $this->NgayNhap = $NgayNhap;
        $this->SLNhap = $SLNhap;
        $this->DonGiaNhap = $DonGiaNhap;
        $this->DonGiaTienMat = $DonGiaTienMat;
        $this->DonGiaThanhToanSau = $DonGiaThanhToanSau;
        $this->GiamGia = $GiamGia;
        $this->AnhSP = $AnhSP;
        $this->NgayCN = $NgayCN;
    }

    public function getIdSP() {
        return $this->IdSP;
    }

    public function getIdNCU() {
        return $this->IdNCU;
    }

    public function getTenSP() {
        return $this->TenSP;
    }

    public function getNgaySX() {
        return $this->NgaySX;
    }

    public function getNgayHH() {
        return $this->NgayHH;
    }

    public function getNhaSX() {
        return $this->NhaSX;
    }

    public function getNgayNhap() {
        return $this->NgayNhap;
    }

    public function getSLNhap() {
        return $this->SLNhap;
    }

    public function getDonGiaNhap() {
        return $this->DonGiaNhap;
    }

    public function getDonGiaTienMat() {
        return $this->DonGiaTienMat;
    }

    public function getDonGiaThanhToanSau() {
        return $this->DonGiaThanhToanSau;
    }

    public function getGiamGia() {
        return $this->GiamGia;
    }

    public function getAnhSP() {
        return $this->AnhSP;
    }

    public function getNgayCN() {
        return $this->NgayCN;
    }

    public function setIdSP($IdSP) {
        $this->IdSP = $IdSP;
    }

    public function setIdNCU($IdNCU) {
        $this->IdNCU = $IdNCU;
    }

    public function setTenSP($TenSP) {
        $this->TenSP = $TenSP;
    }

    public function setNgaySX($NgaySX) {
        $this->NgaySX = $NgaySX;
    }

    public function setNgayHH($NgayHH) {
        $this->NgayHH = $NgayHH;
    }

    public function setNhaSX($NhaSX) {
        $this->NhaSX = $NhaSX;
    }

    public function setNgayNhap($NgayNhap) {
        $this->NgayNhap = $NgayNhap;
    }

    public function setSLNhap($SLNhap) {
        $this->SLNhap = $SLNhap;
    }

    public function setDonGiaNhap($DonGiaNhap) {
        $this->DonGiaNhap = $DonGiaNhap;
    }

    public function setDonGiaTienMat($DonGiaTienMat) {
        $this->DonGiaTienMat = $DonGiaTienMat;
    }

    public function setDonGiaThanhToanSau($DonGiaThanhToanSau) {
        $this->DonGiaThanhToanSau = $DonGiaThanhToanSau;
    }

    public function setGiamGia($GiamGia) {
        $this->GiamGia = $GiamGia;
    }

    public function setAnhSP($AnhSP) {
        $this->AnhSP = $AnhSP;
    }

    public function setNgayCN($NgayCN) {
        $this->NgayCN = $NgayCN;
    }

}
