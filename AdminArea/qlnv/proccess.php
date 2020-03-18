
<?php
    require '../../model/Common/CommonComand.php';
    //dto
    require '../../model/dto/hangton.php';
    require '../../model/dto/hangtonct.php';
    require '../../model/dto/hoadonban.php';
    require '../../model/dto/hoadonbanct.php';
    require '../../model/dto/nguoidung.php';
    require '../../model/dto/nhanvien.php';
    require '../../model/dto/sanphamban.php';
    require '../../model/dto/sanphambanct.php';
    
    //dao
    require '../../model/dao/hangtonDAO.php';
    require '../../model/dao/hangtonCTDAO.php';
    require '../../model/dao/hoadonbanDAO.php';
    require '../../model/dao/hoadonbanCTDAO.php';
    require '../../model/dao/nguoidungDAO.php';
    require '../../model/dao/nhanvienDAO.php';
    require '../../model/dao/sanphambanDAO.php';
    require '../../model/dao/sanphambanCTDAO.php';
    
    //bus
    
    require '../../model/bus/hangtonBUS.php';
    require '../../model/bus/hangtonCTBUS.php';
    require '../../model/bus/hoadonbanBUS.php';
    require '../../model/bus/hoadonbanCTBUS.php';
    require '../../model/bus/nguoidungBUS.php';
    require '../../model/bus/nhanvienBUS.php';
    require '../../model/bus/sanphambanBUS.php';
    require '../../model/bus/sanphambanCTBUS.php';
    
?>



