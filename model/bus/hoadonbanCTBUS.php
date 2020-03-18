<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hoadonbanCTBUS
 *
 * @author DELL
 */
class hoadonbanCTBUS {
    //put your code here
    
    //lấy danh sách hoá đơn bán chi tiết
    public static function getDSHDBCT(){
        return hoadonbanCTDAO::getDSHDBCT();
    }
    
    //lấy danh sách hoá đơn bán chi tiết theo idhdb
    public static function getDSHDBCTTheoIdHDB($mhdb){
        return hoadonbanCTDAO::getDSHDBCTTheoIdHDB($mhdb);
    }
    
    //lấy hoá đơn bán chi tiết theo mã hoá đơn và mã sp
    public static function getHDBCT($idhdb, $idsp){
        return hoadonbanCTDAO::getHDBCT($idhdb, $idsp);
    }
    
    // thêm mới dữ liệu
    public static function ThemHDBCT(hoadonbanct $hdbct){
        return hoadonbanCTDAO::ThemHDBCT($hdbct);
    }
    
     // cập nhật dữ liệu
    public static function CapnhatHDBCT(hoadonbanct $hdbct){
        return hoadonbanCTDAO::CapnhatHDBCT($hdbct);
    }
    
    // xóa dữ liệu
    public static function XoaHDBCT($idhdb, $idsp){
        return hoadonbanCTDAO::XoaHDBCT($idhdb, $idsp);
    }
    
    // xóa hdbct theo idhdb
    public static function XoaHDBCTtheoIdHDB($idhdb){
        return hoadonbanCTDAO::XoaHDBCTtheoIdHDB($idhdb);
    }
    
    // xóa hdbct theo idsp
    public static function XoaHDBCTtheoIdSP($idsp){
        return hoadonbanCTDAO::XoaHDBCTtheoIdSP($idsp);
    }
    
    
}
