<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hoadonbanBUS
 *
 * @author DELL
 */
class hoadonbanBUS {
    //put your code here
    
    //lấy danh sách hoá đơn bán
    public static function getDSHDB(){
        return hoadonbanDAO::getDSHDB();
    }
    
    //lấy hoá đơn bán theo mã
    public static function getHDB($idhdb){
        return hoadonbanDAO::getHDB($idhdb);
    }
    
    //lấy mã hoá đơn theo mã nhân viên
    public static function getHDBtheoIdNV($idnv){
        return hoadonbanDAO::getHDBtheoIdNV($idnv);
    }
    
    //lấy hoá đơn bán theo mã khách hàng
    public static function getHDBtheoIdKH($idkh){
        return hoadonbanDAO::getHDBtheoIdKH($idkh);
    }
    
    // thêm mới dữ liệu
    public static function ThemHDB(hoadonban $hdb){
        return hoadonbanDAO::ThemHDB($hdb);
    }
    
    // cập nhật dữ liệu
    public static function CapnhatHDB(hoadonban $hdb){
        return hoadonbanDAO::CapnhatHDB($hdb);
    }
    
    // cập nhật dữ liệu khi idnv thay doi
    public static function CapnhatIdNV($idhdb, $idnv){
        return hoadonbanDAO::CapnhatIdNV($idhdb, $idnv);
    }
    
    // cập nhật dữ liệu khi idkh thay doi
    public static function CapnhatIdKH($idhdb, $idkh){
        return hoadonbanDAO::CapnhatIdKH($idhdb, $idkh);
    }
    
    // xóa dữ liệu
    public static function XoaHDB($idhdb){
        return hoadonbanDAO::XoaHDB($idhdb);
    }
    
    // xóa hdb theo idnv
    public static function XoaHDBtheoIdNV($idnv){
        return hoadonbanDAO::XoaHDBtheoIdNV($idnv);
    }
    
    // xóa hdb theo idkh
    public static function XoaHDBtheoIdKH($idkh){
        return hoadonbanDAO::XoaHDBtheoIdKH($idkh);
    }
    
    // tính tổng số lượng
    public static function TongSLUpdate($idhdb){
        return hoadonbanDAO::TongSLUpdate($idhdb);
    }
    
    // tính tổng tiền
    public static function TongTienUpdate($idhdb){
        return hoadonbanDAO::TongTienUpdate($idhdb);
    }
    
    // cập nhật dã thanh toán
    public static function DathanhToanUpdate($idhdb, $dathanhtoan){
        return hoadonbanDAO::DathanhToanUpdate($idhdb, $dathanhtoan);
    }
    
    // tìm kiếm
    public static function TKHDB($key){
        return hoadonbanDAO::TKHDB($key);
    }
    
    public static function TaoMaNN(){
        return hoadonbanDAO::TaoMaNN();
    }
}
