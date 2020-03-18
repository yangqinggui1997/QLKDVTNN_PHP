<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hangtonDAO
 *
 * @author DELL
 */
class hangtonDAO {
    //put your code here
    
    //lấy danh sách hàng tồn
    public static function getDSHT(){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT * FROM hangton ORDER BY DATE(NgayTK) DESC, NgayTK DESC";
        try{
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $ht= new hangton($value["IdHT"], $value["IdNV"], $value["TongSLTNgay"], $value["NgayTK"], $value["NgayCN"]);
                    $kq[]=$ht;                  
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
    
    //lấy hàng tồn theo mã
    public static function getHT($idht){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM hangton WHERE IdHT = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idht, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $ht= new hangton($value["IdHT"], $value["IdNV"], $value["TongSLTNgay"], $value["NgayTK"], $value["NgayCN"]);
                    return $ht;
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
    
    //lấy hàng tồn theo tháng và năm
    public static function getHTtheoMonthYear($month, $year){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM hangton WHERE MONTH(NgayTK) = ? and YEAR(NgayTK) = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $month);
            $cmd->bindParam(2, $year);           
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $ht= new hangton($value["IdHT"], $value["IdNV"], $value["TongSLTNgay"], $value["NgayTK"], $value["NgayCN"]);
                    return $ht;
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
    
    //lấy mã hàng tồn theo mã nhân viên
    public static function getHTtheoIdNV($idnv){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM hangton WHERE IdNV = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idnv, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $ht= new hangton($value["IdHT"], $value["IdNV"], $value["TongSLTNgay"], $value["NgayTK"], $value["NgayCN"]);
                    return $ht;
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
    public static function ThemHT(hangton $ht){

        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT SUM(SLNhap) AS SLTon FROM sanpham";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $sl=0;
            foreach ($ketqua as $value) {
                $sl=$value["SLTon"];
            }
            
            $sql = "INSERT INTO hangton VALUES(?,?,?,?,?)";
            $cmd = $dbcon->prepare($sql);
            
            $maht=$ht->getIdHT();
            $manv=$ht->getIdNV();
            $ngaytk=$ht->getNgayTK();
            $ngaycn=$ht->getNgayCN();
            
            $cmd->bindParam(1, $maht, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $manv, PDO::PARAM_STR, 10);
            $cmd->bindParam(3, $sl);
            $cmd->bindParam(4, $ngaytk);
            $cmd->bindParam(5, $ngaycn);
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
    public static function CapnhatHT(hangton $ht){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT SUM(SLNhap) AS SLTon FROM sanpham";
        try {
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $sl=0;
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $sl=$value["SLTon"];
                }
            }
            $sql = "UPDATE hangton SET TongSLTNgay = ?, NgayCN = ? WHERE IdHT = ?";
            $cmd = $dbcon->prepare($sql);
            
            $ngaycn=$ht->getNgayCN();
            $maht=$ht->getIdHT();
            
            $cmd->bindParam(1, $sl);
            $cmd->bindParam(2, $ngaycn);
            $cmd->bindParam(3, $maht, PDO::PARAM_STR, 10);
            $cmd->execute();
            return TRUE;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }
    // cập nhật dữ liệu khi idv thay doi
    public static function CapnhatIdNV($idht, $idnv){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "UPDATE hangton SET IdNV = ? WHERE IdHT = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $idnv, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $idht, PDO::PARAM_STR, 10);
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
    public static function XoaHT($idht){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM hangton WHERE IdHT = ?";
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
    
    // xóa hang ton theo idnv
    public static function XoaHTtheoIdNV($idnv){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM hangton WHERE IdNV = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $idnv, PDO::PARAM_STR, 10);
            
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
    public static function TKHT($key){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM hangton INNER JOIN nhanvien on nhanvien.`IdNV` = hangton.`IdNV` WHERE (IdHT like N'%".$key."%') or (TenNV like N'%".$key."%') or (DATE_FORMAT(NgayTK, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') or (TongSLTNgay like N'%".$key."%') or (DATE_FORMAT(NgayCN, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') ORDER BY DATE(NgayTK) DESC, NgayTK DESC";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $ht= new hangton($value["IdHT"], $value["IdNV"], $value["TongSLTNgay"], $value["NgayTK"], $value["NgayCN"]);
                    $kq[]=$ht;                 
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
        $kq="HT".$ran;
        $flag=TRUE;
        $dsnv= self::getDSHT();
        if(!empty($dsnv)){
            while($flag){
                try {
                    /* @var $dsnv type */
                    foreach ($dsnv as $nv) {
                       if($nv->getIdHT() == $kq){
                            $ran= rand(10000000, 99999999);
                            $kq="HT".$ran;
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
