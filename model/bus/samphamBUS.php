<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of samphamBUS
 *
 * @author DELL
 */
class samphamBUS {
    //put your code here
    
    //lấy danh sách sản phẩm
    public static function getDSSP(){
        return sanphamDAO::getDSSP();
    }
    
    //lấy sản phẩm theo mã
    public static function getSP($idsp){
        return sanphamDAO::getSP($idsp);
    }
    
    //lấy sản phẩm theo mã
    public static function getSPtheoIdNCU($idncu){
        return sanphamDAO::getSPtheoIdNCU($idncu);
    }
    
    // thêm mới dữ liệu
    public static function ThemSP(sanpham $sp){
        return sanphamDAO::ThemSP($sp);
    }
    
    // cập nhật dữ liệu
    public static function CapnhatSP(sanpham $sp, $htd){
        return sanphamDAO::CapnhatSP($sp, $htd);
    }
    
    // cập nhật dữ liệu
    public static function CapnhatSLSP($masp, $sl){
        return sanphamDAO::CapnhatSLSP($masp, $sl);
    }
    
    // xóa dữ liệu
    public static function XoaSP($idsp){
        return sanphamDAO::XoaSP($idsp);
    }
    
    // xóa sản phẩm theo idncu
    public static function XoaSPtheoIdNCU($idncu){
        return sanphamDAO::XoaSPtheoIdNCU($idncu);
    }
    
    // tìm kiếm
    public static function TKSP($key){
        return sanphamDAO::TKSP($key);
    }
    
    public static function TaoMaNN(){
        return sanphamDAO::TaoMaNN();
    }
}
