
<?php
    require '../../model/Common/CommonComand.php';
    //dto
    require '../../model/dto/sanphambanct.php';
    require '../../model/dto/hoadonbanct.php';
    require '../../model/dto/hangtonct.php';
    require '../../model/dto/sanpham.php';
    require '../../model/dto/nhacungung.php';
    
    //dao
    require '../../model/dao/sanphambanCTDAO.php';
    require '../../model/dao/hoadonbanCTDAO.php';
    require '../../model/dao/hangtonCTDAO.php';
    require '../../model/dao/sanphamDAO.php';
    require '../../model/dao/nhacungungDAO.php';
    
    //bus
    require '../../model/bus/sanphambanCTBUS.php';
    require '../../model/bus/hangtonCTBUS.php';
    require '../../model/bus/hoadonbanCTBUS.php';
    require '../../model/bus/samphamBUS.php';
    require '../../model/bus/nhacungungBUS.php';
?>

<?php   
    //Kiểm tra ncu có tồn tại không
    if(isset($_REQUEST["mncu"])){
        $mncu=$_REQUEST["mncu"];
        if($mncu!=NULL){
            $ncu=nhacungungBUS::getNCU($mncu);
            if($ncu != NULL){
                if($ncu->getIdNCU()){
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
    
    
    if(isset($_REQUEST["idncu"])){
        $idncu=$_REQUEST["idncu"];
        if($idncu != NULL){
            $ncu=nhacungungBUS::getNCU($idncu);
            if($ncu != NULL){
                if($ncu->getIdNCU() != NULL){
                    echo $ncu->getTenNCU()."|".$ncu->getDiaChi()."|".$ncu->getSDT()."|".$ncu->getEmail()."|".$ncu->getQuyMo()."|".$ncu->getDanhGia();
                }
                
            }
        }
    }
    
    

    //lấy thông tin ncu
    $tt=NULL;
    if(isset($_REQUEST["tt"])){
        $tt=$_REQUEST["tt"];
    }
    
    $mancu=NULL;
    if(isset($_REQUEST["mancu"])){
        $mancu=$_REQUEST["mancu"];
    }
    
    $tenncu=NULL;
    if(isset($_REQUEST["tenncu"])){
        $tenncu=$_REQUEST["tenncu"];
    }
    
    $quymo=NULL;
    if(isset($_REQUEST["quymo"])){
        $quymo=$_REQUEST["quymo"];
    }
    
    $sdt=NULL;
    if(isset($_REQUEST["sdt"])){
        $sdt=$_REQUEST["sdt"];
    }
    
    $diachi=NULL;
    if(isset($_REQUEST["diachi"])){
        $diachi=$_REQUEST["diachi"];
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
            if($tenncu != NULL && $diachi !=NULL && $email !=NULL && $sdt !=NULL && $quymo !=NULL){
                
                $ma=nhacungungBUS::TaoMaNN();
                
                $ncu=new nhacungung($ma, $tenncu, $diachi, $sdt, $email, $quymo, $danhgia);
                $kq=nhacungungBUS::ThemNCU($ncu);
                if($kq===TRUE){
                    echo 'tc';
                }
                else{
                    echo 'tb';
                }
            }
        }
        else if($tt=="sua"){ //sửa
            if($mancu != NULL && $tenncu != NULL && $diachi !=NULL && $email !=NULL && $sdt !=NULL && $quymo !=NULL){
                $ncu=new nhacungung($mancu, $tenncu, $diachi, $sdt, $email, $quymo, $danhgia);
                $kq=nhacungungBUS::CapnhatNCU($ncu);
                if($kq===TRUE){
                     echo 'tc';
                }
                else{
                    echo 'tb';
                }
            }
        }
        else if($tt=="xoa"){ //xoá
            if($mancu != NULL){
                $dssp= samphamBUS::getSPtheoIdNCU($mancu);
                if(is_array($dssp)){
                    $flag=TRUE;
                    foreach ($dssp as $value) {
                        if($value != NULL){
                            if($value->getIdSP() != NULL){
                                $maspham=$value->getIdSP();
                                $xoahtct=hangtonCTBUS::XoaHTCTtheoIdSP($maspham);
                                $xoahdbct=hoadonbanCTBUS::XoaHDBCTtheoIdSP($maspham);
                                $xoaspbct=sanphambanCTBUS::XoaSPBCTtheoIdSP($maspham);
                                if($xoahdbct !== TRUE || $xoahtct !== TRUE || $xoaspbct !== TRUE){
                                    $flag = FALSE;
                                    break;
                                }
                            }
                            else{
                                $flag = FALSE;
                                break;
                            }
                        }
                        else{
                            $flag = FALSE;
                            break;
                        }
                    }
                    $xoasp= samphamBUS::XoaSPtheoIdNCU($mancu);
                    $xoancu=nhacungungBUS::XoaNCU($mancu);
                    if($xoancu === TRUE && $xoasp === TRUE && $flag === TRUE){
                        echo 'tc';
                    }
                    else{
                        echo 'tb';
                    }
                    
                }
                else{
                    if($dssp == NULL){
                        $xoancu=nhacungungBUS::XoaNCU($mancu);
                        if($xoancu === TRUE){
                            echo 'tc';
                        }
                        else{
                            echo 'tb';
                        }
                    }
                    else{
                        echo "tb";
                    }
                }
            }
            else
            {
                echo 'tb';
            }
        }
    }
