<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nguoidungDAO
 *
 * @author DELL
 */
class nguoidungDAO {
    //put your code here
    
    // Lấy danh sách
    public static function getDSND(){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM nguoi_dung ORDER BY DATE(NgayTaoTK) DESC, NgayTaoTK DESC";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $nd= new nguoidung($value["IdND"], $value["IdNV"], $value["TenTK"], $value["MK"], $value["NgayTaoTK"], $value["SuaMKLanCuoi"], $value["TrangThai"], $value["LoaiND"]);
                    $kq[]=$nd;                  
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
    
    //Kiểm tra đăng nhập
    public static function KTTKDN($username, $PassWord){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT * FROM nguoi_dung WHERE TenTK = ? and MK = ?";
        try{
            $cmd=$dbcon->prepare($sql);
            $cmd->bindParam(1, $username, PDO::PARAM_STR);
            $cmd->bindParam(2, $PassWord, PDO::PARAM_STR);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $kq) {
                    $nd= new nguoidung($kq["IdND"], $kq["IdNV"], $kq["TenTK"], $kq["MK"], $kq["NgayTaoTK"], $kq["SuaMKLanCuoi"], $kq["TrangThai"], $kq["LoaiND"]);
                    return $nd;
                }

            }
            else{
                return NULL;  
            }
        }
         catch (PDOException $ex){
            return $ex->getMessage();
         }
    }
    
    // Lấy nd theo mã nv
    public static function getND($ma){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM nguoi_dung WHERE IdND = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $ma, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $kq) {
                    $nd= new nguoidung($kq["IdND"], $kq["IdNV"], $kq["TenTK"], $kq["MK"], $kq["NgayTaoTK"], $kq["SuaMKLanCuoi"], $kq["TrangThai"], $kq["LoaiND"]);
                    return $nd;
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
    
    //lấy nd theo mã nv
    public static function getNDTheoIdNV($manv){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM nguoi_dung WHERE IdNV = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $manv, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $nd= new nguoidung($value["IdND"], $value["IdNV"], $value["TenTK"], $value["MK"], $value["NgayTaoTK"], $value["SuaMKLanCuoi"], $value["TrangThai"], $value["LoaiND"]);
                    $kq[]=$nd;                  
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
    
    //lấy nd theo tên tk
    public static function getNDTheoTenTK($tentk){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM nguoi_dung WHERE TenTK = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $tentk, PDO::PARAM_STR);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $kq) {
                    $nd= new nguoidung($kq["IdND"], $kq["IdNV"], $kq["TenTK"], $kq["MK"], $kq["NgayTaoTK"], $kq["SuaMKLanCuoi"], $kq["TrangThai"], $kq["LoaiND"]);
                    return $nd;
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
    public static function ThemND(nguoidung $nd){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "INSERT INTO nguoi_dung VALUES(?,?,?,?,?,?,?,?)";
            $cmd = $dbcon->prepare($sql);
            
            $mand=$nd->getIdND();
            $manv=$nd->getIdNV();
            $tentk=$nd->getTenTK();
            $mk=$nd->getMK();
            $ngaytaotk=$nd->getNgayTaoTK();
            $trangthai=$nd->getTrangThai();
            $loaind=$nd->getLoaiND();
            $suamklanccuoi=$nd->getSuaMKLanCuoi();
            
            $cmd->bindParam(1, $mand, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $manv, PDO::PARAM_STR, 10);
            $cmd->bindParam(3, $tentk, PDO::PARAM_STR);
            $cmd->bindParam(4, $mk, PDO::PARAM_STR);
            $cmd->bindParam(5, $ngaytaotk);
            $cmd->bindParam(6, $suamklanccuoi);
            $cmd->bindParam(7, $trangthai, PDO::PARAM_INT, 1);
            $cmd->bindParam(8, $loaind, PDO::PARAM_INT, 1);
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
    
    //kiểm tra mật khẩu trước khi đổi
    public static function KTMK($idnd, $mk){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM nguoi_dung WHERE IdND= ? AND MK = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idnd, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $mk, PDO::PARAM_STR);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                return TRUE;
            }
            else{
                return FALSE;
            }
        }
        catch (PDOException $ex){
            return $ex->getMessage();
        }
        finally {
            CommonComand::dongketnoi();
        }
        
    }
    
    // cập nhật mật khẩu
    public static function CapnhatMK($idnd, $mkmoi){
        $dbcon= CommonComand::taoketnoi();
        $sql = "UPDATE nguoi_dung SET MK = ?, SuaMKLanCuoi = ? WHERE IdND = ?";
        try {
            $cmd=$dbcon->prepare($sql);
            $cmd->bindParam(1, $mkmoi, PDO::PARAM_STR);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now= date("Y-m-d H:i:s");          
            $cmd->bindParam(2, $now);
            $cmd->bindParam(3, $idnd, PDO::PARAM_STR, 10);
            $cmd->execute();
           
            return TRUE;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // cập nhật khoá tài khoản
    public static function CapnhatKhoaTK($idnd, $khoa){
        $dbcon= CommonComand::taoketnoi();
        $sql = "UPDATE nguoi_dung SET TrangThai = ?  WHERE IdND = ?";
        try {
            $cmd=$dbcon->prepare($sql);
            $cmd->bindParam(1, $khoa, PDO::PARAM_INT);
            $cmd->bindParam(2, $idnd, PDO::PARAM_STR, 10);
            $cmd->execute();
           
            return TRUE;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // cập nhật loại ND
    public static function CapnhatNhomND($idnd, $nnd){
        $dbcon= CommonComand::taoketnoi();
        $sql = "UPDATE nguoi_dung SET LoaiND = ?, IdND=? WHERE IdND = ?";
        try {
            $cmd=$dbcon->prepare($sql);
            $cmd->bindParam(1, $nnd, PDO::PARAM_INT);
            $idmoi=0;
            switch ($nnd){
                case 1:
                    $idmoi=1;
                    break;
                case 2:
                    $idmoi=2;
                    break;
                case 3:
                    $idmoi=3;
                    break;
                default:
                    $idmoi=4;
                    break;  
            }
            $mamoi= self::TaoMaNN($idmoi);
            $cmd->bindParam(2, $mamoi, PDO::PARAM_STR, 10);
            $cmd->bindParam(3, $idnd, PDO::PARAM_STR, 10);
            $cmd->execute();
           
            return TRUE;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // cập nhật mnv
    public static function CapnhatIdNV($idnd, $idnv){
        $dbcon= CommonComand::taoketnoi();
        $sql = "UPDATE nguoi_dung SET IdNV = ? WHERE IdND = ?";
        try {
            $cmd=$dbcon->prepare($sql);
            $cmd->bindParam(1, $idnv, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $idnd, PDO::PARAM_STR, 10);
            $cmd->execute();
           
            return TRUE;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // cập nhật mnd khi mnv thay doi
    public static function CapnhatIdND($idndmoi, $idndcu){
        $dbcon= CommonComand::taoketnoi();
        $sql = "UPDATE nguoi_dung SET IdND = ? WHERE IdND = ?";
        try {
            $cmd=$dbcon->prepare($sql);
            $cmd->bindParam(1, $idndmoi, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $idndcu, PDO::PARAM_STR, 10);
            $cmd->execute();
           
            return TRUE;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // xóa dữ liệu
    public static function XoaND($idnd){
        $dbcon= CommonComand::taoketnoi();
        $sql = "DELETE FROM nguoi_dung WHERE IdND = ?";
        try {
            $cmd=$dbcon->prepare($sql);
            $cmd->bindParam(1, $idnd, PDO::PARAM_STR, 10);
            $cmd->execute();
           
            return TRUE;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // xóa người dùng theo mã nv
    public static function XoaNDtheoIdNV($idnv){
        $dbcon= CommonComand::taoketnoi();
        $sql = "DELETE FROM nguoi_dung WHERE IdNV = ?";
        try {
            $cmd=$dbcon->prepare($sql);
            $cmd->bindParam(1, $idnv, PDO::PARAM_STR, 10);
            $cmd->execute();
           
            return TRUE;
        } catch (PDOException $ex) {
            return $ex->getMessage();
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // tìm kiếm
    public static function TKND($key){
        $dbcon= CommonComand::taoketnoi();
        $sql = "SELECT * FROM nguoi_dung WHERE (IdND like N'%".$key."%') or (IdNV like N'%".$key."%') or (TenTK like N'%".$key."%') or (DATE_FORMAT(NgayTaoTK, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') or (DATE_FORMAT(SuaMKLanCuoi, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') ORDER BY DATE(NgayTaoTK) DESC, NgayTaoTK DESC";
        try{
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $nd= new nguoidung($value["IdND"], $value["IdNV"], $value["TenTK"], $value["MK"], $value["NgayTaoTK"], $value["SuaMKLanCuoi"], $value["TrangThai"], $value["LoaiND"]);
                    $kq[]=$nd;                  
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
    
    public static function TaoNN($mnv){
        $ran = rand(100000, 999999);
        $kq=$mnv.$ran;
        $flag=TRUE;
        $dsnv= self::getDSND();
        if(!empty($dsnv)){
            while($flag){
                try {
                    /* @var $dsnv type */
                    foreach ($dsnv as $nv) {
                       if($nv->getIdND() == $kq){
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
    
    public static function TaoMaNN($loaind){
        $kq="";
        switch($loaind){
            case 1: 
                $nv="NDQT";
                $kq= self::TaoNN($nv);
            break;
            case 2: 
                $nv="NDKT";
                $kq= self::TaoNN($nv);
            break;
            case 3: 
                $nv="NDBH";
                $kq= self::TaoNN($nv);
            break;
            case 4: 
                $nv="NDTK";
                $kq= self::TaoNN($nv);
            break;
            default:
                break;
        }       
        return $kq;
    }
    
    
}
