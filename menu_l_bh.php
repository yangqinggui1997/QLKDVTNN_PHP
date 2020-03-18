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
        
        <li class="active"><a style="cursor: pointer;" id="qt"><span class="glyphicon glyphicon-cog"></span> Khu vực nhân viên bán hàng</a></li>
      <?php 
         $pa=NULL;
         $ch=NULL;
         $dr=NULL;
         $ndqt=NULL;
         
         if(isset($_REQUEST["dter"])){
             $dr=$_REQUEST["dter"];
         }
         if(isset($_REQUEST["par"])){
             $pa = $_REQUEST["par"];
         }
         if(isset($_REQUEST["chi"])){
             $ch=$_REQUEST["chi"];
         }
        if(isset($_REQUEST["ndqt"])){
             $ndqt=$_REQUEST["ndqt"];
         }
        
       if($pa!=NULL){ ?>
      <li><a href="../BanhangArea/qlhdb"><span class="glyphicon glyphicon-user"></span> Quản lý hoá đơn bán</a></li>   
      <li ><a href="../BanhangArea/qlkh"><span class="glyphicon glyphicon-briefcase"></span> Quản lý khách hàng</a></li>
      <?php if($ndqt != NULL){ ?>
      <li ><a href="../AdminArea"><span class="glyphicon glyphicon-backward"></span> Quay về trang quản trị</a></li>
      <?php }?>
      <?php  
      } else if($ch!=NULL){ 
      ?>
      <li><a href="../qlhdb"><span class="glyphicon glyphicon-user"></span> Quản lý hoá đơn bán</a></li>   
      <li><a href="../qlkh"><span class="glyphicon glyphicon-briefcase"></span> Quản lý khách hàng</a></li>
      <?php if($ndqt != NULL){ ?>
      <li ><a href="../../AdminArea"><span class="glyphicon glyphicon-backward"></span> Quay về trang quản trị</a></li>
      <?php }?>
     <?php } else if($dr != NULL){ ?>
      <li><a href="../../qlhdb"><span class="glyphicon glyphicon-user"></span> Quản lý hoá đơn bán</a></li>   
      <li><a href="../../qlkh"><span class="glyphicon glyphicon-briefcase"></span> Quản lý khách hàng</a></li>
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
