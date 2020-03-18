
<?php
    require '../../model/Common/CommonComand.php';
    //dto
    require '../../model/dto/hoadonban.php';
    require '../../model/dto/hoadonbanct.php';
    require '../../model/dto/khachhang.php';
    require '../../model/dto/sanpham.php';
    require '../../model/dto/nhanvien.php';
    //dao
    require '../../model/dao/hoadonbanDAO.php';
    require '../../model/dao/hoadonbanCTDAO.php';
    require '../../model/dao/khachhangDAO.php';
    require '../../model/dao/sanphamDAO.php';
    require '../../model/dao/nhanvienDAO.php';
    //bus
    require '../../model/bus/hoadonbanBUS.php';
    require '../../model/bus/hoadonbanCTBUS.php';
    require '../../model/bus/khachhangBUS.php';
    require '../../model/bus/samphamBUS.php';
    require '../../model/bus/nhanvienBUS.php';
?>

<?php   
    //Kiểm tra hdb có tồn tại không
    $mhdb=NULL;
    if(isset($_REQUEST["mhdb"])){
        $mhdb=$_REQUEST["mhdb"];
    }
    
    $idhdb=NULL;
    if(isset($_REQUEST["idhdb"])){
        $idhdb=$_REQUEST["idhdb"];
    }
    
    $hd=NULL;
    if(isset($_REQUEST["hd"])){
        $hd=$_REQUEST["hd"];
    }
    
    $masp=NULL;
    if(isset($_REQUEST["masp"])){
        $masp=$_REQUEST["masp"];
    }
    
    if($hd != NULL){
        if($hd=="kthdb"){
            
            $hdb=hoadonbanBUS::getHDB($idhdb);
            if($hdb != NULL){
                if($hdb->getDaNhan() != NULL){
                    $dnhang=$hdb->getDaNhan();
                     echo "tc |".$dnhang;
                }  
                else{
                    echo "tb |";
                }
            }
            else{
                echo "tb |";
            }
        }
        //Kiểm tra hdbct có tồn tại không
        else if($hd=="kthdbct"){
            $hdbct=hoadonbanCTBUS::getHDBCT($idhdb, $masp);
            if($hdbct != NULL){
                if($hdbct->getIdHDB() != NULL){
                    echo "tc";
                } 
                else
                {
                    echo "tb";
                }
            }
            else{
                echo "tb";
            }
        }
        //lấy thông tin hoá đơn chi tiết
        else if($hd=="laytthdbct"){
            $hdbct=hoadonbanCTBUS::getHDBCT($idhdb, $masp);
            if($hdbct != NULL){
                if($hdbct->getIdHDB() != NULL){
                    echo $hdbct->getIdSP()."|".$hdbct->getSL()."|".$hdbct->getDonGia()."|".$hdbct->getGiamGia()."|".$hdbct->getThanhTien();
                }
            }
        }
        
        //lấy tt hdb
        else if($hd == "laytthdb"){
            $hdb=hoadonbanBUS::getHDB($idhdb);
            if($hdb != NULL){
                if($hdb->getIdHDB() != NULL){
                    echo $hdb->getIdNV()."|".$hdb->getIdKH()."|".CommonComand::deDateFormatForUpdate($hdb->getNgayLap())."|".$hdb->getHinhThucTT()."|".$hdb->getDaThanhToan()."|".$hdb->getTongSL()."|".$hdb->getTongTien()."|".$hdb->getTinhTrang()."|".$hdb->getDaNhan();
                }
                
            }
        }
    }
    

    //lấy thông tin hdb
    $tt=NULL;
    if(isset($_REQUEST["tt"])){
        $tt=$_REQUEST["tt"];
    }
    
    $manv=NULL;
    if(isset($_REQUEST["manv"]))
    {
        $manv=$_REQUEST["manv"];
    }
    
    $makh=NULL;
    if(isset($_REQUEST["makh"])){
        $makh=$_REQUEST["makh"];
    }
    
    $hinhthuctt=NULL;
    if(isset($_REQUEST["hinhthuctt"])){
        $hinhthuctt=$_REQUEST["hinhthuctt"];
    }
    
    $dathanhtoan=NULL;
    if(isset($_REQUEST["dathanhtoan"])){
        $dathanhtoan=$_REQUEST["dathanhtoan"];
    }
    
    $tongsl=NULL;
    if(isset($_REQUEST["tongsl"])){
        $tongsl=$_REQUEST["tongsl"];
    }
    
    $tongtien=NULL;
    if(isset($_REQUEST["tongtien"])){
        $tongtien=$_REQUEST["tongtien"];
    }
    
    $tinhtrang=NULL;
    if(isset($_REQUEST["tinhtrang"])){
        $tinhtrang=$_REQUEST["tinhtrang"];
    }
    
    $danhan=NULL;
    if(isset($_REQUEST["danhan"])){
        $danhan=$_REQUEST["danhan"];
    }
    
    //lấy thông tin hdbct
    $sl=NULL;
    if(isset($_REQUEST["sl"])){
        $sl=$_REQUEST["sl"];
    }
    
    $dongia=NULL;
    if(isset($_REQUEST["dongia"])){
        $dongia=$_REQUEST["dongia"];
    }
    
    $giamgia=NULL;
    if(isset($_REQUEST["giamgia"])){
        $giamgia=$_REQUEST["giamgia"];
    }
    
    $thanhtien=NULL;
    if(isset($_REQUEST["thanhtien"])){
        $thanhtien=$_REQUEST["thanhtien"];
    }
    
    if($tt != NULL){
        
        if($tt== "laydskh"){
            try {
                $dskh= khachhangBUS::getDSKH();
                if(is_array($dskh)){
                    foreach ($dskh as $kh) {
                        echo "<option value='".$kh->getSoCMND()."'>".$kh->getTenKH()."</option>";
                    }
                }
                else{
                    echo "null";
                }
            } catch (PDOException $ex) {
                echo "loi";
            }
            
        }
        
        else if($tt=="ktkh"){
            $kh= khachhangBUS::getKH($makh);
            if($kh != NULL){
                if($kh->getSoCMND() != NULL){
                    $m=$kh->getSoCMND();
                    echo $m;
                }
                else{
                    echo "null";
                }
            }
            else{
                echo "null";
            }
        }
        else if($tt=="ktslsp"){
            $sp= samphamBUS::getSP($masp);
            if($sp != NULL){
                if($sp->getSLNhap() != NULL){
                    $m=$sp->getSLNhap();
                    echo $m;
                }
                else{
                    echo "null";
                }
            }
            else{
                echo "null";
            }
        }
        else if($tt=="them"){//them hoá đơn
            
            $ma=hoadonbanBUS::TaoMaNN();
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now= date("Y-m-d H:i:s");
            $hdb=new hoadonban($ma, $manv, $makh, $now, $hinhthuctt, 0, 0, 0, $tinhtrang, 0, $now);
            
            $kq=hoadonbanDAO::ThemHDB($hdb);
            if($kq){
                echo "tc";
            }
            else{
                echo "tb";
            }
        }
        else if($tt=="sua"){ //sửa
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now= date("Y-m-d H:i:s");
            $hdb=new hoadonban($mhdb, $manv, $makh, $now, $hinhthuctt, $dathanhtoan, $tongsl, $tongtien, $tinhtrang, $danhan, $now);
//            echo $mhdb."|".$manv."|".$makh."|".$now."|".$hinhthuctt."|".$dathanhtoan."|".$tongsl."|".$tongtien."|".$tinhtrang."|".$danhan."|".$now;
            $hb=hoadonbanBUS::getHDB($mhdb);
            if($hb != NULL){
                if($hb->getDaNhan() != NULL){
                    $kt=$hb->getDaNhan();
                    $kthdbct=hoadonbanCTBUS::getDSHDBCTTheoIdHDB($mhdb);
                    if($kthdbct == NULL || intval($kt) == 1){
                        $cnhdb=hoadonbanBUS::CapnhatHDB($hdb);
                        if($cnhdb === TRUE){
                            echo "tc";
                        }
                        else{
                            echo "tb";
                        }
                    }
                    else{
                        if(is_array($kthdbct)){
                            if(intval($danhan) == 0){
                                $cnhdb=hoadonbanBUS::CapnhatHDB($hdb);
                                if($cnhdb === TRUE){
                                    echo "tc";
                                }
                                else{
                                    echo "tb";
                                }
                            }
                            else{
                                $cnhdb=hoadonbanBUS::CapnhatHDB($hdb);
                                if($cnhdb === TRUE){
                                //cập nhật sl vào bảng sp
                                    try {
                                        foreach ($kthdbct as $hdbct) {
                                            $ms=$hdbct->getIdSP();
                                            $sp= samphamBUS::getSP($ms);
                                            $slcu= 0;
                                            if($sp != NULL){
                                                if($sp->getSLNhap() != NULL){
                                                    $slcu=$sp->getSLNhap();
                                                    $slcthd=$hdbct->getSL();
                                                    $slmoi=$slcu-$slcthd;
                                                    samphamBUS::CapnhatSLSP($ms, $slmoi);
                                                }

                                            }
                                        }
                                        echo "tc";

                                    } catch (PDOException $ex) {
                                        echo "tb";
                                    }
                                }
                                else{
                                    echo "tb";
                                }
                            }
                        }
                        else{
                            echo "tb";
                        }
                    }
                }
            }
        }
        else if($tt=="xoa"){ //xoá
            if($mhdb != NULL){
                $xoact=hoadonbanCTBUS::XoaHDBCTtheoIdHDB($mhdb);
                $xoa=hoadonbanBUS::XoaHDB($mhdb);
                if($xoact === TRUE && $xoa === TRUE){
                    echo "tc";
                }
                else{
                    echo "tb";
                }
            }
            
        }
        else if($tt == "laydshdbct"){
            $dsct=hoadonbanCTBUS::getDSHDBCTTheoIdHDB($idhdb);
            if(is_array($dsct)){
                ?>
                <table class="table table-hover" id="tblhoadonbanct">
                <tr>
                    <th hidden=""></th> 
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                    <th>Giảm giá</th>
                    <th>Thành tiền</th>
                </tr>
                <?php
                foreach ($dsct as $ct) {
                    ?>
                    <tr>
                        <td hidden=""><?php echo $ct->getIdSP(); ?></td>
                        <td><?php $m=$ct->getIdSP();
                        $sp= samphamBUS::getSP($m);
                        if($sp != NULL){
                            if($sp->getTenSP() != NULL){
                                echo $sp->getTenSP();
                            }
                        }
                         ?></td>
                        <td><?php echo number_format($ct->getSL()); ?></td>
                        <td><?php echo number_format($ct->getDonGia())." VNĐ"; ?></td>
                        <td><?php echo $ct->getGiamGia()." %"; ?></td>
                        <td><?php echo number_format($ct->getThanhTien())." VNĐ" ?></td>
                    </tr>
                    <?php
                }
            ?>
                </table>
                <script >

                    //lấy mã sản phẩm phục vụ sửa xoá
                    $("#tblhoadonbanct").find("tr").find("td").click(function(){
                       var listOfCell=$(this).siblings(); //biến kết quả trả về thành mảng chứa nội dung trong các ô (giá trị index tương ứng với số cột)
                       $("#tblhoadonbanct").find("tr").find("td").css({"background-color":"white"});          
                       $(listOfCell[1]).css({"background-color":"lightgray"});
                       $(listOfCell[2]).css({"background-color":"lightgray"});
                       $(listOfCell[3]).css({"background-color":"lightgray"});
                       $(listOfCell[4]).css({"background-color":"lightgray"});
                       $(listOfCell[5]).css({"background-color":"lightgray"});
                       $(this).css({"background-color":"lightgray"});
                       $("#masp").val($(listOfCell[0]).text());

                       kthdbct=""; //khởi tạo flag kiểm tra.
                       $('#btnsuact').removeAttr("data-target");
                       //kiểm tra mã sản phẩm trước khi xem chi tiết, sửa hoặc xoá
                       $.ajax({
                            type: "POST",
                            url: "proccess.php",
                            data: {idhdb: $('#txtmhdb').val(), masp: $('#masp').val(), hd: "kthdbct"},
                            success: function(data) {
                                let dt=data;
                                dt=dt.toString().trim();
                                if(dt!==null){
                                    if(dt === "tc"){
                                        kthdbct=dt;
                                        $('#btnsuact').attr({"data-target":"#fthemct"});
                                    }
                                    else{
                                        kthdbct="tb";
                                    }
                                }
                                else{
                                    kthdbct="tb";
                                } 
                            },
                            error: function() {
                                kthdbct="tb";
                            }
                        });
                    });
                </script>
            <?php
            }
            else{
               echo "null |";
                ?>
                <table class="table table-hover" id="tblhoadonbanct">
                    <tr>
                        <th hidden=""></th> 
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Giảm giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </table>
                <?php
            }
        }
        else if($tt=="laydssp"){
            $dssp= samphamBUS::getDSSP();
            if($dssp != NULL){
                if(is_array($dssp)){
                    foreach ($dssp as $sp) {
                        echo "<option value='".$sp->getIdSP()."'>".$sp->getTenSP()."</option>";
                    }
                }
                else{
                    echo "loi";
                }
                
            }
            else{
                echo "null";
            }
        }
        else if($tt=="layttsp"){
            $sp= samphamBUS::getSP($masp);
            if($sp != NULL){
                if($sp->getDonGiaTienMat() != NULL){
                    echo $sp->getDonGiaTienMat()."|".$sp->getDonGiaThanhToanSau()."|".$sp->getGiamGia();
                }
                
            }
        }
        else if($tt=="kthttt"){
            $hdb=hoadonbanBUS::getHDB($idhdb);
            if($hdb != NULL){
                if($hdb->getHinhThucTT() != NULL){
                    if(intval($hdb->getHinhThucTT()) == 0){
                        echo "ttm";
                    }
                    else{
                        echo "tts";
                    }            
                }
                   
            }
        }
        else if($tt=="themhdbct"){//them hdbct
            
            $hdbct=new hoadonbanct($mhdb, $masp, $sl, $dongia, $giamgia, $thanhtien);
            $them=hoadonbanCTBUS::ThemHDBCT($hdbct);
            $upsl=hoadonbanBUS::TongSLUpdate($mhdb);
            
            $uptt=hoadonbanBUS::TongTienUpdate($mhdb);
            $hdb= hoadonbanBUS::getHDB($mhdb);
            if($hdb != NULL){
                if($hdb->getHinhThucTT() != NULL){
                    $httt= intval($hdb->getHinhThucTT());
                    $datt=$hdb->getTongTien();
                    if($httt == 0){
                        $cndtt= hoadonbanBUS::DathanhToanUpdate($mhdb, $datt);
                        if($them === TRUE && $upsl === TRUE && $uptt === TRUE && $cndtt === TRUE){
                            echo "tc";
                        }
                        else{
                            echo "tb";
                        }
                    }
                    else{
                        if($them === TRUE && $upsl === TRUE && $uptt === TRUE){
                            echo "tc";
                        }
                        else{
                            echo "tb";
                        }
                    }
                }
                else{
                    echo "tb";
                }
            }
            else{
                echo "tb";
            }
        }
        else if($tt=="suahdbct"){ //sửa hdbct
            if($mhdb != NULL && $masp != NULL && $sl != NULL){
                $hdbct=new hoadonbanct($mhdb, $masp, $sl, $dongia, $giamgia, $thanhtien);
                $sua=hoadonbanCTBUS::CapnhatHDBCT($hdbct);
                $upsl=hoadonbanBUS::TongSLUpdate($mhdb);
                $uptt=hoadonbanBUS::TongTienUpdate($mhdb);
                $hdb= hoadonbanBUS::getHDB($mhdb);
                if($hdb != NULL){
                    if($hdb->getHinhThucTT() != NULL){
                        $httt= intval($hdb->getHinhThucTT());
                        $datt=$hdb->getTongTien();
                        if($httt == 0){
                            $cndtt= hoadonbanBUS::DathanhToanUpdate($mhdb, $datt);
                            if($sua === TRUE && $upsl === TRUE && $uptt === TRUE && $cndtt === TRUE){
                                echo "tc";
                            }
                            else{
                                echo "tb";
                            }
                        }
                        else{
                            if($sua === TRUE && $upsl === TRUE && $uptt === TRUE){
                                echo "tc";
                            }
                            else{
                                echo "tb";
                            }
                        }
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
        else if($tt=="xoahdbct"){ //xoá hdbct
            if($mhdb != NULL & $masp != NULL){
                $xoact=hoadonbanCTBUS::XoaHDBCT($mhdb, $masp);
                $upsl=hoadonbanBUS::TongSLUpdate($mhdb);
                $uptt=hoadonbanBUS::TongTienUpdate($mhdb);
                $hdb= hoadonbanBUS::getHDB($mhdb);
                if($hdb != NULL){
                    if($hdb->getHinhThucTT() != NULL){
                        $httt= intval($hdb->getHinhThucTT());
                        $datt=$hdb->getTongTien();
                        if($httt == 0){
                            $cndtt= hoadonbanBUS::DathanhToanUpdate($mhdb, $datt);
                            if($xoact === TRUE && $upsl === TRUE && $uptt === TRUE && $cndtt === TRUE){
                                echo "tc";
                            }
                            else{
                                echo "tb";
                            }
                        }
                        else{
                            if($xoact === TRUE && $upsl === TRUE && $uptt === TRUE){
                                echo "tc";
                            }
                            else{
                                echo "tb";
                            }
                        }
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



