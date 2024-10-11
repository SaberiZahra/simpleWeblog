<?php
include '../database/db.php';
global $conn;
session_start();
$id = $_GET['id'];
$selectblog=$conn->prepare("SELECT * FROM `blogs` WHERE id=?");
$selectblog->bindvalue(1,$id);
$selectblog->execute();
$blogs=$selectblog->fetchAll(PDO::FETCH_ASSOC);

$newViewCount = $blogs[0]['view'] + 1;
$updateViewCount = $conn->prepare("UPDATE `blogs` SET view=? WHERE id = ?");
$updateViewCount->bindValue(1, $newViewCount);
$updateViewCount->bindValue(2, $id);
$updateViewCount->execute();

foreach ($blogs as $blog):
    if(isset($_POST['submit'])){
        $user_id = $_SESSION['name'];
        $text = $_POST['editor1'];
        $comment = $conn->prepare("INSERT INTO `comments` SET post_id=?, user_id=?, text=?");
        $comment->bindValue(1, $id);
        $comment->bindValue(2, $user_id);
        $comment->bindValue(3, $text);
        $comment->execute();

        $newCommentCount = $blogs[0]['comments'] + 1;
        $updateCommentCount = $conn->prepare("UPDATE `blogs` SET comments=? WHERE id=?");
        $updateCommentCount->bindValue(1, $newCommentCount);
        $updateCommentCount->bindValue(2, $id);
        $updateCommentCount->execute();
    }

    $select = $conn->prepare("SELECT * FROM `comments` WHERE post_id=?");
    $select->bindValue(1,$id);
    $select->execute();
    $comments = $select->fetchAll(PDO::FETCH_ASSOC);

    $rowcomment = $conn->prepare("SELECT COUNT(*) FROM `comments` WHERE post_id=?");
    $rowcomment->bindvalue(1,$id);
    $rowcomment->execute();
    $count=$rowcomment->fetchColumn();

    $writer=$conn->prepare("SELECT * FROM `writers` WHERE id=?");
    $writer->bindValue(1, $blog['writer'] );
    $writer->execute();
    $writers = $writer->fetchAll(PDO::FETCH_ASSOC);

    ?>

    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
        <title><?=$blog['title']?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">

    </head>
    <body dir="rtl">
<?php include 'header.php'?>
    <div class="container">
        <div class="col-12 col-lg-8">
            <div class="blog">
                <h1><?=$blog['title']?></h1>
                <div class="writer">
                    <?php foreach ($writers as $w): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                    </svg><span><?= " ".$w['username'] ?></span>
                    <?php endforeach; ?>
                </div>
                <div class="commentsign">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left-text-fill" viewBox="0 0 16 16">
                        <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H4.414a1 1 0 0 0-.707.293L.854 15.146A.5.5 0 0 1 0 14.793zm3.5 1a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 2.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1z"/>
                    </svg><span><?= " ".$count ?></span>
                </div>
                <img src="<?= $blog['image'] ?>" alt="" width="100%">
                <span><?= $blog['caption'] ?></span>
                <p id="tag">برچسب ها</p>
                <div class="tags">
                    <?php foreach ($blogs as $blog): ?>
                        <?php $tagArray = explode(",", $blog['tags']); ?>
                        <?php foreach ($tagArray as $tag): ?>
                            <a href="#"><?= trim($tag) ?></a>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <div class="col-12 col-lg-8">
                <div class="writer-info">
                    <?php foreach ($writers as $w): ?>
                    <a href=""><?= $w['username'] ?></a>
                    <span><?= $w['bio'] ?></span>
                    <?php endforeach; ?>
                </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="comment">
                <h5>دیدگاهتان را بنویسید</h5>
                <script src="//cdn.ckeditor.com/4.16.2/basic/ckeditor.js"></script>
                <form method="post">
                    <textarea name="editor1" id="editor1"></textarea>
                    <script>
                        CKEDITOR.replace( 'editor1' );
                    </script>
                    <input style="margin-top: 20px" name="submit" type="submit" class="btn btn-success" value="ثبت دیدگاه">
                </form>
                <?php foreach ($comments as $comment){ ?>
                    <div class="user-comment">
                        <p><?=$comment['user_id'].' گفته است:'?></p>
                        <span><?=$comment['text']?></span>
                    </div><br>
                <?php } ?>
            </div>
        </div>

        <div class="footer">
            <p>لینک های مفید</p>
            <ul>
                <a href="../category/all.php"><li>همه ی مقالات</li></a>
                <a href="../login.php"><li>ورود</li></a>
                <a href="../index.php"><li>جستجو</li></a>
            </ul>
        </div>
        <footer>هیچ چیز مال خود آدم نیست.</footer>
    </div>

    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </html>
