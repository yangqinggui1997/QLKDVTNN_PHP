
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php  
            //hiển thị cho quản trị viên
            $par=NULL;
            $chi=NULL;
            $dter=NULL;
            if(isset($_REQUEST["parent"])){
                $par=$_REQUEST["parent"];
            }
            if(isset($_REQUEST["child"])){
                $chi=$_REQUEST["child"];
            }
            if(isset($_REQUEST["daughter"])){
                //hiển thị cho nhan vien kế toán
                $dter=$_REQUEST["daughter"];
            }
            if($par!=NULL){ $_REQUEST["par"] = "par"; ?>
        <link rel="shortcut icon" href="../images/favicon.png">
        
        <?php $adminarea=NULL;
        if(isset($_REQUEST["adminarea"])){
            $adminarea= $_REQUEST["adminarea"];
        }
        if($adminarea !=NULL){ ?>
        <title><?php echo $adminarea; ?></title>
        <?php $_REQUEST["adminarea"]=NULL; } ?>

        <?php 
        $banhangarea=NULL;
        if(isset($_REQUEST["banhangarea"])){
            $banhangarea= $_REQUEST["banhangarea"];
        }
        if($banhangarea !=NULL){ ?>
        <title><?php echo $banhangarea ?></title>
        <?php $_REQUEST["banhangarea"] = NULL;} ?>
        
        <?php 
        $ketoanarea=NULL;
        if(isset($_REQUEST["ketoanarea"])){
            $ketoanarea= $_REQUEST["ketoanarea"];
        }
        
        if($ketoanarea !=NULL){ ?>
        <title><?php echo $ketoanarea ?></title>
        <?php $_REQUEST["ketoanarea"] = NULL;} ?>

        <?php 
        $thukhoarea=NULL;
        if(isset($_REQUEST["thukhoarea"])){
            $thukhoarea= $_REQUEST["thukhoarea"];
        }
        
        if($thukhoarea !=NULL){ ?>
        <title><?php echo $thukhoarea; ?></title>
        <?php $_REQUEST["thukhoarea"] = NULL;} ?>

        <script src="../js/moment.js"></script>
        <script src="../js/jquery-3.3.1.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link href="../css/bootstrap-datetimepicker.css" rel="stylesheet"/>
    </head>
    <body id="body"> 
        <?php if($adminarea != NULL){ 
        include '../menu_s_admin.php'; ?>
        <div class="container-fluid">
            <div class="row content">
                <?php include '../menu_l_admin.php';?>
                <br>
                <div class="col-sm-9">
                    <div class="container-fluid">
                        <?php } ?>
                        
        <?php if($thukhoarea != NULL){ ?>
        <?php include '../menu_s_tk.php'; ?>
        <div class="container-fluid">
            <div class="row content">
                <?php include '../menu_l_tk.php'; ?>
                <br>
                <div class="col-sm-9">
                    <div class="container-fluid">
                        <?php } ?>
                        
        <?php if($banhangarea != NULL){ ?>
        <?php include '../menu_s_bh.php'; ?> 
        <div class="container-fluid">
            <div class="row content">
                <?php include '../menu_l_bh.php'; ?>
                <br>
                <div class="col-sm-9">
                    <div class="container-fluid">
                        <?php } ?>
                        
        <?php if($ketoanarea != NULL){ ?>
        <?php include '../menu_s_kt.php'; ?>
        <div class="container-fluid">
            <div class="row content">
                <?php include '../menu_l_kt.php'; ?>
                <br>
                <div class="col-sm-9">
                    <div class="container-fluid">
                        <?php } ?>
                        <!-- Nhúng phần menu người dùng --> 
                        <?php include '../menunguoidung.php'; ?>
                    </div>
                    <?php  $_REQUEST["par"] = NULL; 
                    } else if($chi != NULL) { $_REQUEST["chi"] = "chi"; ?>
                    
        <link rel="shortcut icon" href="../../images/favicon.png">
        
        <?php 
        $qlnv=NULL;
        if(isset($_REQUEST["qlnv"])){
            $qlnv= $_REQUEST["qlnv"];
        }
        
        if($qlnv !=NULL){ ?>
        <title><?php echo $qlnv; ?></title>
        <?php $_REQUEST["qlnv"] = NULL;} ?>
        
        <?php 
        $qlnd=NULL;
        if(isset($_REQUEST["qlnd"])){
             $qlnd= $_REQUEST["qlnd"];
        }
       
        if($qlnd !=NULL){ ?>
        <title><?php echo $qlnd; ?></title>
        <?php $_REQUEST["qlnd"] = NULL;} ?>

        <?php 
        $qlkh=NULL;
        if(isset($_REQUEST["qlkh"])){
            $qlkh= $_REQUEST["qlkh"];
        }
        
        if($qlkh !=NULL){ ?>
        <title><?php echo $qlkh; ?></title>
        <?php $_REQUEST["qlkh"] = NULL;} ?>
        
        <?php 
        $qlhdb=NULL;
        if(isset($_REQUEST["qlhdb"])){
            $qlhdb= $_REQUEST["qlhdb"];
        }
        
        if($qlhdb !=NULL){ ?>
        <title><?php echo $qlhdb; ?></title>
        <?php $_REQUEST["qlhdb"] = NULL;} ?>

        <?php 
        $qlncu=NULL;
        if(isset($_REQUEST["qlncu"])){
            $qlncu= $_REQUEST["qlncu"];
        }
        
        if($qlncu !=NULL){ ?>
        <title><?php echo $qlncu; ?></title>
        <?php $_REQUEST["qlncu"] = NULL;} ?>
        
        <?php 
        $qlsp=NULL;
        if(isset($_REQUEST["qlsp"])){
            $qlsp= $_REQUEST["qlsp"];
        }
        
        if($qlsp !=NULL){ ?>
        <title><?php echo $qlsp; ?></title>
        <?php $_REQUEST["qlsp"] = NULL;} ?>
        
        <script src="../../js/moment.js"></script>
        <script src="../../js/jquery-3.3.1.js"></script>
        <script src="../../js/bootstrap.js"></script>
        <script src="../../js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="../../css/bootstrap.css">
        <link href="../../css/bootstrap-datetimepicker.css" rel="stylesheet"/>
       
    </head>
    <body> 
        <?php if($qlnd != NULL || $qlnv != NULL){ ?>
        <?php include '../../menu_s_admin.php'; ?>
        <div class="container-fluid">
            <div class="row content">
                <?php include '../../menu_l_admin.php'; ?>
                <br>
                <div class="col-sm-9">
                    <div class="container-fluid">
                        <!-- Nhúng phần menu người dùng -->    
                        <?php } ?>
        
        <?php if($qlkh != NULL || $qlhdb != NULL){ ?>
        <?php include '../../menu_s_bh.php'; ?>                
        <div class="container-fluid">
            <div class="row content">
                <?php include '../../menu_l_bh.php'; ?> 
                <br>
                <div class="col-sm-9">
                    <div class="container-fluid">
                        <!-- Nhúng phần menu người dùng -->    
                        <?php } ?>
                        
        <?php if($qlncu != NULL || $qlsp != NULL){ ?>
        <?php include '../../menu_s_tk.php'; ?>          
        <div class="container-fluid">
            <div class="row content">
                <?php include '../../menu_l_tk.php'; ?>
                <br>
                <div class="col-sm-9">
                    <div class="container-fluid">
                        <!-- Nhúng phần menu người dùng -->    
                        <?php } ?>
                        <?php include '../../menunguoidung.php'; ?>
                    </div>
                    <?php $_REQUEST["child"] = NULL;
                       } else if($dter != NULL) { $_REQUEST["dter"] = "dter"; ?>
        <link rel="shortcut icon" href="../../../images/favicon.png">
        
        <?php 
        $tkht=NULL;
        if(isset($_REQUEST["tkht"])){
            $tkht= $_REQUEST["tkht"];
        }
        
        if($tkht !=NULL){ ?>
        <title><?php echo $tkht; ?></title>
        <?php $_REQUEST["tkht"] = NULL ;} ?>
        
        <?php 
        $tkspb=NULL;
        if(isset($_REQUEST["tkspb"])){
            $tkspb= $_REQUEST["tkspb"];
        }
        
        if($tkspb !=NULL){ ?>
        <title><?php echo $tkspb; ?></title>
        <?php $_REQUEST["tkspb"] = NULL;} ?>
        
        <?php
        $inhdb=NULL;
        if(isset($_REQUEST["inhdb"])){
            $inhdb= $_REQUEST["inhdb"];
        }
        
        if($inhdb !=NULL){ ?>
        <title><?php echo $inhdb; ?></title>
        <?php $_REQUEST["inhdb"] = NULL ;} ?>
        
        <script src="../../../js/moment.js"></script>
        <script src="../../../js/jquery-3.3.1.js"></script>
        <script src="../../../js/bootstrap.js"></script>
        <script src="../../../js/bootstrap-datetimepicker.js"></script>
        <link rel="stylesheet" href="../../../css/bootstrap.css">
        <link href="../../../css/bootstrap-datetimepicker.css" rel="stylesheet"/>
        
     
    </head>
    <body> 
        <?php if($tkht != NULL || $tkspb != NULL){ ?>
        <?php include '../../../menu_s_kt.php'; ?>
        <div class="container-fluid">
            <div class="row content">
                <?php include '../../../menu_l_kt.php'; ?>
                <br>
                <div class="col-sm-9">
                    <div class="container-fluid">
                        <!-- Nhúng phần menu người dùng -->    
                        <?php include '../../../menunguoidung.php'; ?>
                    </div>
        <?php }else if($inhdb != NULL){ ?>
            <?php include '../../../menu_s_bh.php'; ?>
        <div class="container-fluid">
            <div class="row content">
                <?php include '../../../menu_l_bh.php'; ?>
                <br>
                <div class="col-sm-9">
                    <div class="container-fluid">
                        <!-- Nhúng phần menu người dùng -->    
                        <?php include '../../../menunguoidung.php'; ?>
                    </div>
                       <?php } $_REQUEST["daughter"] = NULL; } 
        
