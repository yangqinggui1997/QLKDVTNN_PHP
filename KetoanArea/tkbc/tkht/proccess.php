
<?php
    require '../../../model/Common/CommonComand.php';
    //dto
    require '../../../model/dto/hangton.php';
    require '../../../model/dto/hangtonct.php';
    require '../../../model/dto/sanpham.php';
    
    //dao
    require '../../../model/dao/hangtonDAO.php';
    require '../../../model/dao/hangtonCTDAO.php';
    require '../../../model/dao/sanphamDAO.php';
    //bus
    require '../../../model/bus/hangtonBUS.php';
    require '../../../model/bus/hangtonCTBUS.php';
    require '../../../model/bus/samphamBUS.php';
?>
<?php  
    
    $mht=NULL;
    if(isset($_REQUEST["mht"])){
        $mht=$_REQUEST["mht"];
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
        if($tt == "kttkthang"){
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $month= date('m');
            $year= date('Y');
            $ht=hangtonBUS::getHTtheoMonthYear($month, $year);
            if($ht != NULL){
                if($ht->getIdHT() != NULL){
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
            
            $ma= hangtonBUS::TaoMaNN();
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $now= date("Y-m-d H:i:s");
            $ht=new hangton($ma, $manv,0, $now, $now);
            $kq=hangtonBUS::ThemHT($ht);
            $kq1=hangtonCTBUS::ThemHTCT($ma);
            if($kq === TRUE && $kq1 === TRUE){
                echo "tc";
            }
            else{
                echo "tb";
            }
        }
        else if($tt=="ktht"){ // kiểm tra ht có tồn tại không
            $ht=hangtonBUS::getHT($mht);
            if($ht != NULL){
                if($ht->getIdHT() != NULL){
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
        else if($tt == "laydshtct"){ // lấy danh sách htct
            $dshtct=hangtonCTBUS::getDSHTCTtheoIdHT($mht);
            if(is_array($dshtct)){
                ?>
                <table class="table table-hover">
                <tr>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng tồn</th>
                </tr>
                <?php
                foreach ($dshtct as $htct) {
                    ?>
                    <tr>
                        <?php $msp=  $htct->getIdSP();
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
                        <td><?php echo number_format($htct->getSLTon()); ?></td>
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
        else if($tt== "xoa"){ //xoá
            if($mht != NULL){
                $xoahtct=hangtonCTBUS::XoaHTCTtheoIdHT($mht);
                $xoaht=hangtonBUS::XoaHT($mht);
                if($xoahtct===TRUE && $xoaht === TRUE){
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
            $ht=new hangton($mht, "NULL", 0, $now, $now);
            $cnhtct=hangtonCTBUS::CapnhatHTCT($mht);
            $cnht=hangtonBUS::CapnhatHT($ht);
            if($cnhtct === TRUE && $cnht === TRUE){
                echo 'tc';
            }
            else{
                echo $cnht."|".$cnhtct;
            }
        }   
    }
    


