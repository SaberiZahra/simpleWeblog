<?php
session_start();
include 'database/db.php';
global $conn;
if(isset($_POST['sub'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $insert = $conn->prepare("SELECT * FROM `users` WHERE email=? AND pass=?");
    $insert->bindValue(1, $email);
    $insert->bindValue(2, $pass);
    $insert->execute();
    $users = $insert->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $user)
    if($insert->rowCount() >= 1){
        $_SESSION['login']=true;
        $_SESSION['email']=$email;
        $_SESSION['name']=$user['name'];
        $_SESSION['id']=$user['id'];
        $_SESSION['role']=$user['role'];

        header('location:index.php');
    }
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
        <h4>ورود به حساب کاربری</h4><br>
        <form method="post">
            <input name="email" type="email" placeholder="ایمیل" class="form-control"><br>
            <input name="pass" type="password" placeholder="رمز عبور" class="form-control"><br>
            <input name="sub" type="submit" value="ورود به حساب کاربری" class="btn btn-info form-control">
        </form>
    </div>
</div>
</body>
</html>