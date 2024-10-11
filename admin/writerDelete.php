<?php
$id = $_GET['id'];
include'../database/db.php';
global $conn ;
$delete = $conn->prepare("DELETE FROM `writers` WHERE id=?");
$delete->bindvalue(1,$id);
$delete->execute();
header("location:writers.php");
?>