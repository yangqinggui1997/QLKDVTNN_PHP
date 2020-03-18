
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
    //Kiểm tra sp có tồn tại không
    if(isset($_REQUEST["msp"])){
        $msp=$_REQUEST["msp"];
        $sp= samphamBUS::getSP($msp);
        if($sp != NULL){
            if($sp->getIdSP() != NULL){
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
   
    if(isset($_REQUEST["idsp"])){
        $idsp=$_REQUEST["idsp"];
        $sp= samphamBUS::getSP($idsp);
        if($sp != NULL){
            if($sp->getIdNCU() != NULL){
                $ngaysx=$sp->getNgaySX();
                $ngayhh=$sp->getNgayHH();
                $ngaynhap=$sp->getNgayNhap();
                
                echo $sp->getIdNCU()."|".$sp->getTenSP()."|".CommonComand::deDateFormatForUpdate($ngaysx)."|".CommonComand::deDateFormatForUpdate($ngayhh)."|".$sp->getNhaSX()."|".CommonComand::deDateFormatForUpdate($ngaynhap)."|".$sp->getSLNhap()."|".$sp->getDonGiaNhap()."|".$sp->getDonGiaTienMat()."|".$sp->getDonGiaThanhToanSau()."|".$sp->getGiamGia();
            }
        }
    }

    //lấy thông tin sp
    $tt=NULL;
    if(isset($_REQUEST["tt"])){
        $tt=$_REQUEST["tt"];
    }
    
    $mancu=NULL;
    if(isset($_REQUEST["mancu"])){
        $mancu=$_REQUEST["mancu"];
        
    }
    
    $masp=NULL;
    if(isset($_REQUEST["masp"])){
        $masp=$_REQUEST["masp"];
        
    }
    
    $tensp=NULL;
    if(isset($_REQUEST["tensp"])){
        $tensp=$_REQUEST["tensp"];
        
    }
    
    $ngaysx=NULL;
    if(isset($_REQUEST["ngaysx"])){
        $ngaysx=$_REQUEST["ngaysx"];
        
    }
    
    
    $ngayhh=NULL;
    if(isset($_REQUEST["ngayhh"])){
        $ngayhh=$_REQUEST["ngayhh"];
        
    }
    
    $nhasx=NULL;
    if(isset($_REQUEST["nhasx"])){
        $nhasx=$_REQUEST["nhasx"];
        
    }
    
    $ngaynhap=NULL;
    if(isset($_REQUEST["ngaynhap"])){
        $ngaynhap=$_REQUEST["ngaynhap"];
        
    }
    
    $slnhap=NULL;
    if(isset($_REQUEST["slnhap"])){
        $slnhap=$_REQUEST["slnhap"];
        
    }
    
    $dongianhap=NULL;
    if(isset($_REQUEST["dongianhap"])){
        $dongianhap=$_REQUEST["dongianhap"];
        
    }
    
    $dongiatm=NULL;
    if(isset($_REQUEST["dongiatm"])){
        $dongiatm=$_REQUEST["dongiatm"];
        
    }
    
    $dongiatts=NULL;
    if(isset($_REQUEST["dongiatts"])){
        $dongiatts=$_REQUEST["dongiatts"];
        
    }
    
    $anhsp=NULL;
    if(isset($_REQUEST["anhsp"])){
        $anhsp=$_REQUEST["anhsp"];
        
    }
    
    $giamgia=NULL;
    if(isset($_REQUEST["giamgia"])){
        $giamgia=$_REQUEST["giamgia"];
        
    }
    if(isset($_POST) && !empty($_FILES['file'])){
       $duoi = explode('.', $_FILES['file']['name']); // tách chuỗi khi gặp dấu .
        $duoi = $duoi[(count($duoi) - 1)]; //lấy ra đuôi file
        // Kiểm tra xem có phải file ảnh không
        if ($duoi === 'jpg' || $duoi === 'png' || $duoi === 'gif') {
            // tiến hành upload
            if (move_uploaded_file($_FILES['file']['tmp_name'], '../../images/SP/' . $_FILES['file']['name'])) {
                // Nếu thành công
                echo "tc";
            } else { // nếu không thành công
                echo "tb";
            }
        } else { // nếu không phải file ảnh
            echo "tb"; // in ra thông báo
        }
    }
    
    if($tt != NULL){
        if($tt=="laydsncu"){
            $dsncu=nhacungungBUS::getDSNCU();
            if(is_array($dsncu)){
                foreach ($dsncu as $ncu) {
                    echo "<option value='".$ncu->getIdNCU()."'>".$ncu->getTenNCU()."</option>";
                }
            }
            else{
                echo "null";
            }
        }
        else if($tt=="them"){//them
            if($tensp != NULL && $nhasx != NULL && $slnhap !=NULL && $dongianhap !=NULL && $dongiatm !=NULL && $dongiatts !=NULL){
                
                $ma= samphamBUS::TaoMaNN();
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $now= date("Y-m-d H:i:s");
                if($anhsp == "chuachonanh"){
                    $anhsp="Chưa chọn ảnh";
                    
                }
                
                $sp=new sanpham($ma, $mancu, $tensp, CommonComand::endateformat($ngaysx), CommonComand::endateformat($ngayhh), $nhasx, CommonComand::endateformat($ngaynhap), $slnhap, $dongianhap, $dongiatm, $dongiatts, $giamgia, $anhsp, $now);         
                $kq= samphamBUS::ThemSP($sp);
                
                if($kq === TRUE){
                    echo "tc";
                }
                else{
                    echo "tb";
                }
                   
            }
            
        }
        else if($tt=="sua"){ //sửa
            if($masp != NULL && $tensp != NULL && $nhasx != NULL && $slnhap !=NULL && $dongianhap !=NULL && $dongiatm !=NULL && $dongiatts !=NULL){
                date_default_timezone_set('Asia/Ho_Chi_Minh');
                $now= date("Y-m-d H:i:s");
                if($anhsp == "chuachonanh"){
                    $anhsp="Chưa chọn ảnh";
                    
                }
                $sp=new sanpham($masp, $mancu, $tensp, CommonComand::endateformat($ngaysx), CommonComand::endateformat($ngayhh), $nhasx, CommonComand::endateformat($ngaynhap), $slnhap, $dongianhap, $dongiatm, $dongiatts, $giamgia, $anhsp, $now);
                
                if($anhsp=="Chưa chọn ảnh"){
                    $kq= samphamBUS::CapnhatSP($sp, 0);
                    if($kq===TRUE){
                        echo "tc";
                    }
                    else{
                        echo "tb";
                    }
                }
                else{
                    $kq= samphamBUS::CapnhatSP($sp, 1);
                    if($kq===TRUE){
                        echo "tc";
                    }
                    else{
                        echo "tb";
                    }
                }
                
            }
            else{
                echo "nul";
            }
        }
        else if($tt == "xoa"){ //xoá
            if($masp != NULL){
                $xoahdbct=hoadonbanCTBUS::XoaHDBCTtheoIdSP($masp);
                $xoahtct=hangtonCTDAO::XoaHTCTtheoIdSP($masp);
                $xoaspbct=sanphambanCTBUS::XoaSPBCTtheoIdSP($masp);
                $xoasp= samphamBUS::XoaSP($masp);
                
                if($xoahdbct === TRUE && $xoahtct === TRUE && $xoaspbct === TRUE && $xoasp === TRUE){
                    echo "tc";
                }
                else{
                    echo "tb";
                }
            }
            
        }
    }


