<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nhacungung
 *
 * @author DELL
 */
class nhacungung {
    //put your code here
    
    private $IdNCU;
    private $TenNCU;
    private $QuyMo;
    private $SDT;
    private $Email;
    private $DiaChi;
    private $DanhGia;
    
    public function __construct($idncu, $tenncu, $diachi, $sdt, $email, $quymo, $danhgia){
        $this->IdNCU=$idncu;
        $this->TenNCU=$tenncu;
        $this->QuyMo=$quymo;
        $this->SDT=$sdt;
        $this->Email=$email;
        $this->DiaChi=$diachi;
        $this->DanhGia=$danhgia;
    }

    public function getIdNCU(){
        return $this->IdNCU;
    }
    public function setIdNCU($giatri){
        return $this->IdNCU = $giatri;
    }
    public function getTenNCU(){
        return $this->TenNCU;
    }
    public function setTenNCU($giatri){
        return $this->TenNCU = $giatri;
    }
    public function getQuyMo(){
        return $this->QuyMo;
    }
    public function setQuyMo($giatri){
        return $this->QuyMo = $giatri;
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
    public function getDanhGia(){
        return $this->DanhGia;
    }
    public function setDanhGia($giatri){
        return $this->DanhGia = $giatri;
    }

}
