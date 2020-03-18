<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require '../../../model/Common/CommonComand.php';
    //dto
    require '../../../model/dto/sanpham.php';
    require '../../../model/dto/sanphamban.php';
    require '../../../model/dto/nguoidung.php';
    require '../../../model/dto/nhanvien.php';
    //dao
    require '../../../model/dao/sanphamDAO.php';
    require '../../../model/dao/sanphambanDAO.php';
    require '../../../model/dao/nguoidungDAO.php';
    require '../../../model/dao/nhanvienDAO.php';
    //bus
    require '../../../model/bus/sanphambanBUS.php';
    require '../../../model/bus/samphamBUS.php';
    require '../../../model/bus/nguoidungBUS.php';
    require '../../../model/bus/nhanvienBUS.php';
?>
<?php header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache"); ?>
<?php 
    
if(isset($_SESSION["mand"])){
    $manguoidung= $_SESSION["mand"];
    if(substr($manguoidung, 0, 4) == "NDBH" || substr($manguoidung, 0, 4) == "NDTK"){
        echo "<center><h1 style='color: red;'> Bạn không có quyền thao tác trên khu vực này!</h1></center>";
    }
    else{
        if(substr($manguoidung, 0, 4) == "NDQT"){
            $_REQUEST["ndqt"] = "ndqt";
        }
        ?>
<?php $_REQUEST["daughter"] = "daughter"; $_REQUEST["tkspb"] = "Yang - Thống kê sản phẩm bán";
     ?>
    <?php include '../../../View/top.php'; ?>
                    <!--lấy mã nhân viên phục vụ thêm-->
                    <?php $nd=nguoidungBUS::getND($manguoidung); 
                        if($nd!=NULL){
                            if($nd->getIdNV() != NULL){
                    ?>
                    <p id="manv" hidden=""><?php echo $nd->getIdNV(); ?></p> 
                        <?php }else{
                            ?>
                    <p id="manv" hidden=""></p> 
                            <?php
                        } }else { ?>
                    <p id="manv" hidden=""></p> 
                        <?php } ?>
                    <h2>Thống kê sản phẩm bán</h2><br>
                    <div class="row">
                        <div class="col-sm-2" style="margin-bottom: 40px;">
                            <?php if(substr($manguoidung, 0, 4) == "NDQT"){ ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#fthem" id="btnthem" style=" position: fixed; z-index: 99;" disabled="">
                                <span class="glyphicon glyphicon-plus"></span> Thêm thống kê
                            </button>
                            <?php }else { ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#fthem" id="btnthem" style=" position: fixed; z-index: 99;">
                                <span class="glyphicon glyphicon-plus"></span> Thêm thống kê
                            </button>
                            <?php } ?>
                        </div>
                        <div class="col-sm-6">
                            <form>
                                <div class="row" >
                                    <div class="col-sm-7" style="margin-bottom: 50px;">
                                        <div class="form-group">
                                            <?php
                                                //lấy giá trị từ textbox search
                                                if(isset($_REQUEST["keysearch"])){
                                                    $keyse= $_REQUEST["keysearch"];
                                                    if($keyse != ""){
                                                    
                                            ?>
                                            <input class="form-control" type="text" name="keysearch"  value="<?php echo $keyse; ?>" style=" position: fixed; z-index: 99; width: 270px;">
                                            <?php }else{ ?>
                                            <input class="form-control" type="text" name="keysearch" placeholder="Bạn cần tìm gì?" style=" position: fixed; z-index: 99; width: 270px;">
                                            <?php }}else{ ?>
                                            <input class="form-control" type="text" name="keysearch" placeholder="Bạn cần tìm gì?" style=" position: fixed; z-index: 99; width: 270px;">
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-5" style="margin-bottom: 30px;">
                                        <button class="btn btn-info" type="submit" name="action" value="tk" formmethod="get" style=" position: fixed; z-index: 99;">
                                            &nbsp;&nbsp;<span class="glyphicon glyphicon-search"></span>&nbsp;&nbsp;
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2" style="margin-bottom: 30px;">
                            <div class="form-group">
                                <label style=" position: fixed; z-index: 99;">Mã thống kê</label>                                        
                            </div>
                        </div>
                        <div class="col-sm-2" style="margin-bottom: 40px;">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtmtk" style=" position: fixed; z-index: 99; width: 140px;">
                            </div>
                        </div>
                        <div class="col-sm-1" style="margin-bottom: 40px; margin-right: 20px">
                            <div class="form-group">
                                <button class="btn btn-info" data-toggle="modal" id="btnxemct" style=" position: fixed; z-index: 99;">Xem chi tiết</button>
                            </div>
                        </div>
                        <div class="col-sm-1" style="margin-bottom: 40px;">
                            <div class="form-group">
                                <button class="btn btn-success" id="btnlammoi" style=" position: fixed; z-index: 99;">Làm mới</button>
                            </div>
                        </div>
                        <div class="col-sm-1" style="margin-bottom: 40px;">
                            <div class="form-group">
                                <?php if(substr($manguoidung, 0, 4) == "NDQT"){ ?>
                                <button class="btn btn-warning" id="btnsua" data-toggle="modal" style=" position: fixed; z-index: 99;" disabled="">Cập nhật</button>
                                <?php }else{ ?>
                                <button class="btn btn-warning" id="btnsua" data-toggle="modal" style=" position: fixed; z-index: 99;">Cập nhật</button>
                                <?php }?>
                            </div>
                        </div>
                        <div class="col-sm-1" style="margin-bottom: 20px;">
                            <div class="form-group">
                                <?php if(substr($manguoidung, 0, 4) == "NDQT"){ ?>
                                <button class="btn btn-danger" id="btnxoa" style=" position: fixed; z-index: 99;" disabled="">Xoá</button>
                                <?php }else { ?>
                                <button class="btn btn-danger" id="btnxoa" style=" position: fixed; z-index: 99;">Xoá</button>
                                <?php }?>
                            </div>
                        </div>
                        
                        <div class="col-sm-4">
                        </div>
                    </div>                       
                    <!-- Danh sách thống kê -->
                    <br>
                    <table class="table table-hover" id="tbltk">   
                        <tr>
                            <th hidden=""></th> 
                            <th>Nhân viên lập</th>
                            <th>Tổng số lượng bán trong tháng</th>
                            <th>Ngày thống kê</th>
                            <th>Ngày cập nhật</th>
                        </tr>
                        <?php 
                            if(isset($_REQUEST["action"])){ 
                                $ac=$_REQUEST["action"];  
                                $keyse= $_REQUEST["keysearch"];
                                if($keyse != ""){
                                    $dsspb= sanphambanBUS::TKSPB($keyse);
                                    if($dsspb != NULL){
                                        if(is_array($dsspb)){
                                            foreach($dsspb as $spb){
                                            
                        ?>
                        <tr>
                            <td hidden=""><?php echo $spb->getIdSPB(); ?></td>
                            <?php $m=$spb->getIdNV();
                            $nv=nhanvienBUS::getNV($m);
                            if($nv != NULL){
                                if($nv->getTenNV() != NULL)
                                {
                            ?>
                            <td><?php echo $nv->getTenNV(); ?></td>
                            <?php }
                            else{
                                ?>
                            <td></td>
                            <?php
                            }
                                }else{ ?>
                            <td></td>
                                <?php }?>
                            <td><?php echo number_format($spb->getTSLBNgay()); ?></td>
                            <td><?php echo CommonComand::dedateformat($spb->getNgayTK()); ?></td>
                            <td><?php echo CommonComand::dedateformat($spb->getNgayCN()); ?></td>
                        </tr>
                         <?php }}else{ ?>
                        <!--không làm gì cả do phát sinh lỗi-->
                        
                                            <?php }}else{ ?>
                        <!--không làm gì cả do không tìm thấy kế quả-->
                                    <?php }}else{
                                       $dsspb= sanphambanBUS::getDSSPB();
                                    if($dsspb != NULL){
                                        if(is_array($dsspb)){
                                            foreach($dsspb as $spb){
                                        ?>
                        <tr>
                            <td hidden=""><?php echo $spb->getIdSPB(); ?></td>
                            <?php $m=$spb->getIdNV();
                            $nv=nhanvienBUS::getNV($m);
                            if($nv != NULL){
                                if($nv->getTenNV() != NULL)
                                {
                            ?>
                            <td><?php echo $nv->getTenNV(); ?></td>
                            <?php }
                            else{
                                ?>
                            <td></td>
                            <?php
                            }
                                }else{ ?>
                            <td></td>
                                <?php }?>
                            <td><?php echo number_format($spb->getTSLBNgay()); ?></td>
                            <td><?php echo CommonComand::dedateformat($spb->getNgayTK()); ?></td>
                            <td><?php echo CommonComand::dedateformat($spb->getNgayCN()); ?></td>
                        </tr>
                        <?php } ?>
                        <script type="text/javascript">
                            alert("Bạn chưa nhập thông tin tìm kiếm!");
                        </script>    
                        <?php }}}} else{
                                         $dsspb= sanphambanBUS::getDSSPB();
                                    if($dsspb != NULL){
                                        if(is_array($dsspb)){
                                            foreach($dsspb as $spb){
                                    ?>
                        <tr>   
                            <td hidden=""><?php echo $spb->getIdSPB(); ?></td>
                            <?php $m=$spb->getIdNV();
                            $nv=nhanvienBUS::getNV($m);
                            if($nv != NULL){
                                if($nv->getTenNV() != NULL)
                                {
                            ?>
                            <td><?php echo $nv->getTenNV(); ?></td>
                            <?php }
                            else{
                                ?>
                            <td></td>
                            <?php
                            }
                                }else{ ?>
                            <td></td>
                                <?php }?>
                            <td><?php echo number_format($spb->getTSLBNgay()); ?></td>
                            <td><?php echo CommonComand::dedateformat($spb->getNgayTK()); ?></td>
                            <td><?php echo CommonComand::dedateformat($spb->getNgayCN()); ?></td>
                        </tr>
                        <?php }}}} ?>  
                    </table>

                     <!-- Hộp modal chứa table chi tiết -->
                    <div class="modal fade" id="fchitiet" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title text-center" id="modalttct">Chi tiết thống kê</h4>
                                </div>
                                <div class="modal-body">
                                    <div id="tbltkct">
                                        <!--Vùng hiển thị danh sách chi tiết-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                  
                    <script>
                        //thêm
                        $('#btnthem').click(function (){
                            var manv=$('#manv').text().toString().trim();
                            $.ajax({
                                type: "POST",
                                url: "proccess.php",
                                data: {tt: "kttkthang"},
                                success: function(data) {
                                    let dt=data;
                                    dt=dt.toString().trim();
                                    if(dt!==null){
                                        if(dt==="tc"){
                                            //duoc them
                                            $.ajax({
                                                type: "POST",
                                                url: "proccess.php",
                                                data: {manv: manv, tt: "them"},
                                                success: function(data) {
                                                    let dt=data;
                                                    dt=dt.toString().trim();
                                                    if(dt!==null){
                                                        if(dt==="tc"){
                                                            alert("Thêm thành công!");
                                                            location.replace("../tkspb");
                                                        }
                                                        else{
                                                            alert("Thêm thất bại, hãy thử lại lần nữa!");
                                                            return false;
                                                        }
                                                    }
                                                    else{
                                                        alert("Thêm thất bại, có thể đã xảy ra lỗi!");
                                                        return false;
                                                    } 
                                                },
                                                error: function() {
                                                    alert("Thêm thất bại, đã có lỗi xảy ra!");
                                                    return false;
                                                }
                                            });
                                        }
                                        else{
                                            alert("Thêm thất bại, đã có thống kê trong tháng này, hãy thao tác cập nhật!");
                                            return false;
                                        }
                                    }
                                    else{
                                        alert("Thêm thất bại, đã có lỗi xảy ra, không thể kiểm tra các thống kê gần đây!");
                                        return false;
                                    } 
                                },
                                error: function() {
                                    alert("Thêm thất bại, đã có lỗi xảy ra!");
                                    return false;
                                }
                            });
                        });

                        let kttk="";
                        //lấy mã tk phục vụ sửa xoá
                        $("#tbltk").find("tr").find("td").click(function(){
                           var listOfCell=$(this).siblings(); //biến kết quả trả về thành mảng chứa nội dung trong các ô (giá trị index tương ứng với số cột)
                           $("#tbltk").find("tr").find("td").css({"background-color":"white"});               
                           $(listOfCell[1]).css({"background-color":"lightgray"});
                           $(listOfCell[2]).css({"background-color":"lightgray"});
                           $(listOfCell[3]).css({"background-color":"lightgray"});
                           $(listOfCell[4]).css({"background-color":"lightgray"});
                           $(this).css({"background-color":"lightgray"});
                           $("#txtmtk").val($(listOfCell[0]).text());

                           kttk=""; //khởi tạo flag kiểm tra.
                           $('#btnxemct').removeAttr("data-target");
                           //kiểm tra mã hoá đơn trước khi xem chi tiết, sửa hoặc xoá
                           $.ajax({
                                type: "POST",
                                url: "proccess.php",
                                data: {mspb: $('#txtmtk').val(), tt: "ktspb"},
                                success: function(data) {
                                    let dt=data;
                                    dt=dt.toString().trim();
                                    if(dt!==null){
                                        if(dt === "tc"){
                                            kttk=dt;
                                            $('#btnxemct').attr({"data-target":"#fchitiet"});
                                        }
                                        else{
                                            kttk="tb";
                                        }
                                    }
                                    else{
                                        kttk="tb";
                                    } 
                                },
                                error: function() {
                                    kttk="tb";
                                }
                            });
                        });
                        
                        function laydsspbct(mspb) {
                            $.ajax({
                                type: "POST",
                                url: "proccess.php",
                                data: {mspb: mspb, tt: "laydsspbct"},
                                success: function(data) {
                                    let dt=data;
                                    dt=dt.toString().trim();
                                    let dtarr=dt.split('|');
                                    if(dt!==null){
                                        if(dtarr[0].toString().trim() !== "null"){
                                            $('#tbltkct').html(dtarr[0]);
                                        }
                                        else{
                                            alert("Thống kê không có chi tiết nào!");
                                            $('#tbltkct').html(dtarr[1]);
                                        }
                                    }
                                    else{
                                        alert("Đã có lỗi xảy ra, không thể lấy danh sách sản phẩm bán chi tiết!");
                                        return false;
                                    } 
                                },
                                error: function() {
                                    alert("Đã có lỗi xảy ra, không thể lấy danh sách sản phẩm bán chi tiết!");
                                    return false;
                                }
                            });
                        };
                        
                        //xem chi tiết thống kê
                        $('#btnxemct').click(function() {
                            let mspb=$("#txtmtk").val();
                            if(mspb === ""){
                                alert("Bạn chưa chọn thống kê nào!");
                                return false;
                            }
                            else{
                                if(kttk === "tc"){
                                    laydsspbct(mspb);
                                }
                                else{
                                    alert("Thống kê không tồn tại!");
                                    return false;
                                }
                            }

                        });
                        
                        //cập nhật tk
                        $('#btnsua').click(function() {
                            let maspb=$("#txtmtk").val();
                            if(maspb === ""){
                                alert("Bạn chưa chọn thống kê nào!");
                                return false;
                            }else{
                                if(kttk === "tc"){
                                    $.ajax({
                                        type: "POST",
                                        url: "proccess.php",
                                        data: {mspb: maspb, tt: "sua"},
                                        success: function(data) {
                                            let dt=data;
                                            dt=dt.toString().trim();
                                            if(dt!==null){
                                                if(dt==="tc"){
                                                    alert("Cập nhật thành công!");
                                                    location.replace("../tkspb");
                                                }
                                                else{
                                                    alert("Cập nhật thất bại, hãy thử lại lần nữa!");
                                                    return false;
                                                }
                                            }
                                            else{
                                                alert("Cập nhật thất bại, có thể đã xảy ra lỗi!");
                                                return false;
                                            } 
                                        },
                                        error: function() {
                                            alert("Cập nhật thất bại, đã có lỗi xảy ra!");
                                            return false;
                                        }
                                    });
                                }
                                else{
                                    alert("Thống kê không tồn tại!");
                                    return false;
                                }
                            }  
                        });

                        //xoá
                        $('#btnxoa').click(function(){
                            let maspb=$("#txtmtk").val();
                            if(maspb === ""){
                                alert("Bạn chưa chọn thống kê nào!");
                                return false;
                            }
                            else{
                                var r=confirm("Bạn có chắc chắn muốn xoá thống kê có mã "+ maspb+"!");
                                if(r == true){
                                    $.ajax({
                                        type: "POST",
                                        url: "proccess.php",
                                        data: {mspb: maspb, tt: "xoa"},
                                        success: function(data) {
                                            let dt=data;
                                            dt=dt.toString().trim();
                                            if(dt!==null){
                                                if(dt==="tc"){
                                                    alert("Xoá thành công!");
                                                    location.replace("../tkspb");
                                                }
                                                else{
                                                    alert("Xoá thất bại, hãy thử lại lần nữa!");
                                                    return false;
                                                }
                                            }
                                            else{
                                                alert("Xoá thất bại, có thể đã xảy ra lỗi!");
                                                return false;
                                            }
                                        },
                                        error: function() {
                                            alert("Xoá thất bại, đã có lỗi xảy ra!");
                                            return false;
                                        }
                                    });
                                }

                            }
                        });

                        $('#btnlammoi').click(function() {
                            location.replace("../tkspb");
                        });
                    </script>
<?php include '../../../View/bottom.php'; ?>
<?php $_REQUEST["daughter"] = NULL; ?>
        <?php
    }
}else{
       ?>
       <script>
           location.replace("../../../");
       </script>
    
    <?php
}