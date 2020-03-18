<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class nhanvien{
    
    private $IdNV;
    private $TenNV;
    private $NgaySinh;
    private $GioiTinh;
    private $SoCMND;
    private $SDT;
    private $DiaChi;
    private $ChucVu;
    private $NgayVaoLam;
    
    public function __construct($idnv, $tennv, $ngaysinh, $gioitinh, $socmnd, $sdt, $diachi, $chucvu, $ngayvaolam){
        $this->IdNV=$idnv;
        $this->TenNV=$tennv;
        $this->GioiTinh=$gioitinh;
        $this->NgaySinh=$ngaysinh;
        $this->SoCMND=$socmnd;
        $this->SDT=$sdt;
        $this->DiaChi=$diachi;
        $this->ChucVu=$chucvu;
        $this->NgayVaoLam=$ngayvaolam;
    }

    public function getIdNV(){
        return $this->IdNV;
    }
    public function setIdNV($giatri){
        $this->IdNV = $giatri;
    }
    public function getTenNV(){
        return $this->TenNV;
    }
    public function setTenNV($giatri){
        return $this->TenNV = $giatri;
    }
    public function getGioiTinh(){
        return $this->GioiTinh;
    }
    public function setGioiTinh($giatri){
        return $this->GioiTinh = $giatri;
    }
    public function getNgaySinh(){
        return $this->NgaySinh;
    }
    public function setNgaySinh($giatri){
        return $this->NgaySinh = $giatri;
    }
    public function getSoCMND(){
        return $this->SoCMND;
    }
    public function setSoCMND($giatri){
        return $this->SoCMND = $giatri;
    }
    public function getSDT(){
        return $this->SDT;
    }
    public function setSDT($giatri){
        return $this->SDT = $giatri;
    }
    public function getDiaChi(){
        return $this->DiaChi;
    }
    public function setDiaChi($giatri){
        return $this->DiaChi = $giatri;
    }
    public function getChucVu(){
        return $this->ChucVu;
    }
    public function setChucVu($giatri){
        return $this->ChucVu = $giatri;
    }
    public function getNgayVaoLam(){
        return $this->NgayVaoLam;
    }
    public function setNgayVaoLam($giatri){
        return $this->NgayVaoLam = $giatri;
    }
    
}

