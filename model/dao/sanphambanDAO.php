<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sanphambanDAO
 *
 * @author DELL
 */
class sanphambanDAO {
    //put your code here
    
    //lấy danh sách spb
    public static function getDSSPB(){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT * FROM sanphamban ORDER BY DATE(NgayTK) DESC, NgayTK DESC";
        try{
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $spb= new sanphamban($value["IdSPB"], $value["IdNV"], $value["TSLBanNgay"], $value["NgayTK"], $value["NgayCN"]);
                    $kq[]=$spb;                  
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
    
    //lấy spb theo mã
    public static function getSPB($idspb){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM sanphamban WHERE IdSPB = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idspb, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $spb= new sanphamban($value["IdSPB"], $value["IdNV"], $value["TSLBanNgay"], $value["NgayTK"], $value["NgayCN"]);
                    return $spb;
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
    
    //lấy spb theo tháng và năm
    public static function getSPBtheoMonthYear($month, $year){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM sanphamban WHERE MONTH(NgayTK) = ? and YEAR(NgayTK) = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $month);
            $cmd->bindParam(2, $year);           
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $spb= new sanphamban($value["IdSPB"], $value["IdNV"], $value["TSLBanNgay"], $value["NgayTK"], $value["NgayCN"]);
                    return $spb;
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
    
    //lấy spb theo mã nhân viên
    public static function getSPBtheoIdNV($idnv){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM sanphamban WHERE IdNV = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idnv, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $spb= new sanphamban($value["IdSPB"], $value["IdNV"], $value["TSLBanNgay"], $value["NgayTK"], $value["NgayCN"]);
                    return $spb;
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
    public static function ThemSPB($month, $year, sanphamban $spb){

        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT SUM(hdbct.SL) as TSL FROM hdbchitiet hdbct INNER JOIN hoadonban hdb ON hdb.IdHDB=hdbct.IdHDB AND MONTH(hdb.`NgayLap`) = ? AND YEAR(hdb.`NgayLap`) = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $month);
            $cmd->bindParam(2, $year);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $sl=0;
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $sl=$value["TSL"];
                }
            }

            $sql = "INSERT INTO sanphamban VALUES(?,?,?,?,?)";
            $cmd = $dbcon->prepare($sql);
            
            $maspb=$spb->getIdSPB();
            $manv=$spb->getIdNV();
            $ngaytk=$spb->getNgayTK();
            $ngaycn=$spb->getNgayCN();
            
            $cmd->bindParam(1, $maspb, PDO::PARAM_STR, 10);
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
    public static function CapnhatSPB($month, $year, sanphamban $spb){
        $dbcon = CommonComand::taoketnoi();
        try {
            $sql = "SELECT SUM(hdbct.SL) as TSL FROM hdbchitiet hdbct INNER JOIN hoadonban hdb ON hdb.IdHDB=hdbct.IdHDB AND MONTH(hdb.`NgayLap`) = ? AND YEAR(hdb.`NgayLap`) = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $month);
            $cmd->bindParam(2, $year);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $sl=0;
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $sl=$value["TSL"];
                }
            }
            
            $maspb=$spb->getIdSPB();
            $ngaycn=$spb->getNgayCN();
            
            $sql = "UPDATE sanphamban SET TSLBanNgay = ?, NgayCN = ? WHERE IdSPB = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $sl);
            $cmd->bindParam(2, $ngaycn);
            $cmd->bindParam(3, $maspb, PDO::PARAM_STR, 10);
            $cmd->execute();
            return TRUE;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }
    
    // cập nhật dữ liệu khi idv thay doi
    public static function CapnhatIdNV($idspb, $idnv){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "UPDATE sanphamban SET IdNV = ? WHERE IdSPB = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $idnv, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $idspb, PDO::PARAM_STR, 10);
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
    public static function XoaSPB($idspb){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM sanphamban WHERE IdSPB = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $idspb, PDO::PARAM_STR, 10);
            
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
    public static function XoaSPBtheoIdNV($idnv){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM sanphamban WHERE IdNV = ?";
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
    public static function TKSPB($key){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM sanphamban INNER JOIN nhanvien on nhanvien.`IdNV` = sanphamban.`IdNV` WHERE (IdSPB like N'%".$key."%') or (TenNV like N'%".$key."%') or (DATE_FORMAT(NgayTK, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') or (TSLBanNgay like N'%".$key."%') or (DATE_FORMAT(NgayCN, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') ORDER BY DATE(NgayTK) DESC, NgayTK DESC";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $spb= new sanphamban($value["IdSPB"], $value["IdNV"], $value["TSLBanNgay"], $value["NgayTK"], $value["NgayCN"]);
                    $kq[]=$spb;                
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
        $ran = rand(1000000, 9999999);
        $kq="SPB".$ran;
        $flag=TRUE;
        $dsnv= self::getDSSPB();
        if(!empty($dsnv)){
            while($flag){
                try {
                    /* @var $dsnv type */
                    foreach ($dsnv as $nv) {
                       if($nv->getIdSPB() == $kq){
                            $ran= rand(1000000, 9999999);
                            $kq="SPB".$ran;
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
