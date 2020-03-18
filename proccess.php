<?php
header("Content-Type: text/html; charset=utf-8");


require_once './model/Common/CommonComand.php';
require_once './model/dto/nhanvien.php';
require_once './model/dto/nguoidung.php';
require_once './model/dao/nhanvienDAO.php';
require_once './model/dao/nguoidungDAO.php';
require_once './model/bus/nhanvienBUS.php';
require_once './model/bus/nguoidungBUS.php';


if(isset($_REQUEST['username']) && isset($_REQUEST['pass'])){
    $user=$_REQUEST['username'];
    $pass=$_REQUEST['pass'];
    if($user != NULL && $pass != NULL){
        $hash="YANGGUI1997";
        $secret= CommonComand::Encrypt($pass, $hash);
        $nd= nguoidungBUS::KTTKDN($user, $secret);
        if($nd != NULL){
            $mand=$nd->getIdND();
            $tennd=$nd->getTenTK();
            $trangthai= intval($nd->getTrangThai());
            if($trangthai == 0){
                echo "bikhoa";
            }
            else{
                //cập nhật trạng thái người dùng đăng nhập
                nguoidungBUS::CapnhatKhoaTK($mand, 1);
//                session_start();
                $_SESSION["tennd"]=$tennd;
                $_SESSION["mand"]=$mand;

                //dữ liệu trả về
                echo $mand."|".$tennd;
            }
        }
        else{
            echo "NULL";
        }
     }
}


if(isset($_REQUEST["hd"])){
    $hd=$_REQUEST["hd"];
    if(isset($_REQUEST["manv"]))
        $manv=$_REQUEST["manv"];
    if(isset($_REQUEST["tentk"]))
        $tentk=$_REQUEST["tentk"];
    if(isset($_REQUEST["mk"]))  
        $mk=$_REQUEST["mk"];
    if(isset($_REQUEST["mand"]))
        $mand=$_REQUEST["mand"];
    if(isset($_REQUEST["mkcu"])) 
        $mkcu=$_REQUEST["mkcu"];
    if(isset($_REQUEST["mkmoi"]))
        $mkmoi=$_REQUEST["mkmoi"];
    if($hd!=NULL){
        if($hd=="dktk"){
            if($manv != NULL && $tentk != NULL && $mk != NULL){
                $id=0;
                if(substr($manv, 0, 4) == "NVQT"){
                    $id=1;
                }
                else if(substr($manv, 0, 4) == "NVKT"){
                    $id=2;
                }
                else if(substr($manv, 0, 4) == "NVBH"){
                    $id=3;
                }
                else if(substr($manv, 0, 4) == "NVTK"){
                    $id=4;

                }

                if($id != 0){
                    $ma= nguoidungBUS::TaoMaNN($id);
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $now= date("Y-m-d H:i:s");
                    $hash="YANGGUI1997"; //key
                    $mahoa= CommonComand::Encrypt($mk, $hash); //mã hoá mk
                    $nd= new nguoidung($ma,$manv,$tentk, $mahoa, $now, $now, 1, $id);
                    $kq=nguoidungBUS::ThemND($nd);
                    if($kq === TRUE){
                        $_SESSION["tennd"]=$tentk;
                        $_SESSION["mand"]=$ma;

                       echo "tc|".$ma;
                    }
                    else{
                        echo "tb |";
                    }
                }
                else{
                    echo "tb |";
                }

            }
            else{
                echo "loi |";
            }
        }
        else if($hd == "kttentk"){
            if($tentk != NULL){   
                $nd=nguoidungBUS::getNDtheoTenTK($tentk);
                if($nd == NULL){
                    echo "tc";
                }
                else{
                   echo "tb";
                }
            }
        }
        else if($hd == "ktmanv"){
            if($manv != NULL){   
                $nv=nhanvienBUS::getNV($manv);
                if($nv != NULL){
                    if($nv->getIdNV() != NULL){
                        echo "tc";
                       
                    }
                     else {
                         echo "tb";
                     }
                }
                else{
                    echo "null";
                }
            }
            else{
                echo "loi";
            }
        }
        else if($hd == "ktmkcu"){

            if($mand != NULL && $mkcu != NULL){
                $hash="YANGGUI1997";
                $mahoa= CommonComand::Encrypt($mkcu, $hash); //mã hoá mk
                $kq=nguoidungBUS::KTMK($mand, $mahoa);
//                echo $kq;
                if($kq === TRUE){//giải mã mk trước
                    echo "tc";
                }
                else{
                    echo "tb";
                }
            }
            else{
                echo "tb";
            }       
        }
        else if($hd=="doimk"){

            if($mand != NULL && $mkmoi != NULL){
                $hash="YANGGUI1997";
                $mahoa= CommonComand::Encrypt($mkmoi, $hash); //mã hoá mk
                $kq=nguoidungBUS::CapnhatMK($mand, $mahoa);
                if($kq === TRUE){
                    echo "tc";
                }
                else{
                    echo "tb";
                }
            }
            else{
                echo "tb";
            }

        }
        else if($hd == "dangxuat"){
            if($mand != NULL){
                $kq=nguoidungBUS::CapnhatKhoaTK($mand, 2);
                if($kq === TRUE){
                    // resets the session data for the rest of the runtime
                    $_SESSION = array();
                    // sends as Set-Cookie to invalidate the session cookie
                    if (isset($_COOKIE[session_name()])) { 
                        $params = session_get_cookie_params();
                        setcookie(session_name(), '', 1, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
                    }
                    session_destroy();
                    echo "tc";
                }
                else{
                    echo "tb";
                }
            }
            else{
                echo "tb";
            }
        }
    }
}


    
    