<?php   //xử lý tạo mã ngẫu nhiên
    if(isset($_REQUEST["id"])){
        $s=$_REQUEST["id"];
        $ma=nhanvienBUS::TaoMaNN($s);
        echo $ma;
    }
    
    
    //Kiểm tra nhân viên có tồn tại không
    if(isset($_REQUEST["mnv"])){
        $mnv=$_REQUEST["mnv"];
        $nv=nhanvienBUS::getNV($mnv);
        if($nv != NULL){
            if($nv->getIdNV() != NULL){
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
    
    if(isset($_REQUEST["idnv"])){
        $idnv=$_REQUEST["idnv"];
        if($idnv != NULL){
            $nv=nhanvienBUS::getNV($idnv);
            if($nv != NULL){
                if($nv->getIdNV() != NULL){
                    $ngaysinh=$nv->getNgaySinh();
                    $ngayvaolam=$nv->getNgayVaoLam();
                    echo $nv->getIdNV()."|".$nv->getTenNV()."|".CommonComand::deDateFormatForUpdate($ngaysinh)."|".$nv->getGioiTinh()."|".$nv->getSoCMND()."|".$nv->getSDT()."|".$nv->getDiaChi()."|".$nv->getChucVu()."|".CommonComand::deDateFormatForUpdate($ngayvaolam);
                }
                
            }
        }
    }
    
    //lấy thông tin nhân viên
    $tt=NULL;
    if(isset($_REQUEST["tt"])){
        $tt=$_REQUEST["tt"];
    }
    $hts=NULL;
    if(isset($_REQUEST["hts"])){
        $hts=$_REQUEST["hts"];
    }
    $macu=NULL;
    if(isset($_REQUEST["macu"])){
        $macu=$_REQUEST["macu"];
    }
    $manv=NULL;
    if(isset($_REQUEST["manv"])){
        $manv=$_REQUEST["manv"];
    }
    $tennv=NULL;
    if(isset($_REQUEST["tennv"])){
        $tennv=$_REQUEST["tennv"];
    }
    $ngaysinh=NULL;
    if(isset($_REQUEST["ngaysinh"])){
        $ngaysinh=$_REQUEST["ngaysinh"];
    }
    $gioitinh=NULL;
    if(isset($_REQUEST["gioitinh"])){
        $gioitinh=$_REQUEST["gioitinh"];
    }
    $socmnd=NULL;
    if(isset($_REQUEST["socmnd"])){
        $socmnd=$_REQUEST["socmnd"];
    }
    $sdt=NULL;
    if(isset($_REQUEST["sdt"])){
        $sdt=$_REQUEST["sdt"];
    }
    $diachi=NULL;
    if(isset($_REQUEST["diachi"])){
        $diachi=$_REQUEST["diachi"];
    }
    $chucvu=NULL;
    if(isset($_REQUEST["chucvu"])){
        $chucvu=$_REQUEST["chucvu"];
    }
    $nvl=NULL;
    if(isset($_REQUEST["nvl"])){
        $nvl=$_REQUEST["nvl"];
    }

    if($tt != NULL){
        if($tt=="them"){//them
            if($manv != NULL && $tennv != NULL && $ngaysinh !=NULL && $gioitinh !=NULL && $socmnd != NULL && $sdt !=NULL && $diachi !=NULL && $chucvu !=NULL && $nvl !=NULL){
                $ngaysinh= CommonComand::endateformat($ngaysinh);
                $nvl= CommonComand::endateformat($nvl);
                $nv=new nhanvien($manv, $tennv, $ngaysinh , $gioitinh, $socmnd, $sdt, $diachi, $chucvu, $nvl);
                $kq=nhanvienBUS::ThemNV($nv);
                if($kq === TRUE){
                    echo "tc";
                }
                else{
                    echo "tb";
                }
            }
        }
        else if($tt == "sua" && $hts == "macu"){ //sửa
            if($manv != NULL && $tennv != NULL && $ngaysinh !=NULL && $gioitinh !=NULL && $socmnd != NULL && $sdt !=NULL && $diachi !=NULL && $chucvu !=NULL && $nvl !=NULL){
                $ngaysinh= CommonComand::endateformat($ngaysinh);
                $nvl= CommonComand::endateformat($nvl);
                $nv=new nhanvien($manv, $tennv, $ngaysinh , $gioitinh, $socmnd, $sdt, $diachi, $chucvu, $nvl);
                $kq=nhanvienBUS::CapnhatNV($nv);
                if($kq === TRUE){
                    echo "tc";
                }
                else{
                    echo "tb";
                }
            }
        }
        else if($tt == "sua" && $hts == "doima" && $macu!=NULL){ //sửa
            if($manv != NULL && $tennv != NULL && $ngaysinh !=NULL && $gioitinh !=NULL && $socmnd != NULL && $sdt !=NULL && $diachi !=NULL && $chucvu !=NULL && $nvl !=NULL){
                $ngaysinh= CommonComand::endateformat($ngaysinh);
                $nvl= CommonComand::endateformat($nvl);
                $nv=new nhanvien($manv, $tennv, $ngaysinh , $gioitinh, $socmnd, $sdt, $diachi, $chucvu, $nvl);
                
                $kq=nhanvienBUS::ThemNV($nv);
                if($kq === TRUE){
                    $flag=TRUE;
                    $dshdb=hoadonbanBUS::getDSHDB();
                    if(is_array($dshdb)){
                        foreach ($dshdb as $value) {
                            if($value !=NULL){
                                if($value->getIdHDB() != NULL){
                                    $m=$value->getIdHDB();
                                    $mnhanvien=$value->getIdNV();
                                    if($mnhanvien == $macu){
                                        $cnhdb=hoadonbanBUS::CapnhatIdNV($m, $manv);
                                        if($cnhdb !== TRUE){
                                            $flag=FALSE;
                                            goto label1;
                                        }
                                    }

                                }
                                else{
                                    $flag=FALSE;
                                    goto label1;
                                }
                            }

                        }
                    }
                    else{
                        if($dshdb != NULL){
                            $flag=FALSE;
                            goto label1;
                        }
                    }

                    $dsht= hangtonBUS::getDSHT();
                    if(is_array($dsht)){
                        foreach ($dsht as $value) {
                            if($value !=NULL){
                                if($value->getIdHT() != NULL){
                                    $m=$value->getIdHT();
                                    $mnhanvien=$value->getIdNV();
                                    if($mnhanvien == $macu){
                                        $cnht=hangtonBUS::CapnhatIdNV($m, $manv);
                                        if($cnht !== TRUE){
                                            $flag=FALSE;
                                            goto label1;
                                        }
                                    }

                                }
                                else{
                                    $flag=FALSE;
                                    goto label1;
                                }
                            }

                        }
                    }
                    else{
                        if($dsht != NULL){
                            $flag=FALSE;
                            goto label1;
                        }
                    }
                    $dsspb= sanphambanBUS::getDSSPB();
                    if(is_array($dsspb)){
                        foreach ($dsspb as $value) {
                            if($value !=NULL){
                                if($value->getIdSPB() != NULL){
                                    $m=$value->getIdSPB();
                                    $mnhanvien=$value->getIdNV();
                                    if($mnhanvien == $macu){
                                        $cnspb=sanphambanBUS::CapnhatIdNV($m, $manv);
                                        if($cnspb !== TRUE){
                                            $flag=FALSE;
                                            goto label1;
                                        }
                                    }

                                }
                                else{
                                    $flag=FALSE;
                                    goto label1;
                                }
                            }

                        }
                    }
                    else{
                        if($dsspb!= NULL){
                            $flag=FALSE;
                            goto label1;
                        }
                    }
                    
                    $dsnd= nguoidungBUS::getDSND();
                    if(is_array($dsnd)){
                        foreach ($dsnd as $value) {
                            if($value !=NULL){
                                if($value->getIdND() != NULL){
                                    $m=$value->getIdND();
                                    $mnhanvien=$value->getIdNV();
                                    if($mnhanvien == $macu){
                                        
                                        $cnnd=nguoidungBUS::CapnhatIdNV($m, $manv);
                                        
                                        if($cnnd !== TRUE){
                                            $flag=FALSE;
                                            goto label1;
                                        }
                                        else{
                                            $cnnd1=nguoidungBUS::CapnhatIdND($mandmoi, $manv);
                                            if($cnnd1 !== TRUE){
                                                $flag=FALSE;
                                                goto label1;
                                            }
                                        }
                                    }

                                }
                                else{
                                    $flag=FALSE;
                                    goto label1;
                                }
                            }

                        }
                    }
                    else{
                        if($dsnd!= NULL){
                            $flag=FALSE;
                            goto label1;
                        }
                    }
                    
                    $dsnd= nguoidungBUS::getDSND();
                    if(is_array($dsnd)){
                        foreach ($dsnd as $value) {
                            if($value !=NULL){
                                if($value->getIdND() != NULL){
                                    $m=$value->getIdND();
                                    $mnhanvien=$value->getIdNV();
                                    if($mnhanvien == $manv){
                                        $mandmoi="";
                                        if(substr($manv, 0, 4) == "NVQT"){
                                            $mandmoi=nguoidungBUS::TaoMaNN(1);
                                        }
                                        else if(substr($manv, 0, 4) == "NVKT"){
                                            $mandmoi=nguoidungBUS::TaoMaNN(2);
                                        }
                                        else if(substr($manv, 0, 4) == "NVBH"){
                                            $mandmoi=nguoidungBUS::TaoMaNN(3);
                                        }
                                        else if(substr($manv, 0, 4) == "NVTK"){
                                            $mandmoi=nguoidungBUS::TaoMaNN(4);
                                        }
                                        $cnnd1=nguoidungBUS::CapnhatIdND($mandmoi, $m);
                                        if($cnnd1 !== TRUE){
                                            $flag=FALSE;
                                            goto label1;
                                        }
                                    }

                                }
                                else{
                                    $flag=FALSE;
                                    goto label1;
                                }
                            }
                        }
                    }
                    
                    $xoanv= nhanvienBUS::XoaNV($macu);
                    if($xoanv !== TRUE){
                        $flag=FALSE;
                    }
                    label1:
                        if($flag === FALSE){
                            echo 'tb';
                        }
                        else{
                            echo 'tc';
                        }
                }
                else{
                    echo "tb";
                }
            }
        }
        else if($tt == "xoa"){ //xoá
            if($manv != NULL){
                $dsnd= nguoidungBUS::getNDTheoIdNV($manv);
                if(is_array($dsnd)){
                    $flag=TRUE;
                    foreach ($dsnd as $nd) {
                        if($nd != NULL){
                            if($nd->getTrangThai() != NULL){
                                $trangthai=$nd->getTrangThai();
                                if(intval($trangthai) == 1){
                                    $flag=FALSE;
                                    break;
                                }
                            }
                        }
                    }
                    if($flag === TRUE){
                        $flag=TRUE;
                        $dshdb=hoadonbanBUS::getDSHDB();
                        if(is_array($dshdb)){
                            foreach ($dshdb as $value) {
                                if($value !=NULL){
                                    if($value->getIdHDB() != NULL){
                                        $m=$value->getIdHDB();
                                        $mnhanvien=$value->getIdNV();
                                        if($mnhanvien == $manv){
                                            $xoahdbct= hoadonbanCTBUS::XoaHDBCTtheoIdHDB($m);
                                            $xoahdb= hoadonbanBUS::XoaHDB($m);
                                            if($xoahdbct !== TRUE && $xoahdb !== TRUE){
                                                $flag=FALSE;
                                                goto label;
                                            }
                                        }

                                    }
                                    else{
                                        $flag=FALSE;
                                        goto label;
                                    }
                                }

                            }
                        }
                        else{
                            if($dshdb != NULL){
                                $flag=FALSE;
                                goto label;
                            }
                        }

                        $dsht= hangtonBUS::getDSHT();
                        if(is_array($dsht)){
                            foreach ($dsht as $value) {
                                if($value !=NULL){
                                    if($value->getIdHT() != NULL){
                                        $m=$value->getIdHT();
                                        $mnhanvien=$value->getIdNV();
                                        if($mnhanvien == $manv){
                                            $xoahtct= hangtonCTBUS::XoaHTCTtheoIdHT($m);
                                            $xoaht= hangtonBUS::XoaHT($m);
                                            if($xoahtct !== TRUE && $xoaht !== TRUE){
                                                $flag=FALSE;
                                                goto label;
                                            }
                                        }

                                    }
                                    else{
                                        $flag=FALSE;
                                        goto label;
                                    }
                                }

                            }
                        }
                        else{
                            if($dsht != NULL){
                                $flag=FALSE;
                                goto label;
                            }
                        }

                        $dsspb= sanphambanBUS::getDSSPB();
                        if(is_array($dsspb)){
                            foreach ($dsspb as $value) {
                                if($value !=NULL){
                                    if($value->getIdSPB() != NULL){
                                        $m=$value->getIdSPB();
                                        $mnhanvien=$value->getIdNV();
                                        if($mnhanvien == $manv){
                                            $xoaspbct= sanphambanCTBUS::XoaSPBCTtheoIdSPB($m);
                                            $xoaspb= sanphambanBUS::XoaSPB($m);
                                            if($xoaspbct !== TRUE && $xoaspb !== TRUE){
                                                $flag=FALSE;
                                                goto label;
                                            }
                                        }

                                    }
                                    else{
                                        $flag=FALSE;
                                        goto label;
                                    }
                                }

                            }
                        }
                        else{

                            if($dsspb != NULL){
                                $flag=FALSE; //loi sql
                                goto label;
                            }
                        }


                        $xoand=nguoidungBUS::XoaNDtheoIdNV($manv);
                        if($xoand !== TRUE){
                            $flag=FALSE;
                            goto label;
                        }            

                        $xoanv=nhanvienBUS::XoaNV($manv);
                        if($xoanv !== TRUE){
                            $flag=FALSE;
                            goto label;
                        }
                        label:
                        if($flag == TRUE){
                            echo "tc";
                        }
                        else{
                            echo "tb";
                        }
                    }
                    else{
                        echo "danglv";
                    }
                }
                else{
                    if($dsnd != NULL){
                        echo 'tb';
                    }
                    else{
                        $flag=TRUE;
                        $dshdb=hoadonbanBUS::getDSHDB();
                        if(is_array($dshdb)){
                            foreach ($dshdb as $value) {
                                if($value !=NULL){
                                    if($value->getIdHDB() != NULL){
                                        $m=$value->getIdHDB();
                                        $mnhanvien=$value->getIdNV();
                                        if($mnhanvien == $manv){
                                            $xoahdbct= hoadonbanCTBUS::XoaHDBCTtheoIdHDB($m);
                                            $xoahdb= hoadonbanBUS::XoaHDB($m);
                                            if($xoahdbct !== TRUE && $xoahdb !== TRUE){
                                                $flag=FALSE;
                                                goto label2;
                                            }
                                        }

                                    }
                                    else{
                                        $flag=FALSE;
                                        goto label2;
                                    }
                                }

                            }
                        }
                        else{
                            if($dshdb != NULL){
                                $flag=FALSE;
                                goto label2;
                            }
                        }

                        $dsht= hangtonBUS::getDSHT();
                        if(is_array($dsht)){
                            foreach ($dsht as $value) {
                                if($value !=NULL){
                                    if($value->getIdHT() != NULL){
                                        $m=$value->getIdHT();
                                        $mnhanvien=$value->getIdNV();
                                        if($mnhanvien == $manv){
                                            $xoahtct= hangtonCTBUS::XoaHTCTtheoIdHT($m);
                                            $xoaht= hangtonBUS::XoaHT($m);
                                            if($xoahtct !== TRUE && $xoaht !== TRUE){
                                                $flag=FALSE;
                                                goto label2;
                                            }
                                        }

                                    }
                                    else{
                                        $flag=FALSE;
                                        goto label2;
                                    }
                                }

                            }
                        }
                        else{
                            if($dsht != NULL){
                                $flag=FALSE;
                                goto label2;
                            }
                        }

                        $dsspb= sanphambanBUS::getDSSPB();
                        if(is_array($dsspb)){
                            foreach ($dsspb as $value) {
                                if($value !=NULL){
                                    if($value->getIdSPB() != NULL){
                                        $m=$value->getIdSPB();
                                        $mnhanvien=$value->getIdNV();
                                        if($mnhanvien == $manv){
                                            $xoaspbct= sanphambanCTBUS::XoaSPBCTtheoIdSPB($m);
                                            $xoaspb= sanphambanBUS::XoaSPB($m);
                                            if($xoaspbct !== TRUE && $xoaspb !== TRUE){
                                                $flag=FALSE;
                                                goto label2;
                                            }
                                        }

                                    }
                                    else{
                                        $flag=FALSE;
                                        goto label2;
                                    }
                                }

                            }
                        }
                        else{

                            if($dsspb != NULL){
                                $flag=FALSE; //loi sql
                                goto label2;
                            }
                        }
                        
                        $xoanv=nhanvienBUS::XoaNV($manv);
                        if($xoanv !== TRUE){
                            $flag=FALSE;
                            goto label2;
                        }
                        
                        label2:
                            if($flag === TRUE){
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
    

    
    