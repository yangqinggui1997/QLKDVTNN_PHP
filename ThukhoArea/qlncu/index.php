<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    require '../../model/Common/CommonComand.php';
    //dto
    require '../../model/dto/nhacungung.php';
    
    //dao
    require '../../model/dao/nhacungungDAO.php';
    
    //bus
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
<?php $_REQUEST["child"] = "child"; $_REQUEST["qlncu"] = "Yang - Quản lý nhà cung ứng";
     ?>
<?php $_REQUEST["kococlassnv"] = "kococlassnv";?>
<?php $_REQUEST["kococlassnd"] = "kococlassnd";?>
    <?php include '../../View/top.php'; ?>
                    <h2>Quản lý nhà cung ứng</h2><br>
                    <div class="row">
                        <div class="col-sm-3" style="margin-bottom: 40px;">
                             <?php if(substr($manguoidung, 0, 4) == "NDQT"){ ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#fthem" id="btnthem" style=" position: fixed; z-index: 99;" disabled="">
                                <span class="glyphicon glyphicon-plus"></span> Thêm nhà cung ứng
                            </button>
                             <?php }else{ ?>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#fthem" id="btnthem" style=" position: fixed; z-index: 99;">
                                <span class="glyphicon glyphicon-plus"></span> Thêm nhà cung ứng
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
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2" style="margin-bottom: 30px;">
                            <div class="form-group">
                                <label style=" position: fixed; z-index: 99;">Mã nhà cung ứng</label>                                        
                            </div>
                        </div>
                        <div class="col-sm-2" style="margin-bottom: 40px;">
                            <div class="form-group">
                                <input type="text" class="form-control" id="txtmncu" readonly="" style=" position: fixed; z-index: 99; width: 140px;">
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
                                <button class="btn btn-warning" id="btnsua" data-toggle="modal" style=" position: fixed; z-index: 99;" disabled="">Sửa</button>
                                <?php }else { ?>
                                <button class="btn btn-warning" id="btnsua" data-toggle="modal" style=" position: fixed; z-index: 99;">Sửa</button>
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
                        <div class="col-sm-1">
                        </div>
                        <div class="col-sm-1">
                        </div>
                    </div>                       
                    <!-- Danh sách nhà cung ứng -->
                    <br>
                    <table class="table table-hover" id="tblnhacungung">   
                        <tr> 
                            <th hidden=""></th>
                            <th>Tên nhà cung ứng</th>
                            <th>Địa chỉ</th>
                            <th>SĐT</th>                            
                            <th>Email</th>
                            <th>Quy mô</th>
                            <th>Đánh giá</th>
                        </tr>
                        <?php 
                            if(isset($_REQUEST["action"])){ 
                                $ac=$_REQUEST["action"];  
                                $keyse= $_REQUEST["keysearch"];
                                if($keyse != ""){
                                    $dsncu= nhacungungBUS::TKNCU($keyse);
                                    if($dsncu != NULL){
                                        if(is_array($dsncu)){
                                            foreach($dsncu as $ncu){
                                            
                        ?>
                        <tr>
                            <td hidden=""><?php echo $ncu->getIdNCU(); ?></td>
                            <td><?php echo $ncu->getTenNCU(); ?></td>
                            <td><?php echo $ncu->getDiaChi(); ?></td>
                            <td><?php echo $ncu->getSDT(); ?></td>
                            <td><?php echo $ncu->getEmail(); ?></td>
                            <td><?php if(intval($ncu->getQuyMo())== 1){ ?>
                              <?php echo "Tập đoàn"; ?>
                              <?php }else if(intval($ncu->getQuyMo())== 2){ ?>
                              <?php echo "Công ty"; ?>
                              <?php } else if(intval($ncu->getQuyMo())== 3){?>
                              <?php echo "Đại lý cấp 1"; ?>
                              <?php }?>
                            </td>
                            <td><?php echo $ncu->getDanhGia(); ?></td>

                        </tr>
                         <?php }}else{ ?>
                        <!--không làm gì cả do phát sinh lỗi-->
                                            <?php }}else{ ?>
                        <!--không làm gì cả do không tìm thấy kế quả-->
                                    <?php }}else{
                                       $dsncu= nhacungungBUS::getDSNCU();
                                    if($dsncu != NULL){
                                        if(is_array($dsncu)){
                                            foreach($dsncu as $ncu){
                                    ?>
                        <tr>
                            <td hidden=""><?php echo $ncu->getIdNCU(); ?></td>
                            <td><?php echo $ncu->getTenNCU(); ?></td>
                            <td><?php echo $ncu->getDiaChi(); ?></td>
                            <td><?php echo $ncu->getSDT(); ?></td>
                            <td><?php echo $ncu->getEmail(); ?></td>
                            <td><?php if(intval($ncu->getQuyMo())== 1){ ?>
                              <?php echo "Tập đoàn"; ?>
                              <?php }else if(intval($ncu->getQuyMo())== 2){ ?>
                              <?php echo "Công ty"; ?>
                              <?php } else if(intval($ncu->getQuyMo())== 3){?>
                              <?php echo "Đại lý cấp 1"; ?>
                              <?php }?>
                            </td>
                            <td><?php echo $ncu->getDanhGia(); ?></td>
                        </tr>
                        <?php } ?>
                        <script type="text/javascript">
                            alert("Bạn chưa nhập thông tin tìm kiếm!");
                        </script>    
                        <?php }}}} else{
                                          $dsncu= nhacungungBUS::getDSNCU();
                                    if($dsncu != NULL){
                                        if(is_array($dsncu)){
                                            foreach($dsncu as $ncu){
                                    ?>
                        <tr>   
                            <td hidden=""><?php echo $ncu->getIdNCU(); ?></td>
                            <td><?php echo $ncu->getTenNCU(); ?></td>
                            <td><?php echo $ncu->getDiaChi(); ?></td>
                            <td><?php echo $ncu->getSDT(); ?></td>
                            <td><?php echo $ncu->getEmail(); ?></td>
                            <td><?php if(intval($ncu->getQuyMo())== 1){ ?>
                              <?php echo "Tập đoàn"; ?>
                              <?php }else if(intval($ncu->getQuyMo())== 2){ ?>
                              <?php echo "Công ty"; ?>
                              <?php } else if(intval($ncu->getQuyMo())== 3){?>
                              <?php echo "Đại lý cấp 1"; ?>
                              <?php }?>
                            </td>
                            <td><?php echo $ncu->getDanhGia(); ?></td>  
                        </tr>
                         <?php }}}} ?>   
                    </table>
                    <!-- Hộp modal chứa form thêm mới -->
                    <div class="modal fade" id="fthem" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center" id="modaltt">Thêm nhà cung ứng</h4>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label>Tên nhà cung ứng</label>
                                        <input type="text" class="form-control" id="tenncu" placeholder="Tên nhà cung ứng" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Địa chỉ</label>
                                        <input type="text" class="form-control" id="diachi" placeholder="Địa chỉ" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Số điện thoại</label>
                                        <input type="number" class="form-control" id="sdt" placeholder="Số điện thoại" required="">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label>Quy mô</label>
                                        <select class="form-control" id="quymo">
                                            <option value="1" selected="">Tập đoàn</option>
                                            <option value="2" >Công ty</option>
                                            <option value="3" >Đại lý cấp 1</option>
                                        </select>
                                    </div>                                    
                                    <div class="form-group">
                                        <label>Đánh giá</label>
                                        <input type="text" class="form-control" id="danhgia" placeholder="Đánh giá" required="">
                                    </div>                                  
                                </form>          
                            </div>
                            <div class="modal-footer">
                                <div class="form-group align-content-center">
                                    <button class="btn btn-primary hidden" id="nutthem">Thêm</button>
                                    <button class="btn btn-primary hidden" id="nutsua">Sửa</button>
                                </div>
                            </div>

                            </div>
                        </div>
                    </div>
                    <script >
                        function ktemail(){
                            var s = $('#email').val();
                            var acarr=s.toString().split('@');
                            var acong = s.indexOf('@');
                            var daucham = s.lastIndexOf('.');
                            var khoangtrang = s.indexOf(' ');
                            if ((acong < 1) || (daucham < 1) || (acarr.length > 2)||
                                (daucham == acong+1) || (daucham < acong)||
                                (daucham == s.length-1) || 
                                (khoangtrang != -1)){
                                return false;
                            }
                            else{
                                return true;
                            }
                            
                        };
                        
                        //thêm
                        $('#btnthem').click(function (){
                            $("#modaltt").text("Thêm nhà cung ứng");
                            $("#txtmncu").val("");
                            
                            $('#tenncu').val("");
                            $('#quymo').val(1);
                            $('#sdt').val("");
                            $('#diachi').val("");
                            $('#email').val("");
                            $('#danhgia').val("");
                            
                            $('#nutsua').removeClass('hidden');
                            $('#nutsua').addClass('hidden');
                            $('#nutthem').removeClass('hidden');
                        });

                        $('#nutthem').click(function() {
                            var tenncu= $('#tenncu').val();
                            var sdt=$('#sdt').val();
                            var email= $('#email').val();
                            var diachi=$('#diachi').val(); 
                            var danhgia=$('#danhgia').val(); 
                            if(tenncu ==="" || email === "" || sdt === "" || diachi === ""){
                                alert("Vui lòng nhập đầy đủ thông tin!");
                                return false;
                            }
                            else{
                                if(sdt.length < 10 || sdt.length > 11){
                                    alert("Số Số điện thoại phải có 10 hoặc 11 chữ số!");
                                    return false;
                                }
                                else if(!ktemail()){
                                    alert('Email không hợp lệ!');
                                    return false;
                                }
                                else{
                                    $.ajax({
                                        type: "POST",
                                        url: "proccess.php",
                                        data: {tenncu: tenncu, email: email, sdt: sdt, diachi: diachi, quymo: $('#quymo').val(), danhgia: danhgia, tt: "them"},
                                        success: function(data) {
                                            let dt=data;
                                            dt=dt.toString().trim();
                                            if(dt!==null){
                                                if(dt==="tc"){
                                                    alert("Thêm thành công!");
                                                    location.replace("../qlncu");
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
                                            alert("Thêm thất bại, hãy thử lại lần nữa!");
                                            return false;
                                        }
                                    });
                                }
                            }
                        });
                        
                        let ktncu="";
                        //lấy nhà cung ứng phục vụ sửa xoá
                        $("#tblnhacungung").find("tr").find("td").click(function(){
                           var listOfCell=$(this).siblings(); //biến kết quả trả về thành mảng chứa nội dung trong các ô (giá trị index tương ứng với số cột)
                           $("#tblnhacungung").find("tr").find("td").css({'background-color':'#fff'});
                           $(listOfCell[1]).css({"background-color":"lightgray"});
                           $(listOfCell[2]).css({"background-color":"lightgray"});
                           $(listOfCell[3]).css({"background-color":"lightgray"});
                           $(listOfCell[4]).css({"background-color":"lightgray"});
                           $(listOfCell[5]).css({"background-color":"lightgray"});
                           $(listOfCell[6]).css({"background-color":"lightgray"});
                           $(this).css({"background-color":"lightgray"});
                           $("#txtmncu").val($(listOfCell[0]).text());
                           ktncu=""; //khởi tạo flag kiểm tra.
                           $('#btnsua').removeAttr("data-target");
                           //kiểm tra mã ncu trước khi sửa hoặc xoá
                           $.ajax({
                                type: "POST",
                                url: "proccess.php",
                                data: {mncu: $("#txtmncu").val()},
                                success: function(data) {
                                    let dt=data;
                                    dt=dt.toString().trim();
                                    if(dt!==null){
                                        if(dt === "tc"){
                                            ktncu=dt;
                                            $('#btnsua').attr({"data-target":"#fthem"});
                                        }
                                        else{
                                            ktncu="tb";
                                        }
                                    }
                                    else{
                                        ktncu="tb";
                                    } 
                                },
                                error: function() {
                                    ktncu="tb";
                                }
                            });
                        });

                        //sửa
                        $('#btnsua').click(function() {
                            let mncu=$("#txtmncu").val();
                            if(mncu === ""){
                                alert("Bạn chưa chọn nhà cung ứng nào!");
                                return false;
                            }else{
                                if(ktncu === "tc"){
                                    $("#modaltt").text("Sửa nhà cung ứng");
                                    $.ajax({
                                        type: "POST",
                                        url: "proccess.php",
                                        data: {idncu: $('#txtmncu').val()},
                                        success: function(data) {
                                            let dt=data;
                                            dt=dt.toString().trim();
                                            let dtarr= dt.split('|');
                                            $('#tenncu').val(dtarr[0]);
                                            $('#diachi').val(dtarr[1]);
                                            $('#sdt').val(dtarr[2]);
                                            $('#email').val(dtarr[3]);
                                            $('#quymo').val(dtarr[4]);
                                            $('#danhgia').val(dtarr[5]);
                                        }
                                    });
                                    $('#nutthem').removeClass('hidden');
                                    $('#nutthem').addClass('hidden');
                                    $('#nutsua').removeClass('hidden');
                                }
                                else{
                                    alert("Nhà cung ứng không tồn tại!");
                                    return false;
                                }
                            }  
                        });
                        
                        $('#nutsua').click(function() {
                            var tenncu= $('#tenncu').val();
                            var sdt=$('#sdt').val();
                            var email= $('#email').val();
                            var diachi=$('#diachi').val(); 
                            var danhgia=$('#danhgia').val(); 
                            if(tenncu ==="" || email === "" || sdt === "" || diachi === ""){
                                alert("Vui lòng nhập đầy đủ thông tin!");
                                return false;
                            }
                            else{
                                if(sdt.length < 10 || sdt.length > 11){
                                    alert("Số Số điện thoại phải có 10 hoặc 11 chữ số!");
                                    return false;
                                }
                                else if(!ktemail()){
                                    alert('Email không hợp lệ!');
                                    return false;
                                }
                                else{
                                    $.ajax({
                                        type: "POST",
                                        url: "proccess.php",
                                        data: {mancu: $('#txtmncu').val(), tenncu: tenncu, email: email, sdt: sdt, diachi: diachi, quymo: $('#quymo').val(), danhgia: danhgia, tt: "sua"},
                                        success: function(data) {   
                                            let dt=data;
                                            dt=dt.toString().trim();
                                            if(dt !== null){
                                                if(dt==="tc"){
                                                    alert("Sửa thành công!");
                                                    location.replace("../qlncu");
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
                                            alert("Sửa thất bại, hãy thử lại lần nữa!");
                                            return false;
                                        }
                                    });
                                }
                            }
                        });
                        
                        //xoá
                        $('#btnxoa').click(function(){
                            let mncu=$("#txtmncu").val();
                            if(mncu === ""){
                                alert("Bạn chưa chọn nhà cung ứng nào!");
                                return false;
                            }
                            else{
                                var r=confirm("Bạn có chắc chắn muốn xoá nhà cung ứng có mã "+ mncu+"!");
                                if(r == true){
                                    $.ajax({
                                        type: "POST",
                                        url: "proccess.php",
                                        data: {mancu: mncu, tt: "xoa"},
                                        success: function(data) {
                                            let dt=data;
                                            dt=dt.toString().trim();
                                            if(dt!==null){
                                                if(dt==="tc"){
                                                    alert("Xoá thành công!");
                                                    location.replace("../qlncu");
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
                                location.replace("../qlncu");
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
