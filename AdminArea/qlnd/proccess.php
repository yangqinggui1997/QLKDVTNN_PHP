
<?php
    require '../../model/Common/CommonComand.php';
    //dto
    require '../../model/dto/nguoidung.php';
    
    //dao
    require '../../model/dao/nguoidungDAO.php';
    
    //bus
    require '../../model/bus/nguoidungBUS.php';
    
?>


<?php  
    //Kiểm tra người dùng có tồn tại không
    if(isset($_REQUEST["mnd"])){
        $mnd=$_REQUEST["mnd"];
        $nd= nguoidungBUS::getND($mnd);
        if($nd != NULL){
            if($nd->getIdND() != NULL){
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

    //lấy thông tin người dùng
    $mand=NULL;
    if(isset($_REQUEST["mand"])){
        $mand=$_REQUEST["mand"];
    }
    
    $loaind=NULL;
    if(isset($_REQUEST["loaind"])){
        $loaind=$_REQUEST["loaind"];
    }
    
    $loaitt=NULL;
    if(isset($_REQUEST["loaitt"])){
        $loaitt=$_REQUEST["loaitt"];
    }
    
    $tt=NULL;
    if(isset($_REQUEST["tt"])){
        $tt=$_REQUEST["tt"];
    }
    
    $htd=NULL;
    if(isset($_REQUEST["htd"])){
        $htd=$_REQUEST["htd"];
    }
    $mk=NULL;
    if(isset($_REQUEST["mk"])){
        $mk=$_REQUEST["mk"];
    }
    
    if($tt != NULL){
        if($tt=="sua"){//sửa
            if($mand != NULL && $loaind != NULL && $loaitt != NULL){
                
                if($htd == NULL){
                    $nd= nguoidungBUS::getND($mand);
                    if($nd != NULL){
                        if($nd->getIdND() != NULL){
                           $m=$nd->getIdND();
                           $lnd=$nd->getLoaiND();
                           $ltt=$nd->getTrangThai();
                            if($lnd == $loaind){
                                if(intval($loaitt) == 2){
                                    if(intval($ltt) == 1 || intval($ltt) == 2){
                                        //ko
                                        echo "kodoi|kodoi|kodoi";
                                    }
                                    else{
                                        //doi tt
                                        echo "doi|kodoi|doi";
                                    }
                                }
                                else if(intval($loaitt) == 0){
                                    if(intval($ltt) == 0){
                                        //kodoi
                                        echo "kodoi|kodoi|kodoi";
                                    }
                                    else{
                                        //doi
                                        echo "doi|kodoi|doi";
                                    }
                                }

                            }
                            else
                            {
                                if(intval($loaitt) == 2){
                                    if(intval($ltt) == 1 || intval($ltt) == 2){
                                        //ko
                                        echo "doi|doi|kodoi";
                                    }
                                    else{
                                        //doi tt
                                        echo "doi|doi|doi";
                                    }
                                }
                                else if(intval($loaitt) == 0){
                                    if(intval($ltt) == 0){
                                        //kodoi
                                        echo "doi|doi|kodoi";
                                    }
                                    else{
                                        //doi
                                       echo "doi|doi|doi";
                                    }
                                }
                            }
                        }
                        else{
                            echo "loi|loi|loi";
                        }
                         
                    }
                    else{
                        echo "kott|kott|kott";
                    }
                   
                }
                else {
                    if($htd=="doi|doi"){
                        $cnkhoa=nguoidungBUS::CapnhatKhoaTK($mand, $loaitt);
                        $cnnnd=nguoidungBUS::CapnhatNhomND($mand, $loaind);
                        if($cnnnd == TRUE && $cnkhoa === TRUE){
                           echo "tc"; 
                        }
                        else{
                            echo "tb";
                        }

                    }
                    else if($htd=="doi|kodoi"){
                        $cnnnd=nguoidungBUS::CapnhatNhomND($mand, $loaind);
                        if($cnnnd == TRUE){
                           echo "tc"; 
                        }
                        else{
                            echo "tb";
                        }
                    }
                    else if($htd=="kodoi|doi"){
                        $cnkhoa=nguoidungBUS::CapnhatKhoaTK($mand, $loaitt);
                        if($cnkhoa === TRUE){
                           echo "tc"; 
                        }
                        else{
                            echo "tb";
                        }

                    }
                }
            }
                
        }
        else if($tt=="xoa"){
            if($mand != NULL){
                $nd= nguoidungBUS::getND($mand);
                if($nd != NULL){
                    if($nd->getTrangThai() != NULL){
                        $trangthai=$nd->getTrangThai();
                        if(intval($trangthai) == 1){
                            echo "ndonline";
                        }
                        else{
                            if(substr($mand, 0, 4) == "NDQT"){
                                echo "xoaqt";
                            }
                            else{
                                $xoand=nguoidungBUS::XoaND($mand);
                                if($xoand === TRUE){
                                    echo "tc";
                                }
                                else{
                                    echo "tb";
                                }
                            }

                        }
                    }
                    else{
                        echo "tb";
                    }
                }
                else{
                    echo "tb";
                }

            }
            else{
                echo "tb";
            }
            
        }
            
    }
