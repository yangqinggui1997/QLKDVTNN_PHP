<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of khachhangBUS
 *
 * @author DELL
 */
class khachhangBUS {
    //put your code here
    
    //lấy danh sách khách hàng
    public static function getDSKH(){
        return khachhangDAO::getDSKH();
    }
    
    //lấy khách hàng theo mã
    public static function getKH($idkh){
        return khachhangDAO::getKH($idkh);
    }
    
    // thêm mới dữ liệu
    public static function ThemKH(khachhang $kh){
        return khachhangDAO::ThemKH($kh);
    }
    
    // cập nhật dữ liệu
    public static function CapnhatKH(khachhang $kh){
        return khachhangDAO::CapnhatKH($kh);
    }
    
    // xóa dữ liệu
    public static function XoaKH($idkh){
        return khachhangDAO::XoaKH($idkh);
    }
    
     // tìm kiếm
    public static function TKKH($key){
        return khachhangDAO::TKKH($key);
    }
    
}
