<?php
include'../database/db.php';
global $conn ;
$id = $_GET['id'];
$post_id = $_GET['post_id'];

$delete = $conn->prepare("DELETE FROM `comments` WHERE id=?");
$delete->bindvalue(1,$id);
$delete->execute();

$blog=$conn->prepare("SELECT * FROM `blogs` WHERE id=?");
$blog->bindvalue(1,$post_id);
$blog->execute();
$blogData=$blog->fetchAll(PDO::FETCH_ASSOC);

$newCommentCount = $blogData[0]['comments'] - 1;
$updateCommentCount = $conn->prepare("UPDATE `blogs` SET comments=? WHERE id=?");
$updateCommentCount->bindValue(1, $newCommentCount);
$updateCommentCount->bindValue(2, $post_id);
$updateCommentCount->execute();

header("location:comments.php");
?>