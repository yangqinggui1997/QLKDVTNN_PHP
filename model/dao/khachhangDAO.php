<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of khachhangDAO
 *
 * @author DELL
 */
class khachhangDAO {
    //put your code here
    
    //lấy danh sách khách hàng
    public static function getDSKH(){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT * FROM khachhang ORDER BY LoaiKH ASC";
        try{
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $kh= new khachhang($value["TenKH"], $value["NgaySinh"], $value["GioiTinh"], $value["SoCMND"], $value["SDT"], $value["Email"], $value["DiaChi"], $value["LoaiKH"], $value["DanhGia"]);
                    $kq[]=$kh;                  
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
    
    //lấy khách hàng theo mã
    public static function getKH($idkh){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM khachhang WHERE SoCMND = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idkh, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $kh= new khachhang($value["TenKH"], $value["NgaySinh"], $value["GioiTinh"], $value["SoCMND"], $value["SDT"], $value["Email"], $value["DiaChi"], $value["LoaiKH"], $value["DanhGia"]);
                    return $kh;
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
    public static function ThemKH(khachhang $kh){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "INSERT INTO khachhang VALUES(?,?,?,?,?,?,?,?,?)";
            $cmd = $dbcon->prepare($sql);
            
            $tenkh=$kh->getTenKH();
            $ngaysinh=$kh->getNgaySinh();
            $gioitinh=$kh->getGioiTinh();
            $socmnd=$kh->getSoCMND();
            $sdt=$kh->getSDT();
            $email=$kh->getEmail();
            $diachi=$kh->getDiaChi();
            $loaikh=$kh->getLoaiKH();
            $danhgia=$kh->getDanhGia();
            
            $cmd->bindParam(1, $tenkh, PDO::PARAM_STR);
            $cmd->bindParam(2, $ngaysinh);
            $cmd->bindParam(3, $gioitinh, PDO::PARAM_INT, 1);
            $cmd->bindParam(4, $socmnd, PDO::PARAM_STR, 9);
            $cmd->bindParam(5, $sdt, PDO::PARAM_STR, 11);
            $cmd->bindParam(6, $email, PDO::PARAM_STR);
            $cmd->bindParam(7, $diachi, PDO::PARAM_STR);
            $cmd->bindParam(8, $loaikh, PDO::PARAM_INT, 1);
            $cmd->bindParam(9, $danhgia, PDO::PARAM_STR);
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
    public static function CapnhatKH(khachhang $kh){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "UPDATE khachhang SET TenKH = ? , NgaySinh = ?, GioiTinh = ?, Email = ?, SDT = ?, DiaChi = ?, LoaiKH= ?, DanhGia = ? WHERE SoCMND = ?";
            $cmd = $dbcon->prepare($sql);
            
            $tenkh=$kh->getTenKH();
            $ngaysinh=$kh->getNgaySinh();
            $gioitinh=$kh->getGioiTinh();
            $socmnd=$kh->getSoCMND();
            $sdt=$kh->getSDT();
            $email=$kh->getEmail();
            $diachi=$kh->getDiaChi();
            $loaikh=$kh->getLoaiKH();
            $danhgia=$kh->getDanhGia();
            
            $cmd->bindParam(1, $tenkh, PDO::PARAM_STR);
            $cmd->bindParam(2, $ngaysinh);
            $cmd->bindParam(3, $gioitinh, PDO::PARAM_INT, 1);
            $cmd->bindParam(4, $email, PDO::PARAM_STR);
            $cmd->bindParam(5, $sdt, PDO::PARAM_STR, 11);
            $cmd->bindParam(6, $diachi, PDO::PARAM_STR);
            $cmd->bindParam(7, $loaikh, PDO::PARAM_INT, 1);
            $cmd->bindParam(8, $danhgia, PDO::PARAM_STR);
            $cmd->bindParam(9, $socmnd, PDO::PARAM_STR, 9);
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
    public static function XoaKH($idkh){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM khachhang WHERE SoCMND = ?";
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
    
    // tìm kiếm
    public static function TKKH($key){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM khachhang WHERE (Email like N'%".$key."%') or (TenKH like N'%".$key."%') or (DATE_FORMAT(NgaySinh, '%d/%m/%Y %h:%i:%s %p') like N'%".$key."%') or (GioiTinh like N'%".$key."%') or (SoCMND like N'%".$key."%') or (DiaChi like N'%".$key."%') or (LoaiKH like N'%".$key."%') or (DanhGia like N'%".$key."%') or (SDT like N'%".$key."%') ORDER BY LoaiKH ASC";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $kh= new khachhang($value["TenKH"], $value["NgaySinh"], $value["GioiTinh"], $value["SoCMND"], $value["SDT"], $value["Email"], $value["DiaChi"], $value["LoaiKH"], $value["DanhGia"]);
                    $kq[]=$kh;                  
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
}
