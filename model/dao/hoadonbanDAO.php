<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hoadonbanDAO
 *
 * @author DELL
 */
class hoadonbanDAO {
    //put your code here
    
    //lấy danh sách hoá đơn bán
    public static function getDSHDB(){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT * FROM hoadonban ORDER BY DATE(NgayLap) DESC, NgayLap DESC";
        try{
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $hdb= new hoadonban($value["IdHDB"], $value["IdNV"], $value["IdKH"], $value["NgayLap"], $value["HinhThucTT"], $value["DaThanhToan"], $value["TongSL"], $value["TongTien"], $value["TinhTrang"], $value["DaNhan"], $value["NgayCN"]);
                    $kq[]=$hdb;                  
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
    
    //lấy hoá đơn bán theo mã
    public static function getHDB($idhdb){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM hoadonban WHERE IdHDB = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idhdb, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $hdb= new hoadonban($value["IdHDB"], $value["IdNV"], $value["IdKH"], $value["NgayLap"], $value["HinhThucTT"], $value["DaThanhToan"], $value["TongSL"], $value["TongTien"], $value["TinhTrang"], $value["DaNhan"], $value["NgayCN"]);
                    return $hdb;
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
    
    //lấy mã hoá đơn theo mã nhân viên
    public static function getHDBtheoIdNV($idnv){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM hoadonban WHERE IdNV = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idnv, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $hdb= new hoadonban($value["IdHDB"], $value["IdNV"], $value["IdKH"], $value["NgayLap"], $value["HinhThucTT"], $value["DaThanhToan"], $value["TongSL"], $value["TongTien"], $value["TinhTrang"], $value["DaNhan"], $value["NgayCN"]);
                    $kq[]=$hdb;                  
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
    
    //lấy hoá đơn bán theo mã khách hàng
    public static function getHDBtheoIdKH($idkh){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM hoadonban WHERE IdKH = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idkh, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $hdb= new hoadonban($value["IdHDB"], $value["IdNV"], $value["IdKH"], $value["NgayLap"], $value["HinhThucTT"], $value["DaThanhToan"], $value["TongSL"], $value["TongTien"], $value["TinhTrang"], $value["DaNhan"], $value["NgayCN"]);
                    $kq[]=$hdb;                  
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
    public static function ThemHDB(hoadonban $hdb){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "INSERT INTO hoadonban VALUES(?,?,?,?,?,?,?,?,?,?,?)";
            $cmd = $dbcon->prepare($sql);
            
            $mahdb=$hdb->getIdHDB();
            $manv=$hdb->getIdNV();
            $makh=$hdb->getIdKH();
            $ngaylap=$hdb->getNgayLap();
            $hinthuctt=$hdb->getHinhThucTT();
            $datt=$hdb->getDaThanhToan();
            $tongsl=$hdb->getTongSL();
            $tt=$hdb->getTongTien();
            $tinhtrang=$hdb->getTinhTrang();
            $danhan=$hdb->getDaNhan();
            $ngaycn=$hdb->getNgayCN();
                    
            $cmd->bindParam(1, $mahdb, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $manv, PDO::PARAM_STR, 10);
            $cmd->bindParam(3, $makh, PDO::PARAM_STR, 10);
            $cmd->bindParam(4, $ngaylap);
            $cmd->bindParam(5, $hinthuctt, PDO::PARAM_INT, 1);
            $cmd->bindParam(6, $datt);
            $cmd->bindParam(7, $tongsl);
            $cmd->bindParam(8, $tt);
            $cmd->bindParam(9, $tinhtrang, PDO::PARAM_INT, 1);
            $cmd->bindParam(10, $danhan, PDO::PARAM_INT, 1);
            $cmd->bindParam(11, $ngaycn);
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
    public static function CapnhatHDB(hoadonban $hdb){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "UPDATE hoadonban SET IdNV = ?, IdKH = ?, HinhThucTT = ?, DaThanhToan = ?, TongSL = ?, TongTien= ?, TinhTrang = ?, NgayCN = ?, DaNhan= ? WHERE IdHDB = ?";
            $cmd = $dbcon->prepare($sql);
            
            $mahdb=$hdb->getIdHDB();
            $manv=$hdb->getIdNV();
            $makh=$hdb->getIdKH();
            $hinthuctt=$hdb->getHinhThucTT();
            $datt=$hdb->getDaThanhToan();
            $tongsl=$hdb->getTongSL();
            $tt=$hdb->getTongTien();
            $tinhtrang=$hdb->getTinhTrang();
            $danhan=$hdb->getDaNhan();
            $ngaycn=$hdb->getNgayCN();
            
            $cmd->bindParam(1, $manv, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $makh, PDO::PARAM_STR, 10);
            $cmd->bindParam(3, $hinthuctt, PDO::PARAM_INT, 1);
            $cmd->bindParam(4, $datt);
            $cmd->bindParam(5, $tongsl);
            $cmd->bindParam(6, $tt);
            $cmd->bindParam(7, $tinhtrang, PDO::PARAM_INT, 1);
            
            $cmd->bindParam(8, $ngaycn);
            $cmd->bindParam(9, $danhan, PDO::PARAM_INT, 1);
            $cmd->bindParam(10, $mahdb, PDO::PARAM_STR, 10);
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
    
    // cập nhật dữ liệu khi idnv thay doi
    public static function CapnhatIdNV($idhdb, $idnv){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "UPDATE hoadonban SET IdNV = ? WHERE IdHDB = ?";
            $cmd = $dbcon->prepare($sql);
            
            $cmd->bindParam(1, $idnv, PDO::PARAM_STR, 10);
            
            $cmd->bindParam(2, $idhdb, PDO::PARAM_STR, 10);
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
    
    // cập nhật dữ liệu khi idkh thay doi
    public static function CapnhatIdKH($idhdb, $idkh){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "UPDATE hoadonban SET IdKH = ? WHERE IdHDB = ?";
            $cmd = $dbcon->prepare($sql);
            
            $cmd->bindParam(1, $idkh, PDO::PARAM_STR, 10);
            
            $cmd->bindParam(2, $idhdb, PDO::PARAM_STR, 10);
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
    public static function XoaHDB($idhdb){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM hoadonban WHERE IdHDB = ?";
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
    
    // xóa hdb theo idnv
    public static function XoaHDBtheoIdNV($idnv){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM hoadonban WHERE IdNV = ?";
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
    
    // xóa hdb theo idkh
    public static function XoaHDBtheoIdKH($idkh){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM hoadonban WHERE IdKH = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $idkh, PDO::PARAM_STR, 10);
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
    
    // tính tổng số lượng
    public static function TongSLUpdate($idhdb){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT SUM(SL) AS SL FROM hdbchitiet WHERE IdHDB = ?";
        try {
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $idhdb, PDO::PARAM_STR, 10);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $sl=0;
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $sl=$value["SL"];
                }
            }
            
            
            $sql = "UPDATE hoadonban SET TongSL = ? WHERE IdHDB = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $sl);
            $cmd->bindParam(2, $idhdb, PDO::PARAM_STR, 10);
            $cmd->execute();
            return TRUE;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        
    }
    
    // tính tổng tiền
    public static function TongTienUpdate($idhdb){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT SUM(ThanhTien) AS TT FROM hdbchitiet WHERE IdHDB = ?";
        try {
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $idhdb, PDO::PARAM_STR, 10);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $tt=0;
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $tt=$value["TT"];
                }
            }
            
            $sql = "UPDATE hoadonban SET TongTien = ? WHERE IdHDB = ?";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $tt);
            $cmd->bindParam(2, $idhdb, PDO::PARAM_STR, 10);
            $cmd->execute();
            return TRUE;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }
    
    // cập nhật dã thanh toán
    public static function DathanhToanUpdate($idhdb, $dathanhtoan){
        $dbcon = CommonComand::taoketnoi();
        $sql = "UPDATE hoadonban SET DaThanhToan = ? WHERE IdHDB = ?";
        try {
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $dathanhtoan);
            $cmd->bindParam(2, $idhdb, PDO::PARAM_STR, 10);
            $cmd->execute();
            
            return TRUE;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
    }
    
    // tìm kiếm
    public static function TKHDB($key){
        
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM hoadonban inner join khachhang on khachhang.`SoCMND` = hoadonban.`IdKH` inner join nhanvien on hoadonban.`IdNV` = nhanvien.`IdNV` WHERE (IdHDB like N'%".$key."%') or (TenNV like N'%".$key."%') or (TenKH like N'%".$key."%') or (DATE_FORMAT(NgayLap, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') or (HinhThucTT like N'%".$key."%') or (DaThanhToan like N'%".$key."%') or (TongSL like N'%".$key."%') or (TongTien like N'%".$key."%') or (TinhTrang like N'%".$key."%') or (DATE_FORMAT(NgayCN, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') ORDER BY DATE(NgayLap) DESC, NgayLap DESC";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $hdb= new hoadonban($value["IdHDB"], $value["IdNV"], $value["IdKH"], $value["NgayLap"], $value["HinhThucTT"], $value["DaThanhToan"], $value["TongSL"], $value["TongTien"], $value["TinhTrang"], $value["DaNhan"], $value["NgayCN"]);
                    $kq[]=$hdb;                 
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
        $kq="HDB".$ran;
        $flag=TRUE;
        $dsnv= self::getDSHDB();
        if(!empty($dsnv)){
            while($flag){
                try {
                    /* @var $dsnv type */
                    foreach ($dsnv as $nv) {
                       if($nv->getIdHDB() == $kq){
                            $ran= rand(1000000, 9999999);
                            $kq="HDB".$ran;
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
