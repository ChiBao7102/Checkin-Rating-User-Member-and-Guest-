<?php
if (isset($_POST['id_member'])) {

    $id = $_POST['id_member'];
    $name = $_POST['ten'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $hinh = $_POST['hinh'];

    
    $conn = mysqli_connect("localhost", "root", "", "khach_hang");
    $sql = "INSERT INTO `member`(`MaKhachHang`, `HoTen`, `SoDienThoai`, `Email`, `QRCode`) VALUES ('$id' ,'$name', '$std', '$email', '$hinh')";
    $query = mysqli_query($conn, $sql);
    $result=mysqli_fetch_assoc( $query);
    var_dump($query);
    $html= "<label > {$result['HoTen']} </label>";
    
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
    <form action="" method="post">
        <input type="text" name="id_member">
        <input type="text" name="ten">
        <input type="text" name="sdt">
        <input type="text" name="email">
        <input type="file" name="hinh">

        <input type="submit" value="" hidden>
        <?php 
        if(isset($html)){
            echo $html;
        }
        ?>
    </form>
</body>
</html>