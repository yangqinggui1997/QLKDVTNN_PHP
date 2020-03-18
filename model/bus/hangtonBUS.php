<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hangtonBUS
 *
 * @author DELL
 */
class hangtonBUS {
    //put your code here
    
    //lấy danh sách hàng tồn
    public static function getDSHT(){
        return hangtonDAO::getDSHT();
    }
    
    //lấy hàng tồn theo mã
    public static function getHT($idht){
        return hangtonDAO::getHT($idht);
    }
    
    //lấy hàng tồn theo tháng và năm
    public static function getHTtheoMonthYear($month, $year){
        return hangtonDAO::getHTtheoMonthYear($month, $year);
    }
    
    //lấy mã hàng tồn theo mã nhân viên
    public static function getHTtheoIdNV($idnv){
        return hangtonDAO::getHTtheoIdNV($idnv);
    }
    
    // thêm mới dữ liệu
    public static function ThemHT(hangton $ht){
        return hangtonDAO::ThemHT($ht);
    }
    
    // cập nhật dữ liệu
    public static function CapnhatHT(hangton $ht){
        return hangtonDAO::CapnhatHT($ht);
    }
    
    // cập nhật dữ liệu khi idv thay doi
    public static function CapnhatIdNV($idht, $idnv){
        return hangtonDAO::CapnhatIdNV($idht, $idnv);
    }
    
    // xóa dữ liệu
    public static function XoaHT($idht){
        return hangtonDAO::XoaHT($idht);
    }
    
    // xóa hang ton theo idnv
    public static function XoaHTtheoIdNV($idnv){
        return hangtonDAO::XoaHTtheoIdNV($idnv);
    }
    
    // tìm kiếm
    public static function TKHT($key){
        return hangtonDAO::TKHT($key);
    }
    
    public static function TaoMaNN(){
        return hangtonDAO::TaoMaNN();
    }
}
