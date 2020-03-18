<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hangtonCTDAO
 *
 * @author DELL
 */
class hangtonCTDAO {
    //put your code here
    
    //lấy danh sách chi tiết
    public static function getDSHTCT(){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT * FROM hangtonct ORDER BY SLTon DESC";
        try{
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $htct= new hangtonct($value["IdHT"], $value["IdSP"], $value["SLTon"]);
                    $kq[]=$htct;                  
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
    
    //lấy danh sách chi tiết theo idht
    public static function getDSHTCTtheoIdHT($mht){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM hangtonct WHERE IdHT = ? ORDER BY SLTon DESC";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $mht, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $htct= new hangtonct($value["IdHT"], $value["IdSP"], $value["SLTon"]);
                    $kq[]=$htct;
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
    
    //lấy hàng tồn chi tiết theo mã ht và mã sp
    public static function getHTCT($idht, $idsp){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM hangtonct WHERE IdHT = ? and IdSP = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idht, PDO::PARAM_STR, 10); 
            $cmd->bindParam(2, $idsp, PDO::PARAM_STR, 10);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $htct= new hangtonct($value["IdHT"], $value["IdSP"], $value["SLTon"]);
                    return $htct;
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
    public static function ThemHTCT($mht){
        
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM sanpham";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $sql = "INSERT INTO hangtonct VALUES(?,?,?)";
                    $cmd = $dbcon->prepare($sql);
                    $masp=$value["IdSP"];
                    $sln=$value["SLNhap"];
                    $cmd->bindParam(1, $mht, PDO::PARAM_STR, 10);
                    $cmd->bindParam(2, $masp, PDO::PARAM_STR, 10);
                    $cmd->bindParam(3, $sln);
                    $cmd->execute();
                   
                }
                return TRUE;
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
    
    // cập nhật dữ liệu
    public static function CapnhatHTCT($mht){
        try {
            self::XoaHTCTtheoIdHT($mht);
            self::ThemHTCT($mht);
            return TRUE;
        } catch (PDOException $e) {
             $error_message = $e->getMessage();
            return $error_message;
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // xóa hàng tồn ct theo idht
    public static function XoaHTCTtheoIdHT($idht){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM hangtonct WHERE IdHT = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $idht, PDO::PARAM_STR, 10);
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
    
    // xóa hàng tồn ct theo idsp
    public static function XoaHTCTtheoIdSP($idsp){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM hangtonct WHERE IdSP = ?";
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
