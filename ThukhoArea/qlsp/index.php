<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require '../../model/Common/CommonComand.php';
    //dto
    require '../../model/dto/sanpham.php';
    require '../../model/dto/nhacungung.php';
    //dao
    require '../../model/dao/sanphamDAO.php';
    require '../../model/dao/nhacungungDAO.php';
    //bus
    require '../../model/bus/samphamBUS.php';
    require '../../model/bus/nhacungungBUS.php';
?>
<?php if(isset($_SESSION["mand"])){
    $manguoidung= $_SESSION["mand"];
    if(substr($manguoidung, 0, 4) == "NDBH" || substr($manguoidung, 0, 4) == "NDKT"){
        echo "<center><h1 style='color: red;'> Bạn không có quyền thao tác trên khu vực này!</h1></center>";
    }
    else{
        if(substr($manguoidung, 0, 4) == "NDQT"){
            $_REQUEST["ndqt"] = "ndqt";
        }
        ?>
<?php $_REQUEST["child"] = "child"; $_REQUEST["qlsp"] = "Yang - Quản lý sản phẩm";
     ?>
<?php $_REQUEST["kococlassnv"] = "kococlassnv";?>
<?php $_REQUEST["kococlassnd"] = "kococlassnd";?>
    <?php include '../../View/top.php'; ?>
                    <h2>Quản lý sản phẩm</h2><br>
                    <div class="row">
                        <div class="col-sm-2" style="margin-bottom: 40px;">
                            <?php if(substr($manguoidung, 0, 4) == "NDQT"){ ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#fthem" id="btnthem" style=" position: fixed; z-index: 99;" disabled="">
                                <span class="glyphicon glyphicon-plus"></span> Thêm sản phẩm
                            </button>
                            <?php }else{ ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#fthem" id="btnthem" style=" position: fixed; z-index: 99;">
                                <span class="glyphicon glyphicon-plus"></span> Thêm sản phẩm
                            </button>
                            <?php }?>
                        </div>
                        <div class="col-sm-6">
                            <form >
                                <div class="row">
                                    <div class="col-sm-7" style="margin-bottom: 50px;">
                                        <div class="form-group" >
                                            <?php
                                                //lấy giá trị từ textbox search
                                                if(isset($_REQUEST["keysearch"])){
                                                    $keyse= $_REQUEST["keysearch"];
                                                    if($keyse != ""){
                                                    
                                            ?>
                                            <input class="form-control" type="text" name="keysearch"  value="<?php echo $keyse;  ?>" style=" position: fixed; z-index: 99; width: 270px;">
                                            <?php }else{ ?>
                                            <input class="form-control" type="text" name="keysearch" placeholder="Bạn cần tìm gì?" style=" position: fixed; z-index: 99; width: 270px;">
                                            <?php }}else{ ?>
                                            <input class="form-control" type="text" name="keysearch" placeholder="Bạn cần tìm gì?" style=" position: fixed; z-index: 99; width: 270px; ">
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
                                <label style=" position: fixed; z-index: 99;">Mã sản phẩm</label>                                        
                            </div>
                        </div>
                        <div class="col-sm-2" style="margin-bottom: 40px;">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtmsp" readonly="" style=" position: fixed; z-index: 99; width: 140px;">
                            </div>
                        </div>
                        <div class="col-sm-1" style="margin-bottom: 40px; margin-right: 20px">
                            <div class="form-group">
                                <button class="btn btn-success" id="btnlammoi" style=" position: fixed; z-index: 99;">Làm mới</button>
                            </div>
                        </div>
                        <div class="col-sm-1" style="margin-bottom: 40px;">
                            <div class="form-group">
                                <?php if(substr($manguoidung, 0, 4) == "NDQT"){ ?>
                                <button class="btn btn-warning" id="btnsua" data-toggle="modal" data-target="#fthem" style=" position: fixed; z-index: 99;" disabled="">Sửa</button>
                                <?php }else{ ?>
                                <button class="btn btn-warning" id="btnsua" data-toggle="modal" data-target="#fthem" style=" position: fixed; z-index: 99;">Sửa</button>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-sm-1" style="margin-bottom: 20px;">
                            <div class="form-group">
                                <?php if(substr($manguoidung, 0, 4) == "NDQT"){ ?>
                                <button class="btn btn-danger" id="btnxoa" style=" position: fixed; z-index: 99;" disabled="">Xoá</button>
                                <?php }else{ ?>
                                <button class="btn btn-danger" id="btnxoa" style=" position: fixed; z-index: 99;">Xoá</button>
                                <?php }?>
                            </div>
                        </div>
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-1">
                        </div>
                    </div>                       
                    <!-- Danh sách san pham -->
                    <br>
                    <table class="table table-hover" id="tblsanpham" style="position: relative; z-index: 10;">   
                        <tr>
                            <th hidden=""></th> 
                            <th>Nhà cung ứng</th>
                            <th>Tên sản phẩm</th>
                            <th>Ngày sản xuất</th>
                            <th>Ngày hết hạn</th>
                            <th>Nhà sản xuất</th>
                            <th>Ngày nhập</th>
                            <th>Số lượng nhập</th>
                            <th>Đơn giá nhập</th>
                            <th>Đơn giá tiền mặt</th>
                            <th>Đơn giá thanh toán sau</th>
                            <th>Giảm giá</th>
                            <th>Ảnh</th>
                            <th>Ngày cập nhật</th>
                        </tr>
                        <?php 
                            if(isset($_REQUEST["action"])){ 
                                $ac=$_REQUEST["action"];  
                                $keyse= $_REQUEST["keysearch"];
                                if($keyse != ""){
                                    $dssp= samphamBUS::TKSP($keyse);
                                    if($dssp != NULL){
                                        if(is_array($dssp)){
                                            foreach($dssp as $sp){
                                            
                        ?>
                        <tr>
                            <td hidden=""><?php echo $sp->getIdSP(); ?></td>
                            <?php $mncu=$sp->getIdNCU();
                            $ncu=nhacungungBUS::getNCU($mncu); 
                            if($ncu != NULL){
                                if($ncu->getTenNCU() != NULL){
                                 
                            ?>
                            <td><?php echo $ncu->getTenNCU(); ?></td>
                                <?php }else{ ?>
                            <td></td>
                            <?php }}else{ ?>
                            <td></td>
                            <?php } ?>
                            <td><?php echo $sp->getTenSP(); ?></td>
                            <td><?php echo CommonComand::dedateformat($sp->getNgaySX()); ?></td>
                            <td><?php echo CommonComand::dedateformat($sp->getNgayHH()); ?></td>
                            <td><?php echo $sp->getNhaSX(); ?></td>
                            <td><?php echo CommonComand::dedateformat($sp->getNgayNhap()); ?></td>
                            <td><?php echo number_format($sp->getSLNhap()); ?></td>
                            <td><?php echo number_format($sp->getDonGiaNhap())." VNĐ"; ?></td>
                            <td><?php echo number_format($sp->getDonGiaTienMat())." VNĐ"; ?></td>
                            <td><?php echo number_format($sp->getDonGiaThanhToanSau())." VNĐ"; ?></td>
                            <td><?php echo $sp->getGiamGia()." %"; ?></td>
                            <?php $anh=$sp->getAnhSP(); if($anh == "Chưa chọn ảnh"){ ?>
                            <td>Chưa chọn ảnh</td>
                            <?php }else{ ?>
                            <td><img src="../../images/SP/<?php echo $anh; ?>" style="width: 40px; height: 40px;"></td>
                            <?php } ?>
                            <td><?php echo CommonComand::dedateformat($sp->getNgayCN()); ?></td>
                        </tr>
                         <?php }}else{ ?>
                        <!--không làm gì cả do phát sinh lỗi-->
                                            <?php }}else{ ?>
                        <!--không làm gì cả do không tìm thấy kế quả-->
                                    <?php }}else{
                                       $dssp= samphamBUS::getDSSP();
                                    if($dssp != NULL){
                                        if(is_array($dssp)){
                                            foreach($dssp as $sp){
                                    ?>
                        <tr>
                            <td hidden=""><?php echo $sp->getIdSP(); ?></td>
                            <?php $mncu=$sp->getIdNCU();
                            $ncu=nhacungungBUS::getNCU($mncu); 
                            if($ncu != NULL){
                                if($ncu->getTenNCU() != NULL){
                                 
                            ?>
                            <td><?php echo $ncu->getTenNCU(); ?></td>
                                <?php }else{ ?>
                            <td></td>
                            <?php }}else{ ?>
                            <td></td>
                            <?php } ?>
                            <td><?php echo $sp->getTenSP(); ?></td>
                            <td><?php echo CommonComand::dedateformat($sp->getNgaySX()); ?></td>
                            <td><?php echo CommonComand::dedateformat($sp->getNgayHH()); ?></td>
                            <td><?php echo $sp->getNhaSX(); ?></td>
                            <td><?php echo CommonComand::dedateformat($sp->getNgayNhap()); ?></td>
                            <td><?php echo number_format($sp->getSLNhap()); ?></td>
                            <td><?php echo number_format($sp->getDonGiaNhap())." VNĐ"; ?></td>
                            <td><?php echo number_format($sp->getDonGiaTienMat())." VNĐ"; ?></td>
                            <td><?php echo number_format($sp->getDonGiaThanhToanSau())." VNĐ"; ?></td>
                            <td><?php echo $sp->getGiamGia()." %"; ?></td>
                            <?php $anh=$sp->getAnhSP(); if($anh == "Chưa chọn ảnh"){ ?>
                            <td>Chưa chọn ảnh</td>
                            <?php }else{ ?>
                            <td><img src="../../images/SP/<?php echo $anh; ?>" style="width: 40px; height: 40px;"></td>
                            <?php } ?>
                            <td><?php echo CommonComand::dedateformat($sp->getNgayCN()); ?></td>
                        </tr>
                        <?php } ?>
                        <script type="text/javascript">
                            alert("Bạn chưa nhập thông tin tìm kiếm!");
                        </script>    
                        <?php }}}} else{
                                          $dssp= samphamBUS::getDSSP();
                                    if($dssp != NULL){
                                        if(is_array($dssp)){
                                            foreach($dssp as $sp){
                                    ?>
                        <tr>   
                            <td hidden=""><?php echo $sp->getIdSP(); ?></td>
                            <?php $mncu=$sp->getIdNCU();
                            $ncu=nhacungungBUS::getNCU($mncu); 
                            if($ncu != NULL){
                                if($ncu->getTenNCU() != NULL){
                                 
                            ?>
                            <td><?php echo $ncu->getTenNCU(); ?></td>
                                <?php }else{ ?>
                            <td></td>
                            <?php }}else{ ?>
                            <td></td>
                            <?php } ?>
                            <td><?php echo $sp->getTenSP(); ?></td>
                            <td><?php echo CommonComand::dedateformat($sp->getNgaySX()); ?></td>
                            <td><?php echo CommonComand::dedateformat($sp->getNgayHH()); ?></td>
                            <td><?php echo $sp->getNhaSX(); ?></td>
                            <td><?php echo CommonComand::dedateformat($sp->getNgayNhap()); ?></td>
                            <td><?php echo number_format($sp->getSLNhap()); ?></td>
                            <td><?php echo number_format($sp->getDonGiaNhap())." VNĐ"; ?></td>
                            <td><?php echo number_format($sp->getDonGiaTienMat())." VNĐ"; ?></td>
                            <td><?php echo number_format($sp->getDonGiaThanhToanSau())." VNĐ"; ?></td>
                            <td><?php echo $sp->getGiamGia()." %"; ?></td>
                            <?php $anh=$sp->getAnhSP(); if($anh == "Chưa chọn ảnh"){ ?>
                            <td>Chưa chọn ảnh</td>
                            <?php }else{ ?>
                            <td><img src="../../images/SP/<?php echo $anh; ?>" style="width: 40px; height: 40px;"></td>
                            <?php } ?>
                            <td><?php echo CommonComand::dedateformat($sp->getNgayCN()); ?></td>  
                        </tr>
                        <?php }}}} ?>    
                    </table>
                    <!-- Hộp modal chứa form thêm mới -->
                    <div class="modal fade" id="fthem" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center" id="modaltt">Thêm sản phẩm</h4>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label>Chọn nhà cung ứng</label>
                                        <select class="form-control" id="nhacungung">
                                            <!--gọi phương thức lấy danh sách nhà cung ứng-->
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tên sản phẩm</label>
                                        <input type="text" class="form-control" id="tensp" placeholder="Tên sản phẩm">
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày sản xuất</label>
                                        <div class='input-group date' id="datetimepicker1">
                                            <input type='text' class="form-control" id="ngaysx"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày hết hạn</label>
                                        <div class='input-group date' id="datetimepicker2">
                                            <input type='text' class="form-control" id="ngayhethan"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nhà sản xuất</label>
                                        <input type="text" class="form-control" id="nhasx" placeholder="Nhà sản xuất" >
                                    </div>
                                    <div class="form-group">
                                        <label>Ngày nhập</label>
                                        <div class='input-group date' id="datetimepicker3">
                                            <input type='text' class="form-control" id="ngaynhap"/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Số lượng nhập</label>
                                        <input type="number" class="form-control" id="slnhap" placeholder="Số lượng nhập" >
                                    </div>
                                    <div class="form-group">
                                        <label>Đơn giá nhập</label>
                                        <input type="number" class="form-control" id="dongianhap" placeholder="Đơn giá nhập" >
                                    </div>
                                    <div class="form-group">
                                        <label>Đơn giá tiền mặt</label>
                                        <input type="number" class="form-control" id="dongiatm" placeholder="Đơn giá tiền mặt" >
                                    </div>
                                    <div class="form-group">
                                        <label>Đơn giá thanh toán sau</label>
                                        <input type="number" class="form-control" id="dongiatts" placeholder="Đơn giá thanh toán sau">
                                    </div>
                                    <div class="form-group">
                                        <label>Giảm giá</label>
                                        <input type="number" class="form-control" id="giamgia" placeholder="Giảm giá">
                                    </div> 
                                    <div class="form-group">
                                        <label>Ảnh</label>
                                        <input type="file" class="form-control" id="anhsp" placeholder="Chọn ảnh minh hoạ">
                                    </div> 
                                   
                                </form>          
                            </div>
                             <div class="modal-footer">
                                <div class="form-group align-content-center">
                                    <button class="btn btn-primary hidden"  id="nutthem">Thêm</button>
                                    <button class="btn btn-primary hidden" id="nutsua">Sửa</button>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                    <script >
                        $(document).ready(function() {
                            var d=new Date();
                            $('#datetimepicker1').datetimepicker({
                                allowInputToggle: true,
                                defaultDate: d,
                                format: 'DD/MM/YYYY HH:mm:ss '
                            });
                            $('#datetimepicker2').datetimepicker({
                                allowInputToggle: true,
                                defaultDate: d,
                                format: 'DD/MM/YYYY HH:mm:ss '
                            });
                            $('#datetimepicker3').datetimepicker({
                                allowInputToggle: true,
                                defaultDate: d,
                                format: 'DD/MM/YYYY HH:mm:ss '
                            });


                            //thêm
                            $('#btnthem').click(function (){
                                $("#modaltt").text("Thêm sản phẩm");
                                $("#txtmsp").val("");

                                $('#tensp').val("");
                                $('#datetimepicker1').datetimepicker();
                                $('#datetimepicker2').datetimepicker();
                                $('#nhasx').val("");
                                $('#datetimepicker3').datetimepicker();
                                $('#slnhap').val("");
                                $('#dongianhap').val("");
                                $('#dongiatm').val("");
                                $('#dongiatts').val("");
                                $('#giamgia').val("");
                                $.ajax({
                                    type: "POST",
                                    url: "proccess.php",
                                    data: {tt: "laydsncu"},
                                    success: function(data) {
                                        let dt=data;
                                        dt=dt.toString().trim();
//                                        alert(dt);
                                        if(dt!==null){
                                            if(dt!=="null"){
                                                $('#nhacungung').html(dt);
                                            }
                                            else{
                                                alert("Không có nhà cung ứng nào trong danh sách, hãy thêm một vài nhà cung ứng vào!");                                            
                                                return false;
                                            }
                                        }
                                        else{
                                            alert("Đã có lỗi xảy ra, không thể lấy danh sách nhà cung ứng!");
                                            return false;
                                        } 
                                    },
                                    error: function() {
                                        alert("Đã có lỗi xảy ra, không thể lấy danh sách nhà cung ứng!");
                                        return false;
                                    }
                                });
                                $('#nutsua').removeClass('hidden');
                                $('#nutsua').addClass('hidden');
                                $('#nutthem').removeClass('hidden');
                            });

                            $('#nutthem').click(function() {
                                var mancu= $('#nhacungung').val();
                                var tensp= $('#tensp').val();
                                var ngaysx=$('#ngaysx').val();
                                var ngayhh=$('#ngayhethan').val();
                                var nhasx=$('#nhasx').val(); 
                                var ngaynhap= $('#ngaynhap').val();
                                let slnhap=$('#slnhap').val();
                                var dongianhap=$('#dongianhap').val();
                                var dongiatm=$('#dongiatm').val(); 
                                var dongiatts= $('#dongiatts').val();
                                var giamgia=$('#giamgia').val();
                                var anhsp=$('#anhsp').val();
                                if(mancu.toString().trim() === "" ||tensp.toString().trim() === "" || nhasx.toString().trim() === "" || slnhap.toString().trim() === "" || dongianhap.toString().trim() === "" || dongiatm.toString().trim() === "" || dongiatts.toString().trim() === ""){
                                    alert("Vui lòng nhập đầy đủ thông tin, Số lượng nhập, đơn giá nhập, đơn giá tiền mặt, đơn giá thanh toán sau và giảm giá phải có giá trị số!");
                                    return false;     
                                }
                                else{
                                    if(giamgia !== ""){
                                        if(giamgia < 0 || giamgia > 100){
                                            alert("Giảm nằm trong khoảng từ 0 đến 100!");
                                            return false;
                                        }
                                    }
                                    else{
                                        giamgia=0;
                                    }

                                    var sln1=slnhap.toString().indexOf(".");
                                    var sln2=slnhap.toString().indexOf(",");
                                    var sln3=slnhap.toString().indexOf("-");
                                    var sln4=slnhap.toString().indexOf("0");
                                    if(sln1 >=0 || sln2 >=0 || sln3 >= 0 || sln4 == 0){
                                        alert("Số lượng nhập phải là số nguyên không âm và phải có giá trị, không bắt đầu với ký tự '0'!");
                                        return false;
                                    }
                                    
                                    var dgn1=dongianhap.toString().indexOf(".");
                                    var dgn2=dongianhap.toString().indexOf(",");
                                    var dgn3=dongianhap.toString().indexOf("-");
                                    var dgn4=dongianhap.toString().indexOf("0");
                                    if(dgn1 >=0 || dgn2 >=0 || dgn3 >= 0 || dgn4 == 0){
                                        alert("Đơn giá nhập phải là số nguyên không âm và phải có giá trị, không bắt đầu với ký tự '0'!");
                                        return false;
                                    }
                                    
                                    var dgtm1=dongiatm.toString().indexOf(".");
                                    var dgtm2=dongiatm.toString().indexOf(",");
                                    var dgtm3=dongiatm.toString().indexOf("-");
                                    var dgtm4=dongiatm.toString().indexOf("0");
                                    if(dgtm1 >=0 || dgtm2 >=0 || dgtm3 >= 0 || dgtm4 == 0){
                                        alert("Đơn giá tiền mặt phải là số nguyên không âm và phải có giá trị, không bắt đầu với ký tự '0'!");
                                        return false;
                                    }
                                    
                                    var dgtts1=dongiatts.toString().indexOf(".");
                                    var dgtts2=dongiatts.toString().indexOf(",");
                                    var dgtts3=dongiatts.toString().indexOf("-");
                                    var dgtts4=dongiatts.toString().indexOf("0");
                                    if(dgtts1 >=0 || dgtts2 >=0 || dgtts3 >= 0 || dgtts4 == 0){
                                        alert("Đơn giá thanh toán sau phải là số nguyên không âm và phải có giá trị, không bắt đầu với ký tự '0'!");
                                        return false;
                                    }
                                    var dgnhap=parseInt(dongianhap,10);
                                    var dgtienmat=parseInt(dongiatm,10);
                                    var dgthanhts=parseInt(dongiatts,10);
                                    if(dgtienmat <= dgnhap || dgthanhts <= dgnhap || dgthanhts <= dgtienmat){
                                        alert("Đơn giá tiền mặt và đơn giá thanh toán sau không được nhỏ hơn đơn giá nhập và đơn giá thanh toán sau không được nhỏ hơn đơn giá tiền mặt!");
                                        return false;
                                    }
                                    if(slnhap < 0 || dongianhap < 0 || dongiatm < 0 || dongiatts < 0 || giamgia < 0){
                                        alert("Số lượng nhập, đơn giá nhập, đơn giá tiền mặt, đơn giá thanh toán sau và giảm giá phải có giá trị lớn hơn hoặc bằng 0!");
                                        return false;
                                    }
                                    else{
                                        var form_data=null;
                                        if($('#anhsp').val() === ""){
                                            anhsp="chuachonanh";
                                        }
                                        else{
                                            //xử lý phần ảnh
                                            //Lấy ra files

                                            var file_data = $('#anhsp').prop('files')[0];
                                            //lấy ra kiểu file
                                            var type = file_data.type;
                                            //Xét kiểu file được upload
                                            var match = ["image/gif", "image/png", "image/jpg", "image/jpeg", "image/svg"];
                                            //kiểm tra kiểu file
                                            if (type == match[0] || type == match[1] || type == match[2] || type == match[3] || type == match[4]) {
                                            //khởi tạo đối tượng form data
                                                form_data = new FormData();
                                                //thêm files vào trong form data
                                                form_data.append('file', file_data);
                                            } else {
                                                alert('Chỉ được upload file ảnh');
                                                $('#anhsp').val('');
                                                return false;
                                            }
                                            anhsp=$('#anhsp').val().toString().split('\\')[2];
                                        }
                                        
//                                        //them
                                        $.ajax({
                                            type: "POST",
                                            url: "proccess.php",
                                            data: {mancu: mancu, tensp: tensp, ngaysx: ngaysx, ngayhh: ngayhh, nhasx: nhasx, ngaynhap: ngaynhap, slnhap: slnhap, dongianhap: dongianhap, dongiatm: dongiatm, dongiatts: dongiatts, giamgia: giamgia, anhsp: anhsp, tt: "them"},
                                            success: function(data) {
                                                let dt=data;
                                                dt=dt.toString().trim();
//                                                alert(dt);
                                                if(dt!==null){
                                                    if(dt==="tc"){
                                                        if($('#anhsp').val() === ""){
                                                            alert("Thêm thành công!");
                                                            location.replace("../qlsp");
                                                        }
                                                        else{
                                                             $.ajax({
                                                                url: 'proccess.php',
                                                                dataType: 'text',
                                                                cache: false,
                                                                contentType: false,
                                                                processData: false,
                                                                data: form_data,
                                                                type: 'post',
                                                                success: function (data) {
                                                                    let dt=data;
                                                                    dt=dt.toString().trim();
                                                                    if(dt!==null){
                                                                        if(dt!=="null"){
                                                                            if(dt === "tc"){
                                                                                alert("Thêm thành công!");
                                                                                location.replace("../qlsp");
                                                                            }
                                                                            else{
                                                                                alert("Thêm thất bại, không thể up load file ảnh!");
                                                                                return false;
                                                                            }
                                                                        }
                                                                        else{
                                                                            alert("Thêm thất bại, không thể up load file ảnh!");
                                                                            return false;
                                                                        }
                                                                    }
                                                                    else{
                                                                        alert("Thêm thất bại, không thể up load file ảnh!");
                                                                        return false;
                                                                    }
                                                                },
                                                                error: function() {
                                                                    alert("Thêm thất bại, không thể up load file ảnh!");
                                                                    return false;
                                                                }
                                                            });
                                                        }
                                                    }
                                                    else{
                                                        alert("Thêm thất bại, hãy thử lại lần nữa!");
                                                        return false;
                                                    }
                                                }
                                                else{
                                                    alert("Thêm thất bại, hãy thử lại lần nữa!");
                                                    return false;
                                                } 
                                            },
                                            error: function() {
                                                alert("Thêm thất bại, Đã có lỗi xảy ra!");
                                                return false;
                                            }
                                        });
                                    }
                                }
                            });

                            let ktsp="";
                            //lấy mã sản phẩm phục vụ sửa xoá
                            $("#tblsanpham").find("tr").find("td").click(function(){
                               var listOfCell=$(this).siblings(); //biến kết quả trả về thành mảng chứa nội dung trong các ô (giá trị index tương ứng với số cột)
                               $("#tblsanpham").find("tr").find("td").css({"background-color":"white"});               
                               $(listOfCell[1]).css({"background-color":"lightgray"});
                               $(listOfCell[2]).css({"background-color":"lightgray"});
                               $(listOfCell[3]).css({"background-color":"lightgray"});
                               $(listOfCell[4]).css({"background-color":"lightgray"});
                               $(listOfCell[5]).css({"background-color":"lightgray"});
                               $(listOfCell[6]).css({"background-color":"lightgray"});
                               $(listOfCell[7]).css({"background-color":"lightgray"});
                               $(listOfCell[8]).css({"background-color":"lightgray"});
                               $(listOfCell[9]).css({"background-color":"lightgray"});
                               $(listOfCell[10]).css({"background-color":"lightgray"});
                               $(listOfCell[11]).css({"background-color":"lightgray"});
                               $(listOfCell[12]).css({"background-color":"lightgray"});
                               $(listOfCell[13]).css({"background-color":"lightgray"});
                               $(this).css({"background-color":"lightgray"});
                               $("#txtmsp").val($(listOfCell[0]).text());

                               ktsp=""; //khởi tạo flag kiểm tra.
                               //kiểm tra mã sản phẩm trước khi sửa hoặc xoá
                               $.ajax({
                                    type: "POST",
                                    url: "proccess.php",
                                    data: {msp: $('#txtmsp').val()},
                                    success: function(data) {
                                        let dt=data;
                                        dt=dt.toString().trim();
                                        if(dt!==null){
                                            if(dt === "tc"){
                                                ktsp=dt;
                                            }
                                            else{
                                                ktsp="tb";
                                            }
                                        }
                                        else{
                                            ktsp="tb";
                                        } 
                                    },
                                    error: function() {
                                        ktsp="tb";
                                        alert("loi");
                                    }
                                });
                            });

                            //sửa
                            $('#btnsua').click(function() {
                                let msp=$("#txtmsp").val();
                                if(msp === ""){
                                    alert("Bạn chưa chọn sản phẩm nào!");
                                    return false;
                                }else{
                                    if(ktsp === "tc"){
                                        $.ajax({
                                            type: "POST",
                                            url: "proccess.php",
                                            data: {tt: "laydsncu"},
                                            success: function(data) {
                                                let dt=data;
                                                dt=dt.toString().trim();
                                                if(dt!==null){
                                                    if(dt!=="null"){
                                                        $('#nhacungung').html(dt);
                                                        $("#modaltt").text("Sửa sản phẩm");
                                                        $.ajax({
                                                            type: "POST",
                                                            url: "proccess.php",
                                                            data: {idsp: msp},
                                                            success: function(data) {
                                                                let dt=data;
                                                                dt=dt.toString().trim();
                                                                let dtarr= dt.split('|');
                                                                $('#nhacungung').val(dtarr[0]);
                                                                $('#tensp').val(dtarr[1]);
                                                                $('#ngaysx').val(dtarr[2]);
                                                                $('#ngayhethan').val(dtarr[3]);
                                                                $('#nhasx').val(dtarr[4]);
                                                                $('#ngaynhap').val(dtarr[5]);
                                                                $('#slnhap').val(dtarr[6]);

                                                                $('#dongianhap').val(dtarr[7]);
                                                                $('#dongiatm').val(dtarr[8]);
                                                                $('#dongiatts').val(dtarr[9]);
                                                                $('#giamgia').val(dtarr[10]);

                                                            }
                                                        });
                                                        $('#nutthem').removeClass('hidden');
                                                        $('#nutthem').addClass('hidden');
                                                        $('#nutsua').removeClass('hidden');
                                                    }
                                                    else{
                                                        alert("Không có nhà cung ứng nào trong danh sách, hãy thêm một vài nhà cung ứng vào!");
                                                        return false;
                                                    }
                                                }
                                                else{
                                                    alert("Đã có lỗi xảy ra, không thể lấy danh sách nhà cung ứng!");
                                                    return false;
                                                } 
                                            },
                                            error: function() {
                                                alert("Đã có lỗi xảy ra, không thể lấy danh sách nhà cung ứng!");
                                                return false;
                                            }
                                        }); 
                                    }
                                    else{
                                        alert("Sản phẩm không tồn tại!");
                                        return false;
                                    }
                                }  
                            });

                            $('#nutsua').click(function() {
                                var masp= $('#txtmsp').val();
                                var mancu= $('#nhacungung').val();
                                var tensp= $('#tensp').val();
                                var ngaysx=$('#ngaysx').val();
                                var ngayhh=$('#ngayhethan').val();
                                var nhasx=$('#nhasx').val(); 
                                var ngaynhap= $('#ngaynhap').val();
                                var slnhap=$('#slnhap').val();
                                var dongianhap=$('#dongianhap').val();
                                var dongiatm=$('#dongiatm').val(); 
                                var dongiatts= $('#dongiatts').val();
                                var giamgia=$('#giamgia').val();
                                var anhsp=$('#anhsp').val();
                                if(mancu.toString().trim() === "" || tensp.toString().trim() === "" || nhasx.toString().trim() === "" || slnhap.toString().trim() === "" || dongianhap.toString().trim() === "" || dongiatm.toString().trim() === "" || dongiatts.toString().trim() === ""){
                                    alert("Vui lòng nhập đầy đủ thông tin, Số lượng nhập, đơn giá nhập, đơn giá tiền mặt, đơn giá thanh toán sau và giảm giá phải có giá trị số!");
                                    return false;     
                                }
                                else{
                                    if(giamgia !== ""){
                                        if(giamgia < 0 || giamgia > 100){
                                            alert("Giảm nằm trong khoảng từ 0 đến 100!");
                                            return false;
                                        }
                                    }
                                    else{
                                        giamgia=0;
                                    }

                                    var sln1=slnhap.toString().indexOf(".");
                                    var sln2=slnhap.toString().indexOf(",");
                                    var sln3=slnhap.toString().indexOf("-");
                                    var sln4=slnhap.toString().indexOf("0");
                                    if(sln1 >=0 || sln2 >=0 || sln3 >= 0 || sln4 == 0){
                                        alert("Số lượng nhập phải là số nguyên không âm và phải có giá trị, không bắt đầu với ký tự '0'!");
                                        return false;
                                    }
                                    
                                    var dgn1=dongianhap.toString().indexOf(".");
                                    var dgn2=dongianhap.toString().indexOf(",");
                                    var dgn3=dongianhap.toString().indexOf("-");
                                    var dgn4=dongianhap.toString().indexOf("0");
                                    if(dgn1 >=0 || dgn2 >=0 || dgn3 >= 0 || dgn4 == 0){
                                        alert("Đơn giá nhập phải là số nguyên không âm và phải có giá trị, không bắt đầu với ký tự '0'!");
                                        return false;
                                    }
                                    
                                    var dgtm1=dongiatm.toString().indexOf(".");
                                    var dgtm2=dongiatm.toString().indexOf(",");
                                    var dgtm3=dongiatm.toString().indexOf("-");
                                    var dgtm4=dongiatm.toString().indexOf("0");
                                    if(dgtm1 >=0 || dgtm2 >=0 || dgtm3 >= 0 || dgtm4 == 0){
                                        alert("Đơn giá tiền mặt phải là số nguyên không âm và phải có giá trị, không bắt đầu với ký tự '0'!");
                                        return false;
                                    }
                                    
                                    var dgtts1=dongiatts.toString().indexOf(".");
                                    var dgtts2=dongiatts.toString().indexOf(",");
                                    var dgtts3=dongiatts.toString().indexOf("-");
                                    var dgtts4=dongiatts.toString().indexOf("0");
                                    if(dgtts1 >=0 || dgtts2 >=0 || dgtts3 >= 0 || dgtts4 == 0){
                                        alert("Đơn giá thanh toán sau phải là số nguyên không âm và phải có giá trị, không bắt đầu với ký tự '0'!");
                                        return false;
                                    }
                                    var dgnhap=parseInt(dongianhap,10);
                                    var dgtienmat=parseInt(dongiatm,10);
                                    var dgthanhts=parseInt(dongiatts,10);
                                    if(dgtienmat <= dgnhap || dgthanhts <= dgnhap || dgthanhts <= dgtienmat){
                                        alert("Đơn giá tiền mặt và đơn giá thanh toán sau không được nhỏ hơn đơn giá nhập và đơn giá thanh toán sau không được nhỏ hơn đơn giá tiền mặt!");
                                        return false;
                                    }
                                    if(slnhap < 0 || dongianhap < 0 || dongiatm < 0 || dongiatts < 0 || giamgia < 0){
                                        alert("Số lượng nhập, đơn giá nhập, đơn giá tiền mặt, đơn giá thanh toán sau và giảm giá phải có giá trị lớn hơn hoặc bằng 0!");
                                        return false;
                                    }
                                    else{
                                        var form_data=null;
                                        if($('#anhsp').val() === ""){
                                            anhsp="chuachonanh";
                                        }
                                        else{
                                            //xử lý phần ảnh
                                            //Lấy ra files

                                            var file_data = $('#anhsp').prop('files')[0];
                                            //lấy ra kiểu file
                                            var type = file_data.type;
                                            //Xét kiểu file được upload
                                            var match = ["image/gif", "image/png", "image/jpg", "image/jpeg", "image/svg"];
                                            //kiểm tra kiểu file
                                            if (type == match[0] || type == match[1] || type == match[2] || type == match[3] || type == match[4]) {
                                            //khởi tạo đối tượng form data
                                                form_data = new FormData();
                                                //thêm files vào trong form data
                                                form_data.append('file', file_data);
                                            } else {
                                                alert('Chỉ được upload file ảnh');
                                                $('#anhsp').val('');
                                                return false;
                                            }
                                            anhsp=$('#anhsp').val().toString().split('\\')[2];
                                        }
                                        
                                        //sua
                                        $.ajax({
                                            type: "POST",
                                            url: "proccess.php",
                                            data: {masp: masp, mancu: mancu, tensp: tensp, ngaysx: ngaysx, ngayhh: ngayhh, nhasx: nhasx, ngaynhap: ngaynhap, slnhap: slnhap, dongianhap: dongianhap, dongiatm: dongiatm, dongiatts: dongiatts, giamgia: giamgia, anhsp: anhsp, tt: "sua"},
                                            success: function(data) {
                                                let dt=data;
                                                dt=dt.toString().trim();
//                                                alert(dt);
                                                if(dt!==null){
                                                    if(dt==="tc"){
                                                        if($('#anhsp').val() === ""){
                                                            alert("Sửa thành công!");
                                                            location.replace("../qlsp");
                                                        }
                                                        else{
                                                             $.ajax({
                                                                url: 'proccess.php',
                                                                dataType: 'text',
                                                                cache: false,
                                                                contentType: false,
                                                                processData: false,
                                                                data: form_data,
                                                                type: 'post',
                                                                success: function (data) {
                                                                    let dt=data;
                                                                    dt=dt.toString().trim();
                                                                    if(dt!==null){
                                                                        if(dt!=="null"){
                                                                            if(dt === "tc"){
                                                                                alert("Sửa thành công!");
                                                                                location.replace("../qlsp");
                                                                            }
                                                                            else{
                                                                                alert("Sửa thất bại, không thể up load file ảnh!");
                                                                                return false;
                                                                            }
                                                                        }
                                                                        else{
                                                                            alert("Sửa thất bại, không thể up load file ảnh!");
                                                                            return false;
                                                                        }
                                                                    }
                                                                    else{
                                                                        alert("Sửa thất bại, không thể up load file ảnh!");
                                                                        return false;
                                                                    }
                                                                },
                                                                error: function() {
                                                                    alert("Sửa thất bại, không thể up load file ảnh!");
                                                                    return false;
                                                                }
                                                            });
                                                        }
                                                    }
                                                    else{
                                                        alert("Sửa thất bại, hãy thử lại lần nữa!");
                                                        return false;
                                                    }
                                                }
                                                else{
                                                    alert("Sửa thất bại, hãy thử lại lần nữa!");
                                                    return false;
                                                } 
                                            },
                                            error: function() {
                                                alert("Sửa thất bại,đã có lỗi xảy ra!");
                                                return false;
                                            }
                                        });
                                    }
                                }
                            });

                            //xoá
                            $('#btnxoa').click(function(){
                                let msp=$("#txtmsp").val();
                                if(msp === ""){
                                    alert("Bạn chưa chọn sản phẩm nào!");
                                    return false;
                                }
                                else{
                                    var r=confirm("Bạn có chắc chắn muốn xoá sản phẩm có mã "+ msp+"!");
                                    if(r == true){
                                        $.ajax({
                                            type: "POST",
                                            url: "proccess.php",
                                            data: {masp: msp, tt: "xoa"},
                                            success: function(data) {
                                                let dt=data;
                                                dt=dt.toString().trim();
//                                                alert(dt);
                                                if(dt!==null){
                                                    if(dt==="tc"){
                                                        alert("Xoá thành công!");
                                                        location.replace("../qlsp");
                                                    }
                                                    else{
                                                        alert("Xoá thất bại, hãy thử lại lần nữa!");
                                                        return false;
                                                    }
                                                }
                                                else{
                                                    alert("Xoá thất bại, hãy thử lại lần nữa!");
                                                    return false;
                                                }
                                            },
                                            error: function() {
                                                alert("Xoá thất bại, hãy thử lại lần sau!");
                                                return false;
                                            }
                                        });
                                    }

                                }
                            });

                            $('#btnlammoi').click(function() {
                                    location.replace("../qlsp");
                            });
                        });                    
                    </script>
<?php include '../../View/bottom.php'; ?>
<?php $_REQUEST["child"] = NULL; ?>
        <?php
    }
}else{
       ?>
       <script>
           location.replace("../../");
       </script>
    
    <?php
}
