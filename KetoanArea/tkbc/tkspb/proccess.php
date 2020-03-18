
<?php
    require '../../../model/Common/CommonComand.php';
    //dto
    require '../../../model/dto/sanphamban.php';
    require '../../../model/dto/sanphambanct.php';
    require '../../../model/dto/sanpham.php';
    //dao
    require '../../../model/dao/sanphambanDAO.php';
    require '../../../model/dao/sanphambanCTDAO.php';
    require '../../../model/dao/sanphamDAO.php';
    //bus
    require '../../../model/bus/sanphambanBUS.php';
    require '../../../model/bus/sanphambanCTBUS.php';
    require '../../../model/bus/samphamBUS.php';
?>
<?php
    $mspb=NULL;
    if(isset($_REQUEST["mspb"])){
        $mspb=$_REQUEST["mspb"];
    }
    
    $tt=NULL;
    if(isset($_REQUEST["tt"])){
        $tt=$_REQUEST["tt"];
    }
    
    $manv=NULL;
    if(isset($_REQUEST["manv"])){
        $manv=$_REQUEST["manv"];
    }
    if($tt != NULL){
        if($tt=="kttkthang"){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $month= date('m');
            $year= date('Y');
            $spb= sanphambanBUS::getSPBtheoMonthYear($month, $year);
            if($spb != NULL){
                if($spb->getIdSPB() != NULL){
                    echo 'tb';
                }
                else{
                    echo 'tb';
                }
            }
            else{
                echo "tc";
            }
        }
        else if($tt=="them"){//them thống kê
            $ma= sanphambanBUS::TaoMaNN();
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now= date("Y-m-d H:i:s");
            $month= date('m');
            $year= date('Y');
            $spb=new sanphamban($ma, $manv,0, $now, $now);
            $kq= sanphambanBUS::ThemSPB($month, $year, $spb);
            $kq1= sanphambanCTBUS::ThemSPBCT($month, $year, $ma);
            if($kq === TRUE && $kq1 === TRUE){
                echo "tc";
            }
            else{
                echo $kq;
            }
        }
        else if($tt=="ktspb"){ // kiểm tra spb có tồn tại không
            $spb= sanphambanBUS::getSPB($mspb);
            if($spb != NULL){
                if($spb->getIdSPB() != NULL){
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
        else if($tt=="laydsspbct"){ // lấy danh sách htct
            $dsspbct= sanphambanCTBUS::getDSSPBCTtheoIdSPB($mspb);
            if(is_array($dsspbct)){
                ?>
                <table class="table table-hover">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng bán</th>
                </tr>
                <?php
                foreach ($dsspbct as $spbct) {
                    ?>
                    <tr>
                        <?php $msp=  $spbct->getIdSP();
                        $sp= samphamBUS::getSP($msp); 
                        if($sp != NULL){
                            if($sp->getTenSP()){
                        ?>
                        <td><?php echo $sp->getTenSP(); ?></td>
                        
                            <?php }else{ ?>
                        <td></td>
                        <?php }}else { ?>
                        <td></td>
                        <?php }?>
                        <td><?php echo number_format($spbct->getSLBan()); ?></td>
                    </tr>
                    <?php
                }
            ?>
                </table>
            <?php
            }
            else{
                echo "null |";
                ?>
                <table class="table table-hover">
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng tồn</th>
                    </tr>
                </table>
                <?php
            }
        }
        else if($tt=="xoa"){ //xoá
            if($mspb != NULL){
                $xoaspbct= sanphambanCTBUS::XoaSPBCTtheoIdSPB($mspb);
                $xoaspb= sanphambanBUS::XoaSPB($mspb);
                if($xoaspbct===TRUE && $xoaspb === TRUE){
                    echo "tc";
                }
                else{
                    echo "tb";
                }
            }
           
        }
        else if($tt=="sua"){ //sửa hdbct chỉ quan tâm mã và ngày cn
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now= date("Y-m-d H:i:s");
            $month= date('m');
            $year= date('Y');
            $spb=new sanphamban($mspb, "NULL", 0, $now, $now);
            $cnspbct= sanphambanCTBUS::CapnhatSPBCT($month, $year, $mspb);
            $cnspb= sanphambanBUS::CapnhatSPB($month, $year, $spb);
            if($cnspbct === TRUE && $cnspb === TRUE){
                echo 'tc';
            }
            else{
                echo 'tb';
            }
           
        }   
    }

