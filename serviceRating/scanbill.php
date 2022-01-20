<!-- <?php 
    if(isset($_POST['email_staff'])){
        $email_staff = $_POST['email_staff'];
        $name = ltrim($email_staff,"mailto:");
        $name = substr($name, 0, -19);
        $conn = mysqli_connect("localhost", "root", "", "khach_hang");

        $select = "SELECT `email` FROM `users` WHERE `email` like '$name' ";
        $queru = mysqli_query($conn,$select);
        $check = mysqli_fetch_array($queru);
        var_dump($check);
    }
?> -->
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
    
    
</head>
<body >
    <div class="container">
        <div class="row" style="text-align: center;">
            <h2>Đánh giá độ hài lòng của bạn </h2>
            <h4>Vui lòng quét QR code để đánh giá</h4>
            <div class="col-md-6">
                <video id="preview" width="500px"></video>
            </div>
            <form action="viewReaction.php" method="post" >
                <div class="col-md-6">
                <input type="text" name="email_staff" id="email_staff" readonly=''  placeholder="Name Member" class="form-control" style="opacity: 0;" >
                   
            </div>
            <input type="submit" value="Submit" id="btn_submit" hidden >
            </form>
            
        </div>
    </div>
   
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
                   var r = confirm ("Bạn muốn scan mã QR của bạn chứ");
                   if(r==true){
                       document.getElementById('email_staff').value=c;
                   }
                   else{
                       alert("Tạm biệt quý khách")
                   }
               }
           });
        
    </script>

</body>
</html>
    
    