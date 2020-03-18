<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<nav class="navbar navbar-inverse visible-xs">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
        <a class="navbar-brand" href="#">
          <h3 style="margin: 0;">          
              <span class="label label-primary">Y</span>
              <span class="label label-warning">A</span>
              <span class="label label-success">N</span>
              <span class="label label-danger">G</span>
            </h3>
      </a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a style="cursor: pointer;" id="qtsmall"><span class="glyphicon glyphicon-cog"></span> Khu vực nhân viên thủ kho</a></li>
       <?php 
         $pa=NULL;
         $ch=NULL;
         $ndqt=NULL;
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
      <li ><a href="../ThukhoArea/qlsp"><span class="glyphicon glyphicon-briefcase"></span> Quản lý sản phẩm</a></li>
      <li ><a href="../ThukhoArea/qlncu"><span class="glyphicon glyphicon-briefcase"></span> Quản lý nhà cung ứng</a></li>
      <?php if($ndqt != NULL){ ?>
      <li ><a href="../AdminArea"><span class="glyphicon glyphicon-backward"></span> Quay về trang quản trị</a></li>
      <?php }?>
       <?php  
      } else if($ch!=NULL){ 
      ?>
      <li><a href="../qlsp"><span class="glyphicon glyphicon-briefcase"></span> Quản lý sản phẩm</a></li>
      <li ><a href="../qlncu"><span class="glyphicon glyphicon-briefcase"></span> Quản lý nhà cung ứng</a></li>
      <?php if($ndqt != NULL){ ?>
      <li ><a href="../../AdminArea"><span class="glyphicon glyphicon-backward"></span> Quay về trang quản trị</a></li>
      <?php }?>
     <?php } ?>
    </ul>
     <script>
        $('#qtsmall').click(function() {
            $('#qt').click();
        });
    </script>
    </div>
  </div>
</nav>
