<?php
include '../blog/jdf.php';
include'../database/db.php';
global $conn ;
$number = 1;

$select = $conn->prepare("SELECT * FROM `users`");
$select->execute();
$blog = $select->fetchAll(PDO::FETCH_ASSOC);
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


</head>
<body dir="rtl">
<?php include 'header.php';?>
<div class="container">
    <h1 id="welcome">لیست کاربران</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">نام کاربر</th>
            <th scope="col">ایمیل کاربر</th>
            <th scope="col">نقش کاربر</th>
            <th scope="col">عملیات</th>

        </tr>
        </thead>
        <?php foreach ($blog as $bloginfo):?>
            <tbody>
            <tr>
                <th scope="row"><?= $number++ ?></th>
                <td><?= $bloginfo['name'] ?></td>
                <td><?= $bloginfo['email'] ?></td>
                <td><?php if($bloginfo['role'] == 2){echo "ادمین";} else {echo "کاربر عادی";} ?></td>
                <td><a href="userDelete.php ? id=<?= $bloginfo['id']?>" class="btn btn-danger">حذف</a></td>
            </tr>
            </tbody>
        <?php endforeach; ?>
    </table>

</div>
<?php include 'footer.php';?>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>