<?php
  require_once '../private/dbconnect.php';
  session_start();

  $sql = "UPDATE maintheme SET archive=1
          WHERE themeid=:themeid";
  $sth = $conn->prepare($sql);
  $sth->bindParam(':themeid',$_GET['themeid']);
  $sth->execute();

  $sql2 = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`)
          VALUES (:userid, :useragent, '3', '4', :interactionid)";
  $sth2 = $conn->prepare($sql2);
  $sth2->bindParam(':userid', $_SESSION['userid']);
  $sth2->bindParam(':useragent', $_SESSION['useragent']);
  $sth2->bindParam(':interactionid', $_GET['themeid']);
  $sth2->execute();

  $_SESSION['info'] = "archive successful";
  header("location: ../index.php?page=hoofdthemalijst");
?>
