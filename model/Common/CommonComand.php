<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class CommonComand{
    private function __construct(){} 
    
    private static $username = "root";
    private static $password = "root";
    private static $options = array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION);
    private static $dns = "mysql:host=localhost;dbname=vtnn;port=3306;charset=utf8";
    private static $dbcon;

    public static function taoketnoi(){
        if(!isset(self::$dbcon)){
            try{
                self::$dbcon = new PDO(self::$dns, 
                                    self::$username, 
                                    self::$password, 
                                    self::$options);
                
            }
            catch(PDOException $e){
                $error_message = $e->getMessage();
                return $error_message;
            }
        }
        return self::$dbcon;
    }
    
    public static function dongketnoi(){
        self::$dbcon = null;
    }
    
//    public static function getConnection(){
//        $servername = "localhost";
//        $username = "root";
//        $password = "root";
//
//        try {
//            $conn = new PDO("mysql:host=$servername;dbname=vtnn", $username, $password);
//            // set the PDO error mode to exception
//            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "Connected successfully"; 
//            }
//        catch(PDOException $e)
//        {
//            echo "Connection failed: " . $e->getMessage();
//        }
//    }
    
    //định dạng ngày giờ lưu trong csdl
    public static function endateformat($str){
        
        $y=substr($str,6, 4);
        $m=substr($str,3, 2);
        $d=substr($str,0, 2);
        $h=substr($str,11, 2);
        $mn=substr($str,14, 2);
        $s=substr($str,17, 2);
        
        $kq=$y."-".$m."-".$d." ".$h.":".$mn.":".$s;       

        return $kq;
    }
    
    //định dạng ngày giờ hiển thị lên web
    public static function dedateformat ($str){
        $y=substr($str,0, 4);
        $m=substr($str,5, 2);
        $d=substr($str,8, 2);
        $h=substr($str,11, 2);
        $mn=substr($str,14, 2);
        $s=substr($str,17, 2);
        $hh= intval($h);
        if($hh>12){
            $hh = $hh - intval(12);
            $apm="PM";
        }
        else{
            $apm="AM";
        }
        $kq=$d."/".$m."/".$y." ".$hh.":".$mn.":".$s." ".$apm;
        return $kq;
    }
    
    //định dạng ngày giờ hiển thị lên form cập nhật
    public static function deDateFormatForUpdate ($str){
        
        $y=substr($str,0, 4);
        $m=substr($str,5, 2);
        $d=substr($str,8, 2);
        $h=substr($str,11, 2);
        $mn=substr($str,14, 2);
        $s=substr($str,17, 2);
        
        $kq=$d."/".$m."/".$y." ".$h.":".$mn.":".$s;
        return $kq;
    }
    
    //Mã hoá mật khẩu
//    public static function encrypt($data, $secret){
//        //Generate a key from a hash
//        $key = md5(utf8_encode($secret), true);
//
//         //Take first 8 bytes of $key and append them to the end of $key.
//        $key .= substr($key, 0, 8);
//        //Pad for PKCS7
//        $blockSize = mcrypt_get_block_size('tripledes', 'ecb');
//        $len = strlen($data);
//        $pad = $blockSize - ($len % $blockSize);
//        $data .= str_repeat(chr($pad), $pad);
//
//        //Encrypt data
//        $encData = mcrypt_encrypt('tripledes', $key, $data, 'ecb');
//
//        return base64_encode($encData);
//    }
//    
//    public static function decrypt($data, $secret){
//        //Generate a key from a hash
//        $key = md5(utf8_encode($secret), true);
//
//        //Take first 8 bytes of $key and append them to the end of $key.
//        $key .= substr($key, 0, 8);
//
//        $data = base64_decode($data);
//
//        $data = mcrypt_decrypt('tripledes', $key, $data, 'ecb');
//
//        $block = mcrypt_get_block_size('tripledes', 'ecb');
//        $len = strlen($data);
//        $pad = ord($data[$len-1]);
//
//        return substr($data, 0, strlen($data) - $pad);
//    }
    
   
    /**
     * @param $data
     * @return string
     */
    public static function Encrypt($data, $hash){
        $key = md5($hash,TRUE);
        $key .= substr($key,0,8);
        $encData = openssl_encrypt($data, 'DES-EDE3', $key, OPENSSL_RAW_DATA);

        $encData = base64_encode($encData);

        return $encData;
    }

    /**
     * @param $data
     * @return string
     */
    public static function Decrypt($data, $hash){
        $key = md5($hash,TRUE);
        $key .= substr($key,0,8);
        
        $data = base64_decode($data);

        $decData = openssl_decrypt($data, 'DES-EDE3', $key, OPENSSL_RAW_DATA);

        return $decData;
    }
}

