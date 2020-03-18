<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nguoidungBUS
 *
 * @author DELL
 */
class nguoidungBUS {
    //put your code here
    
    // Lấy danh sách
    public static function getDSND(){
        return nguoidungDAO::getDSND();
    }
    
    //Kiểm tra đăng nhập
    public static function KTTKDN($username, $PassWord){
        return nguoidungDAO::KTTKDN($username, $PassWord);
    }
    
    // Lấy nd theo mã nv
    public static function getND($ma){
        return nguoidungDAO::getND($ma);
    }
    
    //lấy nd theo mã nv
    public static function getNDTheoIdNV($manv){
        return nguoidungDAO::getNDTheoIdNV($manv);
    }
    
    //lấy nd theo tên tk
    public static function getNDTheoTenTK($tentk){
        return nguoidungDAO::getNDTheoTenTK($tentk);
    }
    
    // Thêm mới
    public static function ThemND(nguoidung $nd){
        return nguoidungDAO::ThemND($nd);
    }
    
    //kiểm tra mật khẩu trước khi đổi
    public static function KTMK($idnd, $mk){
        return nguoidungDAO::KTMK($idnd, $mk);
    }
    
    // cập nhật mật khẩu
    public static function CapnhatMK($idnd, $mkmoi){
        return nguoidungDAO::CapnhatMK($idnd, $mkmoi);
    }
    
    // cập nhật khoá tài khoản
    public static function CapnhatKhoaTK($idnd, $khoa){
        return nguoidungDAO::CapnhatKhoaTK($idnd, $khoa);
    }
    
    // cập nhật loại ND
    public static function CapnhatNhomND($idnd, $nnd){
        return nguoidungDAO::CapnhatNhomND($idnd, $nnd);
    }
    
    // cập nhật mnv
    public static function CapnhatIdNV($idnd, $idnv){
        return nguoidungDAO::CapnhatIdNV($idnd, $idnv);
    }
    
    // cập nhật mnd khi mnv thay doi
    public static function CapnhatIdND($idndmoi, $idndcu){
        return nguoidungDAO::CapnhatIdND($idndmoi, $idndcu);
    }
    
    // xóa dữ liệu
    public static function XoaND($idnd){
        return nguoidungDAO::XoaND($idnd);
    }
    
    // xóa người dùng theo mã nv
    public static function XoaNDtheoIdNV($idnv){
        return nguoidungDAO::XoaNDtheoIdNV($idnv);
    }
    
    // tìm kiếm
    public static function TKND($key){
        return nguoidungDAO::TKND($key);
    }
    
    public static function TaoMaNN($loaind){
        return nguoidungDAO::TaoMaNN($loaind);
    }
}
