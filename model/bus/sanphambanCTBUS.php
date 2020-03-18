<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sanphambanCTBUS
 *
 * @author DELL
 */
class sanphambanCTBUS {
    //put your code here
    
    //lấy danh sách chi tiết
    public static function getDSSPBCT(){
        return sanphambanCTDAO::getDSSPBCT();
    }
    
    //lấy danh sách chi tiết theo idht
    public static function getDSSPBCTtheoIdSPB($mspb){
        return sanphambanCTDAO::getDSSPBCTtheoIdSPB($mspb);
    }
    
    //lấy spb chi tiết theo mã ht và mã sp
    public static function getSPBCT($idspb, $idsp){
        return sanphambanCTDAO::getSPBCT($idspb, $idsp);
    }
    
    // thêm mới dữ liệu
    public static function ThemSPBCT($month, $year, $mspb){
        return sanphambanCTDAO::ThemSPBCT($month, $year, $mspb);
    }
    
    // cập nhật mới dữ liệu
    public static function CapnhatSPBCT($month, $year, $mspb){
        return sanphambanCTDAO::CapnhatSPBCT($month, $year, $mspb);
    }
    
    // xóa spbct thep idspb
    public static function XoaSPBCTtheoIdSPB($idspb){
        return sanphambanCTDAO::XoaSPBCTtheoIdSPB($idspb);
    }
    
     // xóa spbct theo idsp
    public static function XoaSPBCTtheoIdSP($idsp){
        return sanphambanCTDAO::XoaSPBCTtheoIdSP($idsp);
    }
}
