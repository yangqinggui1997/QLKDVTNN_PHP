<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nhacungungBUS
 *
 * @author DELL
 */
class nhacungungBUS {
    //put your code here
    
    //lấy danh sách nhà cung ứng
    public static function getDSNCU(){
        return nhacungungDAO::getDSNCU();
    }
    
    //lấy nhà cung ứng theo mã
    public static function getNCU($idncu){
        return nhacungungDAO::getNCU($idncu);
    }
    
    // thêm mới dữ liệu
    public static function ThemNCU(nhacungung $ncu){
        return nhacungungDAO::ThemNCU($ncu);
    }
    
    // cập nhật dữ liệu
    public static function CapnhatNCU(nhacungung $ncu){
        return nhacungungDAO::CapnhatNCU($ncu);
    }
    
    // xóa dữ liệu
    public static function XoaNCU($idncu){
        return nhacungungDAO::XoaNCU($idncu);
    }
    
    // tìm kiếm
    public static function TKNCU($key){
        return nhacungungDAO::TKNCU($key);
    }
    
    public static function TaoMaNN(){
        return nhacungungDAO::TaoMaNN();
    }
    
}
