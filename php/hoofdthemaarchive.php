<?php
include'../private/dbconnect.php';
session_start();


$sql = "UPDATE maintheme SET archive = 0 WHERE themeid=:themeid ";
$sth = $conn->prepare($sql);
$sth->bindParam(':themeid',$_GET['themeid']);
$sth->execute();
$_SESSION['success'] = "archive successful";
header("location: ../index.php?page=hoofdthemalijst");
?>
