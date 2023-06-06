<?php
  require_once '../private/dbconnect.php';
  session_start();

  $sql = "UPDATE disciplines SET archive=1
          WHERE disciplineid=:disciplineid";
  $sth = $conn->prepare($sql);
  $sth->bindParam(':disciplineid',$_GET['disciplineid']);
  $sth->execute();
  $_SESSION['info'] = "deleted successful";
  header("location: ../index.php?page=vakkenlijst");
?>
