<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sanphambanCTDAO
 *
 * @author DELL
 */
class sanphambanCTDAO {
    //put your code here
    
    //lấy danh sách chi tiết
    public static function getDSSPBCT(){
        $dbcon = CommonComand::taoketnoi();
        $sql = "SELECT * FROM sanphamct ORDER BY SLBan DESC";
        try{
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $spbct= new sanphambanct($value["IdSPB"], $value["IdSP"], $value["SLBan"]);
                    $kq[]=$spbct;                  
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
    public static function getDSSPBCTtheoIdSPB($mspb){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM sanphamct WHERE IdSPB = ? ORDER BY SLBan DESC";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $mspb, PDO::PARAM_STR, 10);            
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $kq=array();
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $spbct= new sanphambanct($value["IdSPB"], $value["IdSP"], $value["SLBan"]);
                    $kq[]=$spbct;
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
    
    //lấy spb chi tiết theo mã ht và mã sp
    public static function getSPBCT($idspb, $idsp){
        $db = CommonComand::taoketnoi();
        try{
            $sql = "SELECT * FROM sanphamct WHERE IdSPB = ? and IdSP = ?";
            $cmd = $db->prepare($sql);
            $cmd->bindParam(1, $idspb, PDO::PARAM_STR, 10); 
            $cmd->bindParam(2, $idsp, PDO::PARAM_STR, 10);
            $cmd->execute();
            $ketqua = $cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $spbct= new sanphambanct($value["IdSPB"], $value["IdSP"], $value["SLBan"]);
                    return $spbct;
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
    public static function ThemSPBCT($month, $year, $mspb){
        
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "SELECT hdbct.`IdSP`, SUM(hdbct.SL) as SL FROM hdbchitiet hdbct INNER JOIN hoadonban hdb ON hdb.IdHDB=hdbct.IdHDB AND MONTH(hdb.`NgayLap`) = ? AND YEAR(hdb.`NgayLap`) = ? group by hdbct.`IdSP`";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindParam(1, $month);
            $cmd->bindParam(2, $year);
            $cmd->execute();
            $ketqua=$cmd->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($ketqua)){
                foreach ($ketqua as $value) {
                    $sql = "INSERT INTO sanphamct VALUES(?,?,?)";
                    $cmd = $dbcon->prepare($sql);
                    $masp=$value["IdSP"];
                    $sl=$value["SL"];
                    $cmd->bindParam(1, $mspb, PDO::PARAM_STR, 10);
                    $cmd->bindParam(2, $masp, PDO::PARAM_STR, 10);
                    $cmd->bindParam(3, $sl);
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
    
    // cập nhật mới dữ liệu
    public static function CapnhatSPBCT($month, $year, $mspb){
        try {
            self::XoaSPBCTtheoIdSPB($mspb);
            self::ThemSPBCT($month, $year, $mspb);
            return TRUE;
        } catch (PDOException $e) {
             $error_message = $e->getMessage();
            return $error_message;
        }
        finally {
            CommonComand::dongketnoi();
        }
    }
    
    // xóa spbct thep idspb
    public static function XoaSPBCTtheoIdSPB($idspb){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM sanphamct WHERE IdSPB = ?";
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
    
    // xóa spbct theo idsp
    public static function XoaSPBCTtheoIdSP($idsp){
        $dbcon = CommonComand::taoketnoi();
        try{
            $sql = "DELETE FROM sanphamct WHERE IdSP = ?";
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
