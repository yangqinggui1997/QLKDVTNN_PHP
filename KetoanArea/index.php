<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
<?php $_REQUEST["parent"] = "parent"; $_REQUEST["ketoanarea"] = "Yang - Trang nhân viên kế toán";
     ?>
<?php $_REQUEST["kococlassnv"] = "kococlassnv";?>
<?php $_REQUEST["kococlassnd"] = "kococlassnd";?>
<?php $_REQUEST["kococlasscommon"] = "kococlasscommon";?>
    <?php include '../View/top.php'; ?>
    <h2>Mời bạn chọn danh mục quản lý!</h2>
    
<?php include '../View/bottom.php'; ?>
<?php $_REQUEST["child"] = NULL; ?>
        <?php
    }
}else{
       ?>
       <script>
           location.replace("../");
       </script>
    
    <?php
}