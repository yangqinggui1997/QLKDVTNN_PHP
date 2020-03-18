<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sanphambanBUS
 *
 * @author DELL
 */
class sanphambanBUS {
    //put your code here
    
    //lấy danh sách spb
    public static function getDSSPB(){
        return sanphambanDAO::getDSSPB();
    }
    
    //lấy spb theo mã
    public static function getSPB($idspb){
        return sanphambanDAO::getSPB($idspb);
    }
    
    //lấy spb theo tháng và năm
    public static function getSPBtheoMonthYear($month, $year){
        return sanphambanDAO::getSPBtheoMonthYear($month, $year);
    }
    
    //lấy spb theo mã nhân viên
    public static function getSPBtheoIdNV($idnv){
        return sanphambanDAO::getSPBtheoIdNV($idnv);
    }
    
    // thêm mới dữ liệu
    public static function ThemSPB($month, $year, sanphamban $spb){
        return sanphambanDAO::ThemSPB($month, $year, $spb);
    }
    
    // cập nhật dữ liệu
    public static function CapnhatSPB($month, $year, sanphamban $mspb){
        return sanphambanDAO::CapnhatSPB($month, $year, $mspb);
    }
    
    // cập nhật dữ liệu khi idv thay doi
    public static function CapnhatIdNV($idspb, $idnv){
        return sanphambanDAO::CapnhatIdNV($idspb, $idnv);
    }
    
    // xóa dữ liệu
    public static function XoaSPB($idspb){
        return sanphambanDAO::XoaSPB($idspb);
    }
    
    // xóa hang ton theo idnv
    public static function XoaSPBtheoIdNV($idnv){
        return sanphambanDAO::XoaSPBtheoIdNV($idnv);
    }
    
    // tìm kiếm
    public static function TKSPB($key){
        return sanphambanDAO::TKSPB($key);
    }
    
    public static function TaoMaNN(){
        return sanphambanDAO::TaoMaNN();
    }
}
