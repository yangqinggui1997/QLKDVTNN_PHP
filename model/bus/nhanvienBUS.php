<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nhanvienBUS
 *
 * @author DELL
 */

class nhanvienBUS {
    //put your code here

    // Lấy danh sách
    public static function getDSNV(){
        return nhanvienDAO::getDSNV();
    }
    
    // Lấy nv theo mã nv bán hàng
    public static function getDSNVBH(){
        return nhanvienDAO::getDSNVBH();
    }
    
    // Lấy nv theo mã nv
    public static function getNV($ma){
        return nhanvienDAO::getNV($ma);
    }
    
    // Thêm mới
    public static function ThemNV(nhanvien $nv){
        return nhanvienDAO::ThemNV($nv);
    }
    
    // cập nhật
    public static function CapnhatNV(nhanvien $nv){
        return nhanvienDAO::CapnhatNV($nv);
    }
    
    // Xóa 
    public static function XoaNV($idnv){
        return nhanvienDAO::XoaNV($idnv);
    }
    
    // tìm kiếm
    public static function TKNV($key){
        return nhanvienDAO::TKNV($key);
    }
    
    public static function TaoMaNN($loainv){
        return nhanvienDAO::TaoMaNN($loainv);
    }
}
