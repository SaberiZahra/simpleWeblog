<?php
include'../database/db.php';
global $conn ;
$id = $_GET['id'];
$select = $conn->prepare("SELECT * FROM `writers` WHERE id=?");
$select->bindvalue(1,$id);
$select->execute();
$writer = $select->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['sub'])){
    $name = $_POST['username'];
    $bio = $_POST['editor1'];
    $image = $_POST['image'];

    $insert = $conn->prepare("UPDATE `writers` SET username=?, bio=?, image=? WHERE id=?");
    $insert->bindvalue(1,$name);
    $insert->bindvalue(2,$bio);
    $insert->bindvalue(3,$image);
    $insert->bindvalue(4, $id);

    $insert->execute();
    header('location:writers.php');
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>پنل ادمین</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">

    <style>
        input{
            margin: 15px 0px;
        }
    </style>
</head>
<body dir="rtl">
<?php include 'header.php';?>
<div class="container">
    <h1 id="welcome">ویرایش اطلاعات نویسنده</h1>
    <form method="post">
        <?php foreach ($writer as $writerinfo): ?>
            <input name="username" type="text" placeholder="نام نویسنده" class="form-control" value="<?=$writerinfo['username']?>">
            <script src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
            <textarea name="editor1" id="editor1"><?= $writerinfo['bio']?></textarea><br><br>
            <script>
                CKEDITOR.replace('editor1');
            </script>
            <input name="image" type="text" placeholder="لینک عکس" class="form-control" value="<?= $writerinfo['image']?>">
            <input name="sub" type="submit" class="btn btn-success" value="ویرایش">
        <?php endforeach; ?>
    </form>
</div>
<?php include 'footer.php';?>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>