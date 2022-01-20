<?php 

  $abc = "12:10:20";
  function time_to_decimal($time) {
    $timeArr = explode(':', $time);
    $decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);
    return $decTime;
}
  $haha=(int)time_to_decimal($abc);
  function money($need){
    $timeArr = explode(':', $need);
    $decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);
    $pay = $decTime *100;
    return $pay;
  }
  $hehe=(int)money($abc);
  var_dump($haha);
  var_dump($hehe);
  
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
  <label for=""><?php
   echo time_to_decimal($abc)
  ?></label>
  <label for=""><?php
   echo money($abc)
  ?></label>
</body>
</html>
