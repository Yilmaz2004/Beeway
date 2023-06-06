<?php
  require_once '../private/dbconnect.php';
  session_start();

  $sql = "UPDATE maintheme SET archive=1
          WHERE themeid=:themeid";
  $sth = $conn->prepare($sql);
  $sth->bindParam(':themeid',$_GET['themeid']);
  $sth->execute();
  $_SESSION['info'] = "archive successful";
  header("location: ../index.php?page=hoofdthemalijst");
?>
