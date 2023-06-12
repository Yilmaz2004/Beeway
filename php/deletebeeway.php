<?php
  require_once '../private/dbconnect.php';
  session_start();

  $sql = "UPDATE beeway SET archive=1
          WHERE beewayid=:beewayid";
  $sth = $conn->prepare($sql);
  $sth->bindParam(':beewayid',$_GET['beewayid']);
  $sth->execute();

  $sql2 = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`)
          VALUES (:userid, :useragent, '3', '1', :interactionid)";
  $sth2 = $conn->prepare($sql2);
  $sth2->bindParam(':userid', $_SESSION['userid']);
  $sth2->bindParam(':useragent', $_SESSION['useragent']);
  $sth2->bindParam(':interactionid', $_GET['beewayid']);
  $sth2->execute();

  $_SESSION['info'] = "archive successful";
  header("location: ../index.php?page=beewaylijst");
?>
