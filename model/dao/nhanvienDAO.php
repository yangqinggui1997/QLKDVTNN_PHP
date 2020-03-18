<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nhanvienDAO
 *
 * @author DELL
 */

class nhanvienDAO {
    //put your code here
    
    // Lấy danh sách
    public static function getDSNV(){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM nhanvien ORDER BY DATE(NgayVaoLam) DESC, NgayVaoLam DESC";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $nv= new nhanvien($value["IdNV"], $value["TenNV"], $value["NgaySinh"], $value["GioiTinh"], $value["SoCMND"], $value["SDT"], $value["DiaChi"], $value["ChucVu"], $value["NgayVaoLam"]);
                    $kq[]=$nv;                  
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
    
    // Lấy nv theo mã nv bán hàng
    public static function getDSNVBH(){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM nhanvien WHERE IdNV like N'%NVBH%'";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $nv= new nhanvien($value["IdNV"], $value["TenNV"], $value["NgaySinh"], $value["GioiTinh"], $value["SoCMND"], $value["SDT"], $value["DiaChi"], $value["ChucVu"], $value["NgayVaoLam"]);
                    $kq[]=$nv;                  
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
    
    // Lấy nv theo mã nv
    public static function getNV($ma){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM nhanvien WHERE IdNV = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $ma, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $nv= new nhanvien($value["IdNV"], $value["TenNV"], $value["NgaySinh"], $value["GioiTinh"], $value["SoCMND"], $value["SDT"], $value["DiaChi"], $value["ChucVu"], $value["NgayVaoLam"]);
                    return $nv;
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
    
    // Thêm mới
    public static function ThemNV(nhanvien $nv){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "INSERT INTO nhanvien VALUES(?,?,?,?,?,?,?,?,?)";
            $cmd = $dbcon->prepare($sql);
            
            $manv=$nv->getIdNV();
            $tennv=$nv->getTenNV();
            $ngaysinh=$nv->getNgaySinh();
            $gioitinh=$nv->getGioiTinh();
            $socmnd=$nv->getSoCMND();
            $sdt=$nv->getSDT();
            $diachi=$nv->getDiaChi();
            $chucvu=$nv->getChucVu();
            $nvl=$nv->getNgayVaoLam();
            
            $cmd->bindParam(1, $manv, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $tennv, PDO::PARAM_STR, 10);
            $cmd->bindParam(3, $ngaysinh);
            $cmd->bindParam(4, $gioitinh, PDO::PARAM_INT, 1);
            $cmd->bindParam(5, $socmnd, PDO::PARAM_STR, 9);
            $cmd->bindParam(6, $sdt, PDO::PARAM_STR, 11);
            $cmd->bindParam(7, $diachi, PDO::PARAM_STR);
            $cmd->bindParam(8, $chucvu, PDO::PARAM_INT, 1);
            $cmd->bindParam(9, $nvl);
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
    
    // cập nhật
    public static function CapnhatNV(nhanvien $nv){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "UPDATE nhanvien SET TenNV = ?, NgaySinh = ?, GioiTinh = ?, SoCMND = ?, SDT = ?, DiaChi = ?, ChucVu = ?, NgayVaoLam = ? WHERE IdNV = ?";
            $cmd = $dbcon->prepare($sql);
            
            $manv=$nv->getIdNV();
            $tennv=$nv->getTenNV();
            $ngaysinh=$nv->getNgaySinh();
            $gioitinh=$nv->getGioiTinh();
            $socmnd=$nv->getSoCMND();
            $sdt=$nv->getSDT();
            $diachi=$nv->getDiaChi();
            $chucvu=$nv->getChucVu();
            $nvl=$nv->getNgayVaoLam();
            
            $cmd->bindParam(1, $tennv, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $ngaysinh);
            $cmd->bindParam(3, $gioitinh, PDO::PARAM_INT, 1);
            $cmd->bindParam(4, $socmnd, PDO::PARAM_STR, 9);
            $cmd->bindParam(5, $sdt, PDO::PARAM_STR, 11);
            $cmd->bindParam(6, $diachi, PDO::PARAM_STR);
            $cmd->bindParam(7, $chucvu, PDO::PARAM_INT, 1);
            $cmd->bindParam(8, $nvl);
            $cmd->bindParam(9, $manv, PDO::PARAM_STR, 10);
            
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
    
    // Xóa 
    public static function XoaNV($idnv){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM nhanvien WHERE IdNV = ?";
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
    public static function TKNV($key){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM nhanvien WHERE (IdNV like N'%".$key."%') or (TenNV like N'%".$key."%') or (DATE_FORMAT(NgaySinh, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') or (GioiTinh like N'%".$key."%') or (SoCMND like N'%".$key."%') or (DiaChi like N'%".$key."%') or (ChucVu like N'%".$key."%') or (DATE_FORMAT(NgayVaoLam, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') or (SDT like N'%".$key."%') ORDER BY DATE(NgayVaoLam) DESC, NgayVaoLam DESC";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $nv= new nhanvien($value["IdNV"], $value["TenNV"], $value["NgaySinh"], $value["GioiTinh"], $value["SoCMND"], $value["SDT"], $value["DiaChi"], $value["ChucVu"], $value["NgayVaoLam"]);
                    $kq[]=$nv;                  
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
    
    public static function TaoMaNN($loainv){
        $kq="";
        switch($loainv){
            case 1: 
                $nv="NVQT";
                $kq= self::TaoNN($nv);
            break;
            case 2: 
                $nv="NVKT";
                $kq= self::TaoNN($nv);
            break;
            case 3: 
                $nv="NVBH";
                $kq= self::TaoNN($nv);
            break;
            default:
                $nv="NVTK";
                $kq= self::TaoNN($nv);
                break;
        }       
        return $kq;
    }
    
    public static function TaoNN($mnv){
        $ran = rand(100000, 999999);
        $kq=$mnv.$ran;
        $flag=TRUE;
        $dsnv= self::getDSNV();
        if(!empty($dsnv)){
            while($flag){
                try {
                    /* @var $dsnv type */
                    foreach ($dsnv as $nv) {
                       if($nv->getIdNV() == $kq){
                            $ran= rand(100000, 999999);
                            $kq=$mnv.$ran;
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
