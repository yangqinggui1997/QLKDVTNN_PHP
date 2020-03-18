<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nguoidung
 *
 * @author DELL
 */
class nguoidung {
    //put your code here
    private $IdND;
    private $IdNV;
    private $TenTK;
    private $MK;
    private $NgayTaoTK;
    private $SuaMKLanCuoi;
    private $TrangThai;
    private $LoaiND;

    public function __construct($idnd, $idnv, $tentk, $mk, $ngaytaotk, $suamklancuoi, $trangthai, $loaind){
        $this->IdND=$idnd;
        $this->IdNV=$idnv;
        $this->TenTK=$tentk;
        $this->MK=$mk;
        $this->NgayTaoTK=$ngaytaotk;
        $this->SuaMKLanCuoi=$suamklancuoi;
        $this->TrangThai=$trangthai;
        $this->LoaiND=$loaind;
    }

    public function getIdND(){
        return $this->IdND;
    }
    public function setIdND($giatri){
        $this->IdND = $giatri;
    }
    public function getIdNV(){
        return $this->IdNV;
    }
    public function setIdNV($giatri){
        return $this->IdNV = $giatri;
    }
    public function getTenTK(){
        return $this->TenTK;
    }
    public function setTenTK($giatri){
        return $this->TenTK = $giatri;
    }
    public function getMK(){
        return $this->MK;
    }
    public function setMK($giatri){
        return $this->MK = $giatri;
    }
    public function getNgayTaoTK(){
        return $this->NgayTaoTK;
    }
    public function setNgayTaoTK($giatri){
        return $this->NgayTaoTK = $giatri;
    }
    public function getSuaMKLanCuoi(){
        return $this->SuaMKLanCuoi;
    }
    public function setSuaMKLanCuoi($giatri){
        return $this->SuaMKLanCuoi = $giatri;
    }
    public function getTrangThai(){
        return $this->TrangThai;
    }
    public function setTrangThai($giatri){
        return $this->TrangThai = $giatri;
    }
    public function getLoaiND(){
        return $this->LoaiND;
    }
    public function setLoaiND($giatri){
        return $this->LoaiND = $giatri;
    }
   
}
