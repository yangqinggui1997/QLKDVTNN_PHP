<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hoadonbanCTDAO
 *
 * @author DELL
 */
class hoadonbanCTDAO {
    //put your code here
    
    //lấy danh sách hoá đơn bán chi tiết
    public static function getDSHDBCT(){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT * FROM hdbchitiet ORDER BY SL DESC";
        try{
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $hdbct= new hoadonbanct($value["IdHDB"], $value["IdSP"], $value["SL"], $value["DonGia"], $value["GiamGia"], $value["ThanhTien"]);
                    $kq[]=$hdbct;                  
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
    
    //lấy danh sách hoá đơn bán chi tiết theo idhdb
    public static function getDSHDBCTTheoIdHDB($mhdb){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM hdbchitiet WHERE IdHDB = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $mhdb, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $hdbct= new hoadonbanct($value["IdHDB"], $value["IdSP"], $value["SL"], $value["DonGia"], $value["GiamGia"], $value["ThanhTien"]);
                    $kq[]=$hdbct;
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
    
    //lấy hoá đơn bán chi tiết theo mã hoá đơn và mã sp
    public static function getHDBCT($idhdb, $idsp){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM hdbchitiet WHERE IdHDB = ? and IdSP = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idhdb, PDO::PARAM_STR, 10); 
            $cmd->bindParam(2, $idsp, PDO::PARAM_STR, 10);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $hdbct= new hoadonbanct($value["IdHDB"], $value["IdSP"], $value["SL"], $value["DonGia"], $value["GiamGia"], $value["ThanhTien"]);
                    return $hdbct;
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
    
    // thêm mới dữ liệu
    public static function ThemHDBCT(hoadonbanct $hdbct){
        
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "INSERT INTO hdbchitiet VALUES(?,?,?,?,?,?)";
            $cmd = $dbcon->prepare($sql);
            
            $mahdb=$hdbct->getIdHDB();
            $masp=$hdbct->getIdSP();
            $sl=$hdbct->getSL();
            $dongia=$hdbct->getDonGia();
            $giamgia=$hdbct->getGiamGia();
            $thanhtien=$hdbct->getThanhTien();
            
            $cmd->bindParam(1, $mahdb, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $masp, PDO::PARAM_STR, 10);
            $cmd->bindParam(3, $sl);
            $cmd->bindParam(4, $dongia);
            $cmd->bindParam(5, $giamgia, PDO::PARAM_INT, 3);
            $cmd->bindParam(6, $thanhtien);
            
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
    public static function CapnhatHDBCT(hoadonbanct $hdbct){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "UPDATE hdbchitiet SET SL = ?, DonGia = ?, GiamGia = ?, ThanhTien = ? WHERE IdHDB = ? and IdSP = ?";
            $cmd = $dbcon->prepare($sql);
            
            $mahdb=$hdbct->getIdHDB();
            $masp=$hdbct->getIdSP();
            $sl=$hdbct->getSL();
            $dongia=$hdbct->getDonGia();
            $giamgia=$hdbct->getGiamGia();
            $thanhtien=$hdbct->getThanhTien();
            
            $cmd->bindParam(1, $sl);
            $cmd->bindParam(2, $dongia);
            $cmd->bindParam(3, $giamgia, PDO::PARAM_INT, 3);
            $cmd->bindParam(4, $thanhtien);
            $cmd->bindParam(5, $mahdb, PDO::PARAM_STR, 10);
            $cmd->bindParam(6, $masp, PDO::PARAM_STR, 10);
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
    public static function XoaHDBCT($idhdb, $idsp){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM hdbchitiet WHERE IdHDB = ? and IdSP= ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $idhdb, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $idsp, PDO::PARAM_STR, 10);
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
    
    // xóa hdbct theo idhdb
    public static function XoaHDBCTtheoIdHDB($idhdb){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM hdbchitiet WHERE IdHDB = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $idhdb, PDO::PARAM_STR, 10);
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
    
    // xóa hdbct theo idsp
    public static function XoaHDBCTtheoIdSP($idsp){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM hdbchitiet WHERE IdSP = ?";
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
}
