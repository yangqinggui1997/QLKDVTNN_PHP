<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of khachhang
 *
 * @author DELL
 */
class khachhang {
    //put your code here
    
    private $TenKH;
    private $NgaySinh;
    private $GioiTinh;
    private $SoCMND;
    private $SDT;
    private $Email;
    private $DiaChi;
    private $LoaiKH;
    private $DanhGia;
    
    public function __construct($tenkh, $ngaysinh, $gioitinh, $socmnd, $sdt, $email, $diachi, $loaikh, $danhgia){
        $this->TenKH=$tenkh;
        $this->Email=$email;
        $this->GioiTinh=$gioitinh;
        $this->NgaySinh=$ngaysinh;
        $this->SoCMND=$socmnd;
        $this->SDT=$sdt;
        $this->DiaChi=$diachi;
        $this->LoaiKH=$loaikh;
        $this->DanhGia=$danhgia;
    }

    public function getTenKH(){
        return $this->TenKH;
    }
    public function setTenKH($giatri){
        return $this->TenKH = $giatri;
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
    public function getEmail(){
        return $this->Email;
    }
    public function setEmail($giatri){
        $this->Email = $giatri;
    }
    public function getDiaChi(){
        return $this->DiaChi;
    }
    public function setDiaChi($giatri){
        return $this->DiaChi = $giatri;
    }
    public function getLoaiKH(){
        return $this->LoaiKH;
    }
    public function setLoaiKH($giatri){
        return $this->LoaiKH = $giatri;
    }
    public function getDanhGia(){
        return $this->DanhGia;
    }
    public function setDanhGia($giatri){
        return $this->DanhGia = $giatri;
    }
    
}
