<?php
include '../blog/jdf.php';
include'../database/db.php';
global $conn ;
$id = $_GET['id'];
$select = $conn->prepare("SELECT * FROM `blogs` WHERE id=?");
$select->bindvalue(1,$id);
$select->execute();
$article = $select->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['sub'])){
    $title = $_POST['title'];
    $caption = $_POST['editor1'];
    $writer = $_POST['writer'];
    $date = jdate('Y/m/d');
    $readtime = $_POST['time'];
    $image = $_POST['image'];
    $tags = $_POST['tags'];
    $category = $_POST['category'];

    $insert = $conn->prepare('UPDATE `blogs` SET title=?, caption=?, writer=?, date=?, readtime=?, image=?, tags=?, category=? WHERE id=?');

    $insert->bindvalue(1,$title);
    $insert->bindvalue(2,$caption);
    $insert->bindvalue(3,$writer);
    $insert->bindvalue(4,$date);
    $insert->bindvalue(5,$readtime);
    $insert->bindvalue(6,$image);
    $insert->bindvalue(7,$tags);
    $insert->bindvalue(8, $category);
    $insert->bindvalue(9, $id);

    $insert->execute();
    header('location:articles.php');
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
    <h1 id="welcome">ویرایش مقاله</h1>
    <form method="post">
        <?php foreach ($article as $articlesection): ?>
            <input name="title" type="text" placeholder="موضوع مقاله" class="form-control" value="<?=$articlesection['title']?>">
            <script src="//cdn.ckeditor.com/4.16.2/full/ckeditor.js"></script>
            <textarea name="editor1" id="editor1"><?= $articlesection['caption']?></textarea><br><br>
            <script>
                CKEDITOR.replace('editor1');
            </script>
            <select name="writer" class="form-control">
                <option value="<?= $articlesection['writer']?>">زهرا صابری</option>
            </select>
            <br>
            <select name="category" class="form-control">
                <option value="0">سایر</option>
                <option value="1">ادبیات</option>
                <option value="2">سینما</option>
                <option value="3">هنر</option>
                <option value="4">تاریخ</option>
                <option value="5">فلسفه</option>
                <option value="6">آشپزی</option>
            </select>
            <input name="time" type="number" placeholder="زمان تقریبی مطالعه" class="form-control" value="<?= $articlesection['readtime']?>">
            <input name="image" type="text" placeholder="لینک عکس" class="form-control" value="<?= $articlesection['image']?>">
            <input name="tags" type="text" placeholder="تگ ها" class="form-control" value="<?= $articlesection['tags']?>">
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