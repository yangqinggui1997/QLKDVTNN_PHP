<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<div class="col-sm-3 sidenav hidden-xs">
    <h3 style="margin-left: 80px">          
      <span class="label label-primary">Y</span>
      <span class="label label-warning">A</span>
      <span class="label label-success">N</span>
      <span class="label label-danger">G</span>
    </h3><br>
    <ul class="nav nav-pills nav-stacked">
        
        <li class="active"><a style="cursor: pointer;" id="qt"><span class="glyphicon glyphicon-cog"></span> Khu vực quản trị</a></li>
      <?php  $pa=NULL;
         $ch=NULL;
         
         if(isset($_REQUEST["par"])){
             $pa = $_REQUEST["par"];
         }
         if(isset($_REQUEST["chi"])){
             $ch=$_REQUEST["chi"];
         }
            if($pa!=NULL){ ?>
      <li><a href="../AdminArea/qlnd"><span class="glyphicon glyphicon-user"></span> Quản lý người dùng</a></li>   
      <li ><a href="../AdminArea/qlnv"><span class="glyphicon glyphicon-briefcase"></span> Quản lý nhân viên</a></li>
      <li ><a href="../BanhangArea/qlkh"><span class="glyphicon glyphicon-briefcase"></span> Quản lý khách hàng</a></li>
        <li ><a href="../ThukhoArea/qlncu"><span class="glyphicon glyphicon-briefcase"></span> Quản lý nhà cung ứng</a></li>
       <li ><a href="../ThukhoArea/qlsp"><span class="glyphicon glyphicon-briefcase"></span> Quản lý sản phẩm</a></li>
      
      <li><a href="../BanhangArea/qlhdb"><span class="glyphicon glyphicon-user"></span> Quản lý hoá đơn bán</a></li> 
      <li><a href="../KetoanArea/tkbc/tkht"><span class="glyphicon glyphicon-user"></span> Thống kê hàng tồn</a></li>   
      <li ><a href="../KetoanArea/tkbc/tkspb"><span class="glyphicon glyphicon-briefcase"></span> Thống kê sản phẩm bán</a></li>
      <?php  
      } else if($ch!=NULL){ 
      ?>
      <li><a href="../qlnd"><span class="glyphicon glyphicon-user"></span> Quản lý người dùng</a></li>   
      <li><a href="../qlnv"><span class="glyphicon glyphicon-briefcase"></span> Quản lý nhân viên</a></li>
     <?php }?>
    </ul><br>
      <script>
        $('#qt').click(function() {
            if(window.location.pathname.toString().split('/').length === 4){
                location.replace('');
            }
            else if(window.location.pathname.toString().split('/').length === 5){

                location.replace('../');
            }
        });
    </script>        
</div>
