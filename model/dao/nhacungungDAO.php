<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nhacungungDAO
 *
 * @author DELL
 */
class nhacungungDAO {
    //put your code here
    
    //lấy danh sách nhà cung ứng
    public static function getDSNCU(){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT * FROM nhacungung ORDER BY QuyMo ASC";
        try{
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $ncu= new nhacungung($value["IdNCU"], $value["TenNCU"], $value["DiaChi"], $value["SDT"], $value["Email"], $value["QuyMo"], $value["DanhGia"]);
                    $kq[]=$ncu;                  
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
    
    //lấy nhà cung ứng theo mã
    public static function getNCU($idncu){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM nhacungung WHERE IdNCU = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idncu, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $ncu= new nhacungung($value["IdNCU"], $value["TenNCU"], $value["DiaChi"], $value["SDT"], $value["Email"], $value["QuyMo"], $value["DanhGia"]);
                    return $ncu;
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
    public static function ThemNCU(nhacungung $ncu){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "INSERT INTO nhacungung VALUES(?,?,?,?,?,?,?)";
            $cmd = $dbcon->prepare($sql);
            
            $mancu=$ncu->getIdNCU();
            $tenncu=$ncu->getTenNCU();
            $diachi=$ncu->getDiaChi();
            $sdt=$ncu->getSDT();
            $email=$ncu->getEmail();
            $quymo=$ncu->getQuyMo();
            $danhgia=$ncu->getDanhGia();
            
            $cmd->bindParam(1, $mancu, PDO::PARAM_STR, 10);
            $cmd->bindParam(2, $tenncu, PDO::PARAM_STR);
            $cmd->bindParam(3, $diachi, PDO::PARAM_STR);
            $cmd->bindParam(4, $sdt, PDO::PARAM_STR, 11);
            $cmd->bindParam(5, $email, PDO::PARAM_STR);
            $cmd->bindParam(6, $quymo, PDO::PARAM_INT, 1);
            $cmd->bindParam(7, $danhgia, PDO::PARAM_STR);
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
    public static function CapnhatNCU(nhacungung $ncu){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "UPDATE nhacungung SET TenNCU = ? , DiaChi = ?, SDT = ?, Email = ?, QuyMo = ?, DanhGia = ? WHERE IdNCU = ?";
            $cmd = $dbcon->prepare($sql);
            
            $mancu=$ncu->getIdNCU();
            $tenncu=$ncu->getTenNCU();
            $diachi=$ncu->getDiaChi();
            $sdt=$ncu->getSDT();
            $email=$ncu->getEmail();
            $quymo=$ncu->getQuyMo();
            $danhgia=$ncu->getDanhGia();
            
            $cmd->bindParam(1, $tenncu, PDO::PARAM_STR);
            $cmd->bindParam(2, $diachi, PDO::PARAM_STR);
            $cmd->bindParam(3, $sdt, PDO::PARAM_STR, 11);
            $cmd->bindParam(4, $email, PDO::PARAM_STR);
            $cmd->bindParam(5, $quymo, PDO::PARAM_INT, 1);
            $cmd->bindParam(6, $danhgia, PDO::PARAM_STR);
            $cmd->bindParam(7, $mancu, PDO::PARAM_STR, 10);
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
    public static function XoaNCU($idncu){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM nhacungung WHERE IdNCU = ?";
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
    public static function TKNCU($key){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM nhacungung WHERE (Email like N'%".$key."%') or (TenNCU like N'%".$key."%') or (IdNCU like N'%".$key."%') or (DiaChi like N'%".$key."%') or (QuyMo like N'%".$key."%') or (DanhGia like N'%".$key."%') or (SDT like N'%".$key."%') ORDER BY QuyMo ASC";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $ncu= new nhacungung($value["IdNCU"], $value["TenNCU"], $value["DiaChi"], $value["SDT"], $value["Email"], $value["QuyMo"], $value["DanhGia"]);
                    $kq[]=$ncu;                  
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
        $kq="NCU".$ran;
        $flag=TRUE;
        $dsnv= self::getDSNCU();
        if(!empty($dsnv)){
            while($flag){
                try {
                    /* @var $dsnv type */
                    foreach ($dsnv as $nv) {
                       if($nv->getIdNCU() == $kq){
                            $ran= rand(1000000, 9999999);
                            $kq="NCU".$ran;
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
