
<?php
    require '../../model/Common/CommonComand.php';
    //dto
    require '../../model/dto/khachhang.php';
    require '../../model/dto/hoadonban.php';
    require '../../model/dto/hoadonbanct.php';
    //dao
    require '../../model/dao/khachhangDAO.php';
    require '../../model/dao/hoadonbanDAO.php';
    require '../../model/dao/hoadonbanCTDAO.php';
    //bus
    require '../../model/bus/khachhangBUS.php';
    require '../../model/bus/hoadonbanBUS.php';
    require '../../model/bus/hoadonbanCTBUS.php';
    
?>

<?php   
    //Kiểm tra khách hàng có tồn tại không
    if(isset($_REQUEST["mkh"])){
        $mkh=$_REQUEST["mkh"];
        $kh=khachhangBUS::getKH($mkh);
        if($kh->getSoCMND() != NULL){
            echo "tc";
        }
        else{
            echo "tb";
        }
    }
    
    if(isset($_REQUEST["idkh"])){
        $idkh=$_REQUEST["idkh"];
        $kh=khachhangBUS::getKH($idkh);
        if($kh != NULL){
            if($kh->getSoCMND() != NULL){
                echo $kh->getTenKH()."|". CommonComand::deDateFormatForUpdate($kh->getNgaySinh())."|".$kh->getGioiTinh()."|".$kh->getSoCMND()."|".$kh->getSDT()."|".$kh->getEmail()."|".$kh->getDiaChi()."|".$kh->getLoaiKH()."|".$kh->getDanhGia();
            }
            
        }
    }
   
    //lấy thông tin khách hàng
    $tt=NULL;
    if(isset($_REQUEST["tt"])){
        $tt=$_REQUEST["tt"];
    }
    $hts=NULL;
    if(isset($_REQUEST["hts"])){
        $hts=$_REQUEST["hts"];
    }
    
    $makh=NULL;
    if(isset($_REQUEST["makh"])){
        $makh=$_REQUEST["makh"];
    }
    
    $macu=NULL;
    if(isset($_REQUEST["scmcu"])){
        $macu=$_REQUEST["scmcu"];
    }
    
    $tenkh=NULL;
    if(isset($_REQUEST["tenkh"])){
        $tenkh=$_REQUEST["tenkh"];
    }
    
    $ngaysinh=NULL;
    if(isset($_REQUEST["ngaysinh"])){
        $ngaysinh=$_REQUEST["ngaysinh"];
    }
    
    $gioitinh=NULL;
    if(isset($_REQUEST["gioitinh"])){
        $gioitinh=$_REQUEST["gioitinh"];
    }
    
    $sdt=NULL;
    if(isset($_REQUEST["sdt"])){
        $sdt=$_REQUEST["sdt"];
    }
    
    $diachi=NULL;
    if(isset($_REQUEST["diachi"])){
        $diachi=$_REQUEST["diachi"];
    }
    
    $loaikh=NULL;
    if(isset($_REQUEST["loaikh"])){
        $loaikh=$_REQUEST["loaikh"];
    }
    
    $email=NULL;
    if(isset($_REQUEST["email"])){
        $email=$_REQUEST["email"];
    }
    
    $danhgia=NULL;
    if(isset($_REQUEST["danhgia"])){
        $danhgia=$_REQUEST["danhgia"];
    }
    
    if($tt != NULL){
        if($tt=="them"){//them
            if($makh != NULL && $tenkh != NULL && $ngaysinh !=NULL && $gioitinh !=NULL && $sdt !=NULL && $diachi !=NULL && $loaikh !=NULL){
                $ngaysinh= CommonComand::endateformat($ngaysinh);
                $kh=new khachhang($tenkh, $ngaysinh, $gioitinh, $makh, $sdt, $email, $diachi, $loaikh, $danhgia);
                $kq=khachhangBUS::ThemKH($kh);
                if($kq === TRUE){
                    echo "tc";
                }
                else{
                    echo "tb";
                }
            }
        }
        else if($tt=="sua" && $hts=="scmcu"){ //sửa
            if($makh != NULL && $tenkh != NULL && $ngaysinh !=NULL && $gioitinh !=NULL && $sdt !=NULL && $diachi !=NULL && $loaikh !=NULL){
                $ngaysinh= CommonComand::endateformat($ngaysinh);
                $kh=new khachhang($tenkh, $ngaysinh, $gioitinh, $makh, $sdt, $email, $diachi, $loaikh, $danhgia);
                $kq=khachhangBUS::CapnhatKH($kh);
                if($kq === TRUE){
                    echo "tc";
                }
                else{
                    echo "tb";
                }
            }
        }
        else if($tt=="sua" && $hts=="doiscm" && $macu!=NULL){ //sửa
            if($makh != NULL && $tenkh != NULL && $ngaysinh !=NULL && $gioitinh !=NULL && $sdt !=NULL && $diachi !=NULL && $loaikh !=NULL){
                $ngaysinh= CommonComand::endateformat($ngaysinh);
                $kh=new khachhang($tenkh, $ngaysinh, $gioitinh, $makh, $sdt, $email, $diachi, $loaikh, $danhgia);
                $kq=khachhangBUS::ThemKH($kh);
                if($kq=== TRUE){
                    $dshdb=hoadonbanBUS::getHDBtheoIdKH($macu);
                    if(is_array($dshdb)){
                        foreach ($dshdb as $hdb) {
                            $mahdb=$hdb->getIdHDB();
                            $cnkh=hoadonbanBUS::CapnhatIdKH($mahdb, $makh);
                            $xoakh=khachhangBUS::XoaKH($macu);
                            if($cnkh === TRUE && $xoakh === TRUE){
                                echo 'tc';
                            }
                            else{
                                echo 'tb';
                            }
                        }
                    }
                    else{
                        if( $dshdb != NULL){
                            echo 'tb';
                        }
                        else{
                            $xoakh=khachhangBUS::XoaKH($macu);
                            if($xoakh === TRUE){
                                echo 'tc';
                            }
                            else{
                                echo 'tb';
                            }
                        }
                    }
                    
                }
                else{
                    echo 'tb';
                }
            }
        }
        else if($tt == "xoa"){ //xoá
            if($makh != NULL){
                $dshdb=hoadonbanBUS::getHDBtheoIdKH($makh);
                if(is_array($dshdb)){
                    foreach ($dshdb as $hdb) {
                        $mahdb=$hdb->getIdHDB();
                        $xoahdbct=hoadonbanCTBUS::XoaHDBCTtheoIdHDB($mahdb);
                        $xoahdb=hoadonbanBUS::XoaHDBtheoIdKH($makh);
                        $xoakh=khachhangBUS::XoaKH($makh);
                        if($xoahdbct === TRUE && $xoahdb === TRUE && $xoakh === TRUE){
                           echo "tc";
                        }
                        else{
                            echo "tb";
                        }
                    }
                }
                else{
                    if( $dshdb != NULL){
                        echo 'tb';
                    }
                    else{
                        $xoakh=khachhangBUS::XoaKH($makh);
                        if($xoakh === TRUE){
                            echo "tc";
                        }
                        else{
                            echo "tb";
                        }
                    }
                    
                }
            }
            else{
                echo 'tb';
            }
            
        }
    }
