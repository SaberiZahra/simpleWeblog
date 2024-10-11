<?php
include '../database/db.php';
global $conn;
$select = $conn->prepare("SELECT * FROM `blogs` WHERE `category` = 5 ORDER BY `id` DESC");


$select->execute();
$blogs=$select->fetchAll(PDO::FETCH_ASSOC);

function limit_words($string, $word_limit){
    $words = explode(" ",$string);
    return implode(" ",array_slice($words,0,$word_limit));
}

if(isset($_POST['search'])){
    $title=$_POST['title'];
    header('Location:../search.php?query='.$title);
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width-device-width, initial-scale=1.0">
    <title>وبلاگ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">

</head>
<body dir="rtl">
<?php include 'header.php'?>
<div class="container">

    <div class="container">
        <div class="row">
            <h4 id="title">فلسفه</h4>
            <?php if (empty($blogs)) {?>
                <h4>نتیجه ای یافت نشد.</h4>
            <?php } else { ?>
            <?php
            foreach($blogs as $blog):

                $numview = $blog['view'];
                $numcomment = $blog['comments'];

                ?>
                <div class="col-12 col-lg-3">
                    <div class="boxes">
                        <a href="../blog/index.php?id=<?=$blog['id']?>">
                            <img src="<?= $blog['image'] ?>" width="100%" alt="">
                        </a>
                        <p><?= $blog['title'] ?></p>
                        <span ><?php
                            $content = $blog['caption'];
                            echo limit_words($content,20) . ' ... ';
                            ?></span>
                        <br><br>
                        <div class="co-view">
                            <?= $blog['date'] ?>

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                            </svg><span><?= $numview ?></span>

                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text-fill" viewBox="0 0 16 16">
                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z"/>
                            </svg><span><?= $numcomment ?></span>
                            <br>

                            <?php
                            $writer=$conn->prepare("SELECT * FROM `writers` WHERE id=?");
                            $writer->bindValue(1, $blog['writer'] );
                            $writer->execute();
                            $writers = $writer->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($writers as $w): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                </svg><span><?=$w['username']?></span>
                            <?php endforeach; ?>

                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
        <?php } ?>
    </div>

    <?php include 'footer.php' ?>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</html>