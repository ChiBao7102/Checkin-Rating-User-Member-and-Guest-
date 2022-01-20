<?php
// checkin.php?name_member=mailto:phu12345@gmail.com?subject=lSjLTUKcYo
if (isset($_POST["name_member"])) {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $id = $_POST['name_member'];
        $email = substr($id,7);
        $email = substr($email, 0, -19);
              
        $current_time = date("Y-m-d H:i:s");
        
        $conn = mysqli_connect("localhost", "root", "", "khach_hang");

       //Kiểm tra id khách hàng
       $select_id ="SELECT `email` FROM `members` WHERE `email` LIKE '$email'";
       $query_id= mysqli_query($conn, $select_id);
       $id_result=mysqli_fetch_array( $query_id);
       //
          //Thông báo tên khách hàng 
       $sql = "Select `name` from `members` where `email` LIKE '$email' ";
       $query = mysqli_query($conn, $sql);
       $result=mysqli_fetch_assoc( $query);
       //
  
      // var_dump($is_checkin);
      if($email != isset($id_result['email'])){
          $noti="Mã QR Code của bạn không tồn tại .Vui lòng đăng ký để sử dụng dịch vụ của chúng tôi.";    
      }else{
          $noti= "Xin chào " . $result['name'] ;
          
          //function checkin

          $check_email = "SELECT `email` FROM `checkin` WHERE `email` LIKE '$email'";
          $query_check = mysqli_query($conn,$check_email);
          $abc = mysqli_fetch_array($query_check);
          //var_dump($abc);
  
          
  
         // var_dump($ccc);
  
          $set_id = "SELECT `id_session` FROM `checkin` WHERE `email`LIKE '$email' ORDER BY `id_session` DESC LIMIT 1";
          $query_id = mysqli_query($conn,$set_id);
          $id_update =mysqli_fetch_array($query_id);
          $id_update = $id_update['id_session'];

          $check_checkout = "SELECT `checkout` FROM `checkin` WHERE `email` = '$email' and `id_session` = '$id_update'"  ;
          $query_check_out = mysqli_query($conn,$check_checkout);
          $ccc = mysqli_fetch_array($query_check_out);

          $sql = "SELECT `is_checkin` FROM `checkin` WHERE `email` = '$email' and `id_session` = '$id_update'";
          $query = mysqli_query($conn, $sql);
          $is_checkin = $query->fetch_array()["is_checkin"];
          //var_dump($is_checkin);
  
          if(($abc == null || $ccc != null) && ($is_checkin == null || $is_checkin == 0) ){
              $insert="INSERT INTO `checkin`(`email`, `checkin`, `checkout`, `is_checkin`) VALUES ('$email','$current_time',NULL,'1')";
              $query_insert = mysqli_query($conn,$insert);
              var_dump( "Checkin thành công") ;
            //   var_dump($abc);
            //   var_dump($ccc);
            //   var_dump($is_checkin);
                
          }
          else{
              $sql_date = "UPDATE `checkin` SET `checkout`='$current_time', `is_checkin` = 0 WHERE `id_session`='$id_update' ";
              $query_date = mysqli_query($conn, $sql_date);
              var_dump("Checkout thành công") ;
              
          }
          $select_checkin = "SELECT time(`checkin`) from `checkin` where `email` like '$email' ORDER BY `id_session` DESC LIMIT 1";
          $show_checkin = mysqli_query($conn,$select_checkin);
          $result_checkin = mysqli_fetch_array($show_checkin);

          $select_checkout = "SELECT time(`checkout`) from `checkin` where `email` like '$email' ORDER BY `id_session` DESC LIMIT 1";
          $show_checkout = mysqli_query($conn,$select_checkout);
          $result_checkout = mysqli_fetch_array($show_checkout);

          $select_date = "SELECT date(`checkin`) from `checkin` where `email` like '$email' ORDER BY `id_session` DESC LIMIT 1";
          $show_date = mysqli_query($conn,$select_date);
          $result_date = mysqli_fetch_array($show_date);

          $total_time = "SELECT time(`checkout`-`checkin`) from `checkin` where `email` like '$email' ORDER BY `id_session` DESC LIMIT 1";
          $show_total = mysqli_query($conn,$total_time);
          $result_total = mysqli_fetch_array($show_total);
          $result_total = $result_total["time(`checkout`-`checkin`)"];
          if($result_total!=0||$result_total!=null){
              function time_to_decimal($time) {
                $timeArr = explode(':', $time);
                $decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);
                return $decTime;
                }  
            function money($need){
                $timeArr = explode(':', $need);
                $decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);
                $pay = $decTime *100;
                return $pay;
              }
            $haha=round(time_to_decimal($result_total),2);
            $hehe=round(money($result_total),2);
            $test1 = (int)$haha;
            //var_dump($test1);
            $test2 = (int)$hehe;
            // $manage =  "INSERT INTO `manage_member_time`( `email`, `time_use`, `money_use`,`date_use`) VALUES ('$email','$test1','$test2','$result_date['chechin']')";

            $select_money = "SELECT `money` FROM `members` WHERE `email` like '$email'";
            $query_money = mysqli_query($conn,$select_money);
            $money_member = mysqli_fetch_array($query_money);
            $money_member_cov = $money_member['money'];
            //$money_member_cov = substr($money_member_cov,0,-4);
            //var_dump($money_member_cov);
            $money_member_cal = (int)$money_member_cov;
            
            $update_money_member = $money_member_cal - $test2;

           

            $update_money = "UPDATE `members` SET `money`='$update_money_member' WHERE `email` like '$email'" ;   
            $query_update_money = mysqli_query($conn,$update_money);

            $show_money_avi =  "SELECT `money` FROM `members` WHERE `email` like '$email'";
            $query_avi = mysqli_query($conn,$show_money_avi);
            $money_avi = mysqli_fetch_array($query_avi);
            
            }
            else{
                $test1=0;
                $test2=0;
            }
      }

       
        
        

    // if ($is_checkin == null || $is_checkin == 0) {
        
    //     $sql_date = "UPDATE `checkin` SET `checkin`='$current_time', `is_checkin` = 1 WHERE `id_session`='$id_update'";
    //     $message = "Checkin thành công";
    // } else {
        
    //     $sql_date = "UPDATE `checkin` SET `checkout`='$current_time', `is_checkin` = 0 WHERE `id_session`='$id_update' ";
    //     $message = "Checkout thành công";
    // }
    // $query_date = mysqli_query($conn, $sql_date);
    // if ($query_date) {
    //     echo $message;

    // } else {
    //     echo "Failed";
    // }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body> 
    <label for=""><?php if(isset($noti)){echo $noti;}?></label>
    
        <ul style="list-style:none;">
            Ngày sử dụng <li><input type="text" name="date" id="" value=" <?php 
            if(isset($result_date['date(`checkin`)'])){
                echo $result_date['date(`checkin`)'];
            }
            ?>"></li>
            Thời gian Checkin<li>  <input type="text" name="checkin" id="" value=" <?php 
            if(isset($result_checkin['time(`checkin`)'])){
                echo $result_checkin['time(`checkin`)'];
            }
            ?>"></li>
            Thời gian Checkout<li> <input type="text" name="checkout" id="" value=" <?php 
            if(isset($result_checkout['time(`checkout`)'])){
                echo $result_checkout['time(`checkout`)'];
            }
            ?>"></li>
            <li> <label for="">Thời gian đã sử dụng :<?php 
                
                    echo $test1." phút";
                
                      ?></label> </li>
            <li>  <label for="">Số tiền dã dùng :<?php 
                
                    echo $test2." VNĐ";
            
                  ?></label></li>
            <li><label for="">Số tiền còn lại của bạn :<?php 
                if(isset($money_avi['money'])){
                    echo $money_avi['money']." VNĐ";
                }
                
              ?></label></li>
        </ul>
   
</body>
</html>