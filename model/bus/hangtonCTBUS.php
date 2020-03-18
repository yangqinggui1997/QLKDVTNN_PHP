<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hangtonCTBUS
 *
 * @author DELL
 */
class hangtonCTBUS {
    //put your code here
    
    //lấy danh sách chi tiết
    public static function getDSHTCT(){
        return hangtonCTDAO::getDSHTCT();
    }
    
    //lấy danh sách chi tiết theo idht
    public static function getDSHTCTtheoIdHT($mht){
        return hangtonCTDAO::getDSHTCTtheoIdHT($mht);
    }
    
    //lấy hàng tồn chi tiết theo mã ht và mã sp
    public static function getHTCT($idht, $idsp){
        return hangtonCTDAO::getHTCT($idht, $idsp);
    }
    
    // thêm mới dữ liệu
    public static function ThemHTCT($mht){
        return hangtonCTDAO::ThemHTCT($mht);
    }
    
    // cập nhật dữ liệu
    public static function CapnhatHTCT($mht){
        return hangtonCTDAO::CapnhatHTCT($mht);
    }
    
    // xóa hàng tồn ct theo idht
    public static function XoaHTCTtheoIdHT($idht){
        return hangtonCTDAO::XoaHTCTtheoIdHT($idht);
    }
    
    // xóa hàng tồn ct theo idsp
    public static function XoaHTCTtheoIdSP($idsp){
        return hangtonCTDAO::XoaHTCTtheoIdSP($idsp);
    }
    
    
}
