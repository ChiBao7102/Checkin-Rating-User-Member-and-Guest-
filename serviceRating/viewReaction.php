<?php 
  if(isset($_POST['id_rate'])){
    $id_rate= $_POST['id_rate'];
    $email_staff = $_POST['email'];
    $name = ltrim($email_staff,"mailto:");
    $name = substr($name, 0, -19);
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    
    $currtentime =  date('Y-m-d H:i:s');

    $conn = mysqli_connect("localhost", "root", "", "khach_hang");
    $insert = "INSERT INTO `service_rate`( `rate_id`, `date_rate`, `email_staff`) VALUES ('$id_rate','$currtentime','$name')";
    $query_is = mysqli_query($conn,$insert);
    
  }
    
?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" type="text/css" href="reaction.css"/>
    <link rel="stylesheet" type="text/css" href="btn.css"/>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body>
  <!-- <div><h2>Đánh giá của bạn </h2></div> -->
  
  <div class="wrapper">
    <input type="radio" name="rate" id="star-1" value="rate_01">
    <input type="radio" name="rate" id="star-2" value="rate_02">
    <input type="radio" name="rate" id="star-3" value="rate_03">
    <input type="radio" name="rate" id="star-4" value="rate_04">
    <input type="radio" name="rate" id="star-5" value="rate_05">
    <div class="content">
      <div class="outer">
        <div class="emojis">
          <li class="slideImg"><img src="emojis/emoji-1.png" alt=""></li>
          <li><img src="emojis/emoji-2.png" alt=""></li>
          <li><img src="emojis/emoji-3.png" alt=""></li>
          <li><img src="emojis/emoji-4.png" alt=""></li>
          <li><img src="emojis/emoji-5.png" alt=""></li>
        </div>
      </div>
      <div class="stars">
        <label for="star-1" class="star-1 fas fa-star"></label>
        <label for="star-2" class="star-2 fas fa-star"></label>
        <label for="star-3" class="star-3 fas fa-star"></label>
        <label for="star-4" class="star-4 fas fa-star"></label>
        <label for="star-5" class="star-5 fas fa-star"></label>
      </div>
    </div>
    <div class="footer">
      <span class="text"></span>
      <span class="numb"></span>
    </div>
    <div class="btn" style="text-align: center; padding-bottom: 10px;">
      <form action="" method="post">
        <input type="text" name="id_rate" id="id_rate" hidden  ></br>
        <input type="text" name="email" id="email" hidden value="<?php 
        if(isset($_POST['email_staff'])){
          echo $_POST['email_staff'];
        }
        ?>"  ></br>
        <input type="submit" value="Đánh giá" id="submit_rate" name="btn" >
        
      </form>
      
    </div>  

  </div>
  <script>
    

   

    document.getElementById("submit_rate").onclick = function ()
            {
                var checkbox = document.getElementsByName("rate");
                for (var i = 0; i < checkbox.length; i++){
                    if (checkbox[i].checked === true){
                      console.log(checkbox[i].value);
                      document.getElementById('id_rate').value = checkbox[i].value;
                      alert ("Đánh giá thành công");
                    }
                }
            };
  </script>
  
</body>
</html>