<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home | Cửa hàng vật tư nông nghiệp Yang</title>
        <link rel="shortcut icon" href="images/favicon.png">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        
    </head>
    <body onload="load()" id="mainboard">
        <div id="loader"></div>
        <div style="visibility: hidden;" id="home1">
            <div class="wrapper">
                <div class="container">
                    <div class="row">                  
                        <div class="col-sm-4 col-md-4 central hidden" id="frmdn">
                            <div class="panel panel-primary">
                                <div class="panel-heading"><h3 class="text-center">Chào mừng đến với Yang!</h3></div>
                                <div class="panel-body">
                                    <form id="dn">
                                        <div class="form-group">
                                            <input class="form-control"  type="text" 
                                                id="txtuser" placeholder="Tên tài khoản" required="">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control"  type="password" 
                                                id="txtpass" placeholder="Mật khẩu" required="">
                                        </div>

                                    </form>
                                    <div class="row">
                                        <div class="col-sm-2">

                                        </div>
                                        <div class="col-sm-3" >
                                            <button class="btn btn-primary" id="btnsi" style="margin-bottom: 10px;">Đăng nhập</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <label  style=" margin-left: 15px; margin-top: 10px; margin-bottom: 20px;">Hoặc</label>
                                        </div>
                                        <div class="col-sm-3" >
                                            <button class="btn btn-success" id="btnrg" >Đăng ký</button>
                                        </div>
                                        <div class="col-sm-2">

                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 col-md-4 central hidden" id="frmdk">
                            <div class="panel panel-primary ">
                                <div class="panel-heading"><h3 class="text-center">Đăng ký tài khoản</h3></div>
                                <div class="panel-body">
                                    <form id="dk">
                                        <div class="form-group">
                                            <input class="form-control"  type="text" 
                                                id="txtmanv" placeholder="Mã nhân viên" required>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control"  type="text" 
                                                   id="txttendn" placeholder="Tên đăng nhập" required disabled="">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control"  type="password" 
                                                   id="txtmk" placeholder="Mật khẩu" required disabled="">
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control"  type="password" 
                                                   id="txtnlmk" placeholder="Nhập lại mật khẩu" required disabled="">
                                        </div>                                        
                                        
                                    </form>
                                    <div class="row">
                                        <div class="col-sm-2">

                                        </div>
                                        <div class="col-sm-3" >
                                            <button class="btn btn-primary" id="btndk" style="margin-bottom: 10px;">Đăng ký</button>
                                        </div>
                                        <div class="col-sm-2">
                                            <label  style=" margin-left: 5px; margin-top: 10px; margin-bottom: 20px;">Hoặc</label>
                                        </div>
                                        <div class="col-sm-3" >
                                            <a class="btn btn-success" id="btnthoat">Thoát</a>
                                        </div>
                                        <div class="col-sm-2">

                                        </div>
                                    </div>	
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div> 
        </div>
        <script src="js/jquery-3.3.1.js"></script>
        <script src="js/bootstrap.js"></script>
        <script> 
            function load() {
                setTimeout(function(){$('#loader').remove();},1000);
                setTimeout(function(){
                    $('body').attr({'id':'home'}); 
                    setTimeout(function(){$('#home1').css({'visibility':'visible'});
                    }, 300);
                    setTimeout(function(){
                        $('#frmdn').removeClass('hidden');             
                    }, 300);
                },
                1100);
            }

            $('#btnsi').click(function() {
                if($('#txtuser').val()==="" || $('#txtpass').val() ===""){
                    alert('Vui lòng nhập đầy đủ thông tin!');
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "proccess.php",
                        data: {username:  $('#txtuser').val(), pass: $('#txtpass').val()},
                        success: function(data) {
                            let dt=data;
                            dt=dt.toString().trim();
                            if(dt.toString().trim() === "bikhoa"){
                                alert("Tài khoản của bạn đã bị khoá, vui lòng đăng nhập sau!");
                                return false;
                            }
                            else if(dt.toString().trim() === "NULL"){
                                alert("Đăng nhập thất bại, vui lòng kiểm tra thông tin đăng nhập hoặc tình trạng kết nối mạng!");
                                return false;
                            }
                            else{
                                let dtarr= dt.toString().split('|');
                                if(dtarr.length > 1){
                                    let mand=dtarr[0].toString().trim(), tennd = dtarr[1].toString().trim();
                                    if(mand !== "null" || tennd !== "null"){
                                        alert("Đăng nhập thành công!");                                   

                                        if(mand.toString().substring(0,4)==="NDQT"){  
                                            location.replace("AdminArea");                     
                                        }
                                        if(mand.toString().substring(0,4)==="NDKT"){
                                            location.replace("KetoanArea");
                                        }
                                        if(mand.toString().substring(0,4)==="NDBH"){
                                            location.replace("BanhangArea");
                                        }
                                        if(mand.toString().substring(0,4)==="NDTK"){
                                            location.replace("ThukhoArea");
                                        }
                                        
                                    }
                                    else{
                                        alert("Đăng nhập thất bại, vui lòng kiểm tra thông tin đăng nhập hoặc tình trạng kết nối mạng!");
                                        return false;
                                    }

                                }
                                else{
                                    alert("Đăng nhập thất bại, vui lòng kiểm tra thông tin đăng nhập hoặc tình trạng kết nối mạng!");
                                    return false;
                                }

                            }  
                        },
                        error: function() {
                            alert("Đăng nhập thất bại, vui lòng kiểm tra thông tin đăng nhập hoặc tình trạng kết nối mạng!");
                            return false;
                        }

                    });
                }
            });
            $('#btnrg').click(function() {
                $('#frmdn').removeClass('hidden');
                $('#frmdn').addClass('hidden');
                $('#frmdk').removeClass('hidden');

            });

            const $manvchange = document.querySelector('#txtmanv');
            const typeHandler = function() {
                if($('#txtmanv').val().toString().trim() === ""){
                    $('#txtmanv').css({"border": "1px solid", "border-color":"#66afe9"});
                    $('#txttendn').val("");
                    $('#txtmk').val("");
                    $('#txtnlmk').val("");
                    $('#txttendn').removeAttr("disabled");
                    $('#txtmk').removeAttr("disabled");
                    $('#txtnlmk').removeAttr("disabled");
                    $('#txttendn').attr({"disabled":""});
                    $('#txtmk').attr({"disabled":""});
                    $('#txtnlmk').attr({"disabled":""});
                }
                else{
                    $.ajax({
                        type: "POST",
                        url: "proccess.php",
                        data: {manv:  $('#txtmanv').val(), hd: "ktmanv"},
                        success: function(data) {
                            let dt=data;
                            dt= dt.toString().trim();
                            if(dt !== null){
                                if(dt === "tc"){
                                    $('#txtmanv').css({"border": "1px solid", "border-color":"#66afe9"});
                                    $('#txttendn').removeAttr("disabled");
                                    $('#txtmk').removeAttr("disabled");
                                    $('#txtnlmk').removeAttr("disabled");
                                }
                                else{
                                    $('#txtmanv').css({"border": "1px solid", "border-color":"#ff0000"});
                                    $('#txttendn').val("");
                                    $('#txtmk').val("");
                                    $('#txtnlmk').val("");
                                    $('#txttendn').removeAttr("disabled");
                                    $('#txtmk').removeAttr("disabled");
                                    $('#txtnlmk').removeAttr("disabled");
                                    $('#txttendn').attr({"disabled":""});
                                    $('#txtmk').attr({"disabled":""});
                                    $('#txtnlmk').attr({"disabled":""});
                                }
                            }
                            else{
                                $('#txtmanv').css({"border": "1px solid", "border-color":"red"});
                                $('#txttendn').val("");
                                $('#txtmk').val("");
                                $('#txtnlmk').val("");
                                $('#txttendn').removeAttr("disabled");
                                $('#txtmk').removeAttr("disabled");
                                $('#txtnlmk').removeAttr("disabled");
                                $('#txttendn').attr({"disabled":""});
                                $('#txtmk').attr({"disabled":""});
                                $('#txtnlmk').attr({"disabled":""});
                            }
                        },
                        error: function() {
                            $('#txtmanv').css({"border": "1px solid", "border-color":"red"});
                            $('#txttendn').val("");
                            $('#txtmk').val("");
                            $('#txtnlmk').val("");
                            $('#txttendn').removeAttr("disabled");
                            $('#txtmk').removeAttr("disabled");
                            $('#txtnlmk').removeAttr("disabled");
                            $('#txttendn').attr({"disabled":""});
                            $('#txtmk').attr({"disabled":""});
                            $('#txtnlmk').attr({"disabled":""});
                        }
                    });
                }
            };

            $manvchange.addEventListener('input', typeHandler); // register for oninput
            $manvchange.addEventListener('propertychange', typeHandler); // for IE8

            $('#btndk').click(function() {
                let manv= $('#txtmanv').val(), tentk=$('#txttendn').val(), mk=$('#txtmk').val(), nlmk=$('#txtnlmk').val();
                if(manv ==="" || tentk === "" || mk==="" || nlmk===""){
                    alert("Vui lòng nhập đầy đủ thông tin!");
                    return false;
                }
                else{
                    if(mk.length < 6){
                        alert("Độ dài mật khẩu tối thiểu phải có 6 ký tự!");
                        return false;
                    }
                    else{
                        if(mk!==nlmk){
                            $('#txtmk').val("");
                            $('#txtnlmk').val("");
                            $('#txtmk').focus();
                            alert("Xác nhân mật khẩu không chính xác!");
                            return false;
                        }
                        $.ajax({
                            type: "POST",
                            url: "proccess.php",
                            data: {tentk: tentk, hd: "kttentk"},
                            success: function(data) {
                                let dl=data;
                                dl= dl.toString().trim();
                                if(dl !== null){
                                    if(dl === "tc"){
                                        $.ajax({
                                            type: "POST",
                                            url: "proccess.php",
                                            data: {manv:  manv, tentk: tentk, mk: mk, hd: "dktk"},
                                            success: function(data) {
                                                let dt=data;
                                                dt= dt.toString().trim();
                                                dt=dt.split('|');
                                                if(dt !== null){
                                                    if(dt[0] === "tc"){
                                                        alert("Đăng ký thành công!");

                                                        if(manv.toString().substring(0,4)==="NVQT"){
                                                            location.replace("AdminArea");
                                                        }
                                                        if(manv.toString().substring(0,4)==="NVKT"){
                                                            location.replace("KetoanArea");
                                                        }
                                                        if(manv.toString().substring(0,4)==="NVBH"){
                                                            location.replace("BanhangArea");
                                                        }
                                                        if(manv.toString().substring(0,4)==="NVTK"){
                                                            location.replace("ThukhoArea");
                                                        }
                                                    }
                                                    else{
                                                        alert("Đăng ký thất bại, hãy thử lại lần nữa!");
                                                        return false;
                                                    }
                                                }
                                                else{
                                                    alert("Đăng ký thất bại, hãy thử lại lần nữa!");
                                                    return false;
                                                }

                                            },
                                            error: function() {
                                                alert("Đăng ký thất bại, hãy thử lại lần nữa!");
                                                return false;
                                            }

                                        });
                                    }
                                    else{
                                        alert("Tài khoản đã tồn tại, hãy nhập tài khoản khác!");
                                        return false;

                                    }
                                }
                                else{
                                    alert("Tài khoản đã tồn tại, hãy nhập tài khoản khác!");
                                    return false;
                                }

                            },
                            error: function() {
                                alert("Tài khoản đã tồn tại, hãy nhập tài khoản khác!");
                                return false;
                            }

                        });
                    }
                }                   
            });
            $('#btnthoat').click(function() {
                $('#frmdk').removeClass('hidden');                   
                $('#frmdk').addClass('hidden');
                $('#frmdn').removeClass('hidden');
            });      
            $('#mainboard').on('keydown', function(e) {
                if (e.which === 13) {
                    if($('#frmdn').hasClass('hidden')){
                        $('#btndk').click();
                    }
                    else{
                        $('#btnsi').click();
                    }

                }
            });
            $('#txtnlmk').on("cut copy paste",function(e) {
                e.preventDefault();
            });
        </script>  
    </body>
</html>
