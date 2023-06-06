<?php
  require_once '../private/dbconnect.php';
  session_start();

  $sql = "UPDATE `groups` SET archive=1
          WHERE groupid=:groupid";
  $sth = $conn->prepare($sql);
  $sth->bindParam(':groupid', $_GET['groupid']);
  $sth->execute();
  $_SESSION['info'] = "archived successful";
  header("location: ../index.php?page=klassenlijst");
?>
