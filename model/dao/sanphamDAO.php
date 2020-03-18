<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sanphamDAO
 *
 * @author DELL
 */
class sanphamDAO {
    //put your code here
    
    //lấy danh sách sản phẩm
    public static function getDSSP(){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT * FROM sanpham ORDER BY DATE(NgayNhap) DESC, NgayNhap DESC";
        try{
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $sp = new sanpham($value["IdSP"], $value["IdNCU"], $value["TenSP"], $value["NgaySX"], $value["NgayHH"], $value["NhaSX"], $value["NgayNhap"], $value["SLNhap"], $value["DonGiaNhap"], $value["DonGiaTienMat"], $value["DonGiaThanhToanSau"], $value["GiamGia"], $value["AnhSP"], $value["NgayCN"]);
                    $kq[]=$sp;                  
                }
                return $kq;
            }
            else{
                return NULL; 
            }
            
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            return $error_message;
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    //lấy sản phẩm theo mã
    public static function getSP($idsp){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM sanpham WHERE IdSP = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idsp, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $sp = new sanpham($value["IdSP"], $value["IdNCU"], $value["TenSP"], $value["NgaySX"], $value["NgayHH"], $value["NhaSX"], $value["NgayNhap"], $value["SLNhap"], $value["DonGiaNhap"], $value["DonGiaTienMat"], $value["DonGiaThanhToanSau"], $value["GiamGia"], $value["AnhSP"], $value["NgayCN"]);
                    return $sp;
                }

            }
            else{
                return NULL;  
            }
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            return $error_message;
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    //lấy sản phẩm theo mã
    public static function getSPtheoIdNCU($idncu){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM sanpham WHERE IdNCU = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idncu, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $sp = new sanpham($value["IdSP"], $value["IdNCU"], $value["TenSP"], $value["NgaySX"], $value["NgayHH"], $value["NhaSX"], $value["NgayNhap"], $value["SLNhap"], $value["DonGiaNhap"], $value["DonGiaTienMat"], $value["DonGiaThanhToanSau"], $value["GiamGia"], $value["AnhSP"], $value["NgayCN"]);
                    $kq[]=$sp;                  
                }
                return $kq;
            }
            else{
                return NULL; 
            }
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            return $error_message;
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // thêm mới dữ liệu
    public static function ThemSP(sanpham $sp){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "INSERT INTO sanpham VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $cmd = $dbcon->prepare($sql);
            
            $masp=$sp->getIdSP();
            $mancu=$sp->getIdNCU();
            $tensp=$sp->getTenSP();
            $ngaysx=$sp->getNgaySX();
            $ngayhh=$sp->getNgayHH();
            $nhasx=$sp->getNhaSX();
            $ngaynhap=$sp->getNgayNhap();
            $slnhap=$sp->getSLNhap();
            $dongianhap=$sp->getDonGiaNhap();
            $dongiatm=$sp->getDonGiaTienMat();
            $dongiatts=$sp->getDonGiaThanhToanSau();
            $giamgia=$sp->getGiamGia();
            $anhsp=$sp->getAnhSP();
            $ngaycn=$sp->getNgayCN();
            
            $cmd->bindParam(1, $masp, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $mancu, PDO::PARAM_STR, 10);
            $cmd->bindParam(3, $tensp, PDO::PARAM_STR);
            $cmd->bindParam(4, $ngaysx);
            $cmd->bindParam(5, $ngayhh);
            $cmd->bindParam(6, $nhasx, PDO::PARAM_STR);
            $cmd->bindParam(7, $ngaynhap);
            $cmd->bindParam(8, $slnhap);
            $cmd->bindParam(9, $dongianhap);
            $cmd->bindParam(10, $dongiatm);
            $cmd->bindParam(11, $dongiatts);
            $cmd->bindParam(12, $giamgia, PDO::PARAM_INT, 3);
            $cmd->bindParam(13, $anhsp, PDO::PARAM_STR);
            $cmd->bindParam(14, $ngaycn);
            $cmd->execute();
            return TRUE;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            return $error_message;
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // cập nhật dữ liệu
    public static function CapnhatSP(sanpham $sp, $htd){
        $dbcon = CommonComand::taoketnoi();
        $sql="";
        $hts= intval($htd);
        if($hts == 1){
            $sql = "UPDATE sanpham SET IdNCU = ? , TenSP = ?, NgaySX = ?, NgayHH = ?, NhaSX = ?, NgayNhap = ?, SLNhap = ?, DonGiaNhap = ?, DonGiaTienMat = ?, DonGiaThanhToanSau = ?, GiamGia = ?, AnhSP= ?, NgayCN = ? WHERE IdSP = ?";
            try {
                $cmd = $dbcon->prepare($sql);
                
                $masp=$sp->getIdSP();
                $mancu=$sp->getIdNCU();
                $tensp=$sp->getTenSP();
                $ngaysx=$sp->getNgaySX();
                $ngayhh=$sp->getNgayHH();
                $nhasx=$sp->getNhaSX();
                $ngaynhap=$sp->getNgayNhap();
                $slnhap=$sp->getSLNhap();
                $dongianhap=$sp->getDonGiaNhap();
                $dongiatm=$sp->getDonGiaTienMat();
                $dongiatts=$sp->getDonGiaThanhToanSau();
                $giamgia=$sp->getGiamGia();
                $anhsp=$sp->getAnhSP();
                $ngaycn=$sp->getNgayCN();
            
                $cmd->bindParam(1, $mancu, PDO::PARAM_STR, 10);
                $cmd->bindParam(2, $tensp, PDO::PARAM_STR);
                $cmd->bindParam(3, $ngaysx);
                $cmd->bindParam(4, $ngayhh);
                $cmd->bindParam(5, $nhasx, PDO::PARAM_STR);
                $cmd->bindParam(6, $ngaynhap);
                $cmd->bindParam(7, $slnhap);
                $cmd->bindParam(8, $dongianhap);
                $cmd->bindParam(9, $dongiatm);
                $cmd->bindParam(10, $dongiatts);
                $cmd->bindParam(11, $giamgia, PDO::PARAM_INT, 3);
                $cmd->bindParam(12, $anhsp, PDO::PARAM_STR);
                $cmd->bindParam(13, $ngaycn);
                $cmd->bindParam(14, $masp, PDO::PARAM_STR, 10);
                
                $cmd->execute();
                return TRUE;
            } catch (PDOException $ex) {
                return $ex->getMessage();
            }
        }
        else{
            $sql = "UPDATE sanpham SET IdNCU = ? , TenSP = ?, NgaySX = ?, NgayHH = ?, NhaSX = ?, NgayNhap = ?, SLNhap = ?, DonGiaNhap = ?, DonGiaTienMat = ?, DonGiaThanhToanSau = ?, GiamGia = ?, NgayCN = ? WHERE IdSP = ?";
            try {
                $cmd = $dbcon->prepare($sql);
                
                $masp=$sp->getIdSP();
                $mancu=$sp->getIdNCU();
                $tensp=$sp->getTenSP();
                $ngaysx=$sp->getNgaySX();
                $ngayhh=$sp->getNgayHH();
                $nhasx=$sp->getNhaSX();
                $ngaynhap=$sp->getNgayNhap();
                $slnhap=$sp->getSLNhap();
                $dongianhap=$sp->getDonGiaNhap();
                $dongiatm=$sp->getDonGiaTienMat();
                $dongiatts=$sp->getDonGiaThanhToanSau();
                $giamgia=$sp->getGiamGia();
                $anhsp=$sp->getAnhSP();
                $ngaycn=$sp->getNgayCN();
                
                $cmd->bindParam(1, $mancu, PDO::PARAM_STR, 10);
                $cmd->bindParam(2, $tensp, PDO::PARAM_STR);
                $cmd->bindParam(3, $ngaysx);
                $cmd->bindParam(4, $ngayhh);
                $cmd->bindParam(5, $nhasx, PDO::PARAM_STR);
                $cmd->bindParam(6, $ngaynhap);
                $cmd->bindParam(7, $slnhap);
                $cmd->bindParam(8, $dongianhap);
                $cmd->bindParam(9, $dongiatm);
                $cmd->bindParam(10, $dongiatts);
                $cmd->bindParam(11, $giamgia, PDO::PARAM_INT, 3);
                $cmd->bindParam(12, $ngaycn);
                $cmd->bindParam(13, $masp, PDO::PARAM_STR, 10);
                
                $cmd->execute();
                return TRUE;
            } catch (PDOException $ex) {
                return $ex->getMessage();
            }
        }
    }
    
    // cập nhật dữ liệu
    public static function CapnhatSLSP($masp, $sl){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "UPDATE sanpham SET SLNhap = ? WHERE IdSP = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $sl);
            $cmd->bindParam(2, $masp, PDO::PARAM_STR, 10);
            
            $cmd->execute();
            return TRUE;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            return $error_message;
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // xóa dữ liệu
    public static function XoaSP($idsp){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM sanpham WHERE IdSP = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $idsp, PDO::PARAM_STR, 10);
            $cmd->execute();
            
            return TRUE;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            return $error_message;
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // xóa sản phẩm theo idncu
    public static function XoaSPtheoIdNCU($idncu){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM sanpham WHERE IdNCU = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $idncu, PDO::PARAM_STR, 10);
            $cmd->execute();
            
            return TRUE;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            return $error_message;
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // tìm kiếm
    public static function TKSP($key){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM sanpham WHERE (IdSP like N'%".$key."%') or (IdNCU like N'%".$key."%') or (TenSP like N'%".$key."%') or (DATE_FORMAT(NgaySX, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') or (DATE_FORMAT(NgayHH, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') or (NhaSX like N'%".$key."%') or (DATE_FORMAT(NgayNhap, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') or (SLNhap like N'%".$key."%') or (DonGiaNhap like N'%".$key."%') or (DonGiaTienMat like N'%".$key."%') or (DonGiaThanhToanSau like N'%".$key."%') or (GiamGia like N'%".$key."%') or (DATE_FORMAT(NgayCN, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') ORDER BY DATE(NgayNhap) DESC, NgayNhap DESC";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $sp = new sanpham($value["IdSP"], $value["IdNCU"], $value["TenSP"], $value["NgaySX"], $value["NgayHH"], $value["NhaSX"], $value["NgayNhap"], $value["SLNhap"], $value["DonGiaNhap"], $value["DonGiaTienMat"], $value["DonGiaThanhToanSau"], $value["GiamGia"], $value["AnhSP"], $value["NgayCN"]);
                    $kq[]=$sp;                  
                }
                return $kq;
            }
            else{
                return NULL;
            }
            
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            return $error_message;
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    public static function TaoMaNN(){
        $ran = rand(10000000, 99999999);
        $kq="SP".$ran;
        $flag=TRUE;
        $dsnv= self::getDSSP();
        if(!empty($dsnv)){
            while($flag){
                try{
                    /* @var $dsnv type */
                    foreach ($dsnv as $nv) {
                       if($nv->getIdSP() == $kq){
                            $ran= rand(10000000, 99999999);
                            $kq="SP".$ran;
                            $flag=TRUE;
                            break;
                        }
                        else{
                            $flag=FALSE;
                        }  
                    }
                } catch (PDOException $e) {
                    return $e->getMessage();
                }
            }
        }
        return $kq;
    }
}
