
<?php
    require '../../../model/Common/CommonComand.php';
    //dto
    require '../../../model/dto/hoadonban.php';
    require '../../../model/dto/hoadonbanct.php';
    require '../../../model/dto/khachhang.php';
    require '../../../model/dto/nhanvien.php';
    require '../../../model/dto/sanpham.php';
    
    //dao
    require '../../../model/dao/hoadonbanDAO.php';
    require '../../../model/dao/hoadonbanCTDAO.php';
    require '../../../model/dao/khachhangDAO.php';
    require '../../../model/dao/nhanvienDAO.php';
    require '../../../model/dao/sanphamDAO.php';
    
    //bus
    
    require '../../../model/bus/hoadonbanBUS.php';
    require '../../../model/bus/hoadonbanCTBUS.php';
    require '../../../model/bus/khachhangBUS.php';
    require '../../../model/bus/nhanvienBUS.php';
    require '../../../model/bus/samphamBUS.php';
    
?>

<?php header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache"); ?>
<?php 
    
if(isset($_SESSION["mand"])){
     $_REQUEST["daughter"] = "daughter"; $_REQUEST["inhdb"] = "Yang - In hoá đơn bán";
     ?>
<?php $_REQUEST["kococlassnd"] = "kococlassnd";?>
    <?php include '../../../View/top.php'; ?>
 <?php 
    if(isset($_REQUEST["huyss"])){
        $_SESSION["mahdb"]=NULL;
    }   
    if(isset($_REQUEST["mahdb"])){
        $_SESSION["mahdb"]=$_REQUEST["mahdb"];
    }
    $slbanghi=0;
    if(isset($_SESSION['mahdb'])){
        $mahdb=$_SESSION['mahdb'];
        
    ?>
<p hidden="" id="mahdb"><?php echo $mahdb; ?></p>
<div class="row">
    <div class="col-sm-12">
        <div id="contenttoprint">
            <div class="row">
                <div class="col-sm-2" style="margin-right: -50px;">
                    <img src="../../../images/Logo4.png">
                </div>
                <div class="col-sm-5">
                    <br>
                    <center><h5 style="font-weight: bold;">CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</h5></center>
                    <center><h6 style="font-weight: bold;">Độc lập - Tự do - Hạnh phúc</h6></center>
                </div>
                <div class="col-sm-5"></div>
            </div>
            <div class="row">
                <div class="col-sm-2" style="margin-right: -50px;"></div>
                <div class="col-sm-5">
                    <center><h3 style="font-weight: bold;">HOÁ ĐƠN BÁN</h3></center>
                    <center><h6 style="font-weight: bold;" id="ngaylap"><?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $now= date("Y-m-d H:i:s"); echo '(Ngày lập HĐ: '.CommonComand::dedateformat($now).')'; ?></h6></center>
                </div>
                <div class="col-sm-5"></div>
            </div>
            <br><br>
            <?php $hdb= hoadonbanBUS::getHDB($mahdb); 
                        if($hdb!= NULL){
                            if($hdb->getIdNV() != NULL){
                                $manv=$hdb->getIdNV();
                                $makh=$hdb->getIdKH();
                                $nv= nhanvienBUS::getNV($manv);
                                $kh= khachhangBUS::getKH($makh);
                                $dshdbct= hoadonbanCTBUS::getDSHDBCTTheoIdHDB($mahdb);
                        ?>
            <div class="row">
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-2" style="margin-right: -50px;">
                            <p style="font-weight: bold;">Khách hàng: </p>
                        </div>

                        <div class="col-sm-3">
                            <?php if($kh != NULL){
                                if($kh->getTenKH() != NULL){
                                ?>
                            <p><?php echo $kh->getTenKH(); ?></p>
                            <?php }else{ ?>
                            <p>NULL</p>
                            <?php }}else{ ?>
                            <p>NULL</p>
                            <?php } ?>
                        </div>
                        <div class="col-sm-1" style="margin-right: -30px;">
                            <p style="font-weight: bold;">SĐT: </p>
                        </div>
                        <div class="col-sm-2">
                            <?php if($kh != NULL){
                                if($kh->getSDT() != NULL){
                                ?>
                            <p><?php echo $kh->getSDT(); ?></p>
                            <?php }else{ ?>
                            <p>NULL</p>
                            <?php }}else{ ?>
                            <p>NULL</p>
                            <?php } ?>
                        </div>
                        <div class="col-sm-5"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3" style="margin-right: -75px;">
                            <p style="font-weight: bold;">Địa chỉ khách hàng: </p>
                        </div>
                        <div class="col-sm-3" style="margin-right: -46px;">
                            <?php if($kh != NULL){
                                if($kh->getDiaChi() != NULL){
                                ?>
                            <p><?php echo $kh->getDiaChi(); ?></p>
                            <?php }else{ ?>
                            <p>NULL</p>
                            <?php }}else{ ?>
                            <p>NULL</p>
                            <?php } ?>
                        </div>
                        <div class="col-sm-3" style="margin-right: -60px;">
                            <p style="font-weight: bold;">Hình thức thanh toán: </p>
                        </div>
                        <div class="col-sm-2">
                            <?php if(intval($hdb->getHinhThucTT()) == 0){ ?>
                            <p>Trả tiền mặt</p>
                            <?php }else{ ?>
                            <p>Trả sau (*)</p>
                            <?php }?>
                        </div>
                        <div class="col-sm-1"></div>
                    </div>
                </div>
                <div class="col-sm-1">
                </div>
                <div class="col-sm-1"></div>
            </div>
            <div class="row">
                <div class="col-sm-7">
                    <table class="table table-bordered" style="font-size: 10pt;">
                        <thead>
                            <tr>
                                <th ><center>Sản phẩm</center></th>
                                <th ><center>Số lượng</center></th>
                                <th ><center>Đơn giá</center></th>
                                <th ><center>Giảm giá</center></th>
                                <th ><center>Thành tiền</center></th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 9pt;">
                            <?php if(is_array($dshdbct)){ 
                                 foreach ($dshdbct as $hdbct) {
                                     if($hdbct != NULL){
                                         if($hdbct->getIdSP() !=  NULL){
                                             $slbanghi++;
                                            ?> 
                            <tr>
                                <?php 
                                $masp=$hdbct->getIdSP();
                                             $sp= samphamBUS::getSP($masp);
                                             if($sp!=NULL){
                                                 if($sp->getTenSP() != NULL){

                                ?>
                                <td><?php echo $sp->getTenSP(); ?></td>

                                                 <?php }else{ ?>
                                <td>NULL</td>
                                             <?php }}else{ ?>
                                <td>NULL</td>
                                             <?php }?>
                                 <td><?php echo number_format($hdbct->getSL()); ?></td>
                                 <td><?php echo number_format($hdbct->getDonGia())." VNĐ"; ?></td>
                                 <td><?php echo $hdbct->getGiamGia()." %"; ?></td>
                                 <td><?php echo number_format($hdbct->getThanhTien())." VNĐ"; ?></td>
                            </tr>
                                         <?php }else{ ?> 
                            <!--lỗi khi lấy dl-->
                            <tr>
                                <td>NULL</td>
                                <td>NULL</td>
                                <td>NULL</td>
                                <td>NULL</td>
                                <td>NULL</td>
                            </tr>
                                     <?php }} else{ ?>
                            <!--chi tiết không tồn tại-->
                            <tr>
                                <td>NULL</td>
                                <td>NULL</td>
                                <td>NULL</td>
                                <td>NULL</td>
                                <td>NULL</td>
                            </tr>
                            <?php }}}else{ if($dshdbct != NULL){ ?>
                            <!--lỗi khi lấy dshdbct-->
                            <tr>
                                <td>LOI</td>
                                <td>LOI</td>
                                <td>LOI</td>
                                <td>LOI</td>
                                <td>LOI</td>
                            </tr>
                            <?php }}?>

                            <tr>
                                <td style="font-weight: bold;">Tổng SL: </td> 
                                <td><?php echo number_format($hdb->getTongSL()); ?></td>
                                <td colspan="2" style="font-weight: bold;">Tổng tiền: </td>
                                <td><?php echo number_format($hdb->getTongTien())." VNĐ"; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-5"></div>
            </div>
             <div class="row">
                <div class="col-sm-4">

                </div>
                <div class="col-sm-3">
                    <p style="font-size: 9pt;">................ngày <?php echo date('d');?> tháng <?php echo date('m');?> năm <?php echo date('Y');?></p>
                    <center style="font-weight: bold; font-size: 9pt;">Nhân viên lập</center>
                    <center style="font-style: italic; font-size: 8pt;">(Ký và ghi rõ họ tên)</center>
                    <br><br><br>
                    <center style="font-weight: bold;"><?php if($nv!=NULL){
                        if($nv->getTenNV() != NULL){
                            echo $nv->getTenNV();
                        }else{
                    echo "NULL";}}else{    echo 'NULL'; }?></center>
                </div>
                 <div class="col-sm-5"></div>
            </div>
             <?php if(intval($hdb->getHinhThucTT()) == 1){ ?>
                <div class="row">
                    <div class="col-sm-12">
                        <p style="font-style: italic; font-size: 8pt;">* Nhớ mang theo hoá đơn này khi thanh toán!</p>
                    </div>
                </div>
                <?php }?>
                        <?php }else{ ?>
            <center><h4 style="color: red;">Đã có lỗi xảy ra, không thể lấy thông tin hoá đơn!</h4></center>
                        <?php }}else{ ?>
            <center><h4 style="color: red;">Hoá đơn hiện tại rỗng!</h4></center>
                        <?php } ?>

        </div>
    </div>
</div>
<p hidden="" id="slbanghi"><?php echo $slbanghi; ?></p>
<button class="btn btn-success" id="btnprint"><span class="glyphicon glyphicon-print" title="In"></span></button>
    <?php }else{ ?>
<center><h3 style="color: red;">Không có dữ liệu để in, vui lòng nạp dữ liệu cho máy!</h3></center>
    <?php } ?>
<script src="../../../js/jspdf.debug.js"></script>
<script src="../../../js/html2canvas.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#btnprint").click(function () {
            var imgData;
            var slbanghi=$("#slbanghi").text();
            var slbg=parseInt(slbanghi);
            html2canvas($("#contenttoprint"), {
                useCORS: true,
                onrendered: function (canvas) {
                    imgData = canvas.toDataURL(
                       'image/png');
                    var cao;
                    if(slbg <= 7){
                        cao=200;
                    }
                    else if(slbg >7 && slbg <= 14){
                        cao=320;
                    }
                    else{
                        cao=420;
                    }
                    var doc = new jsPDF('p','mm', [160, cao]);
                    doc.addImage(imgData, 'PNG', 5, 5);
                    doc.autoPrint({variant: 'non-conform'});
                    doc.save($("#mahdb").text()+'.pdf');

                }
            });
            $.ajax({
               url: "index.php",
               type: 'POST',
               data:{huyss: "huyss"},
               success: function() {
                   
                },
               error:function() {
                   alert("Đã xảy ra lỗi, không thể làm sạch hoá đơn rác sau khi in!");
                   return false;
                }
            });
        });
    });
    
</script>
<?php include '../../../View/bottom.php'; ?>
<?php $_REQUEST["daughter"] = NULL; ?>
        <?php
}else{
       ?>
       <script>
           location.replace("../../../");
       </script>
    
    <?php
}