<?php
include 'database/db.php';
global $conn;
if(isset($_POST['sub'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $insert = $conn->prepare("INSERT INTO `users` SET name=?, email=?, pass=?");
    $insert->bindValue(1, $name);
    $insert->bindValue(2, $email);
    $insert->bindValue(3, $pass);
    $insert->execute();
    header('location:login.php');
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>وبلاگ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">

</head>
<body dir="rtl">
<div class="container">
    <div class="register" style="text-align: center;">
        <h4>ثبت نام کنید</h4><br>
        <form method="post">
            <input name="name" type="text" placeholder="نام و نام خانوادگی" class="form-control"><br>
            <input name="email" type="email" placeholder="ایمیل" class="form-control"><br>
            <input name="pass" type="password" placeholder="رمز عبور" class="form-control"><br>
            <input name="sub" type="submit" value="ثبت" class="btn btn-info form-control">
        </form>
    </div>
</div>
</body>
</html>