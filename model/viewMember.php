<?php 
    // $url1=$_SERVER['REQUEST_URI'];
    // header("Refresh: 10; URL=$url1");
     
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    
    <link rel="stylesheet" href="style.css">
</head>
<body >
    <div class="head" style="text-align: center; padding-bottom: 20px;"><h2 >Scan PR CODE</h2></div>
    
    <div class="container"  style="display: flex;">
        
        <div class="row" >
                <div class="col-md-6" style="width: 100%;"><video id="preview"  ></video></div>
                <form class="form-horizontal" id="form_input" >
                    <div class="col-md-6">
                        <input type="text" name="name_member" id="name_member" readonly='' placeholder="Name Member" class="form-control" style="opacity: 0;" >
                    </div>
                    <button type="submit"  id="btn_submit"  name="btn" style="font-family: 'Raleway', Arial, sans-serif;
                        width: 150px;
                        height: 50px;
                        border-radius: 50px;
                        font-size: 20px;
                        font-weight: 700;
                        background-color: lightcoral;
                        color: rgb(178, 32, 32);">Scan</button>
                </form>   
        </div>
        <div id="content" style="padding-left:20px ;">
        <!-- <ul>
            <li><input type="text" name="checkin" id=""></li>
            <li><input type="text" name="checkout" id=""></li>
            <li><input type="text" name="total_time" id=""></li>
            <li><input type="text" name="money" id=""></li>
        </ul> -->

        </div>  
    </div>
    <script type="text/javascript">
        $(document).ready(function()
        { 
            //khai b??o bi???n submit form l???y ?????i t?????ng n??t submit
            var submit = $("button[type='submit']");

            //khi n??t submit ???????c click
            submit.click(function()
            {
                //khai b??o c??c bi???n d??? li???u g???i l??n server
                var user = $("input[name='name_member']").val(); //l???y gi?? tr??? trong input user
        
                //Ki???m tra xem tr?????ng ???? ???????c nh???p hay ch??a
                if(user == ''){
                alert('Vui l??ng nh???p qu??t l???i QR Code');
                return false;
                }
        
                //L???y to??n b??? d??? li???u trong Form
                var data = $('form#form_input').serialize();
            
                //S??? d???ng ph????ng th???c Ajax.
                $.ajax({
                    type : 'post', //S??? d???ng ki???u g???i d??? li???u POST
                    url : 'checkin.php', //g???i d??? li???u sang trang data.php
                    data : data, //d??? li???u s??? ???????c g???i
                    success : function(data)  // H??m th???c thi khi nh???n d??? li???u ???????c t??? server
                                { 
                                if(data == 'false') 
                                {
                                    alert('Kh??ng c?? ng?????i d??ng');
                                }else{
                                    $('#content').html(data);// d??? li???u HTML tr??? v??? s??? ???????c ch??n v??o trong th??? c?? id content
                                }
                                }
                    });
                    return false;
                });
            });
        </script>
    <script>
        let scanner = new Instascan.Scanner({video: document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length>0){
                scanner.start(cameras[0]);
            }else{
                alert('No connect to your cameras');
            }
        }).catch(function(e){
            console.error(e);
        });
        scanner.addListener('scan',function(c){
               if(c!=" "){
                   var r = confirm ("B???n mu???n scan m?? QR c???a b???n ch???");
                   if(r==true){
                       document.getElementById('name_member').value=c;
                   }
                   else{
                       alert("T???m bi???t qu?? kh??ch")
                   }
               }
           });
        
    </script>

</body>
</html>
    
    