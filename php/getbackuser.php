<?php
  require_once '../private/dbconnect.php';
  session_start();

  $sql = "UPDATE users SET archive=0 
          WHERE userid=:userid";
  $sth = $conn->prepare($sql);
  $sth->bindParam(':userid',$_GET['userid']);
  $sth->execute();

  $sql2 = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`)
          VALUES (:userid, :useragent, '6', '6', :interactionid)";
  $sth2 = $conn->prepare($sql2);
  $sth2->bindParam(':userid', $_SESSION['userid']);
  $sth2->bindParam(':useragent', $_SESSION['useragent']);
  $sth2->bindParam(':interactionid', $_GET['userid']);
  $sth2->execute();

  $_SESSION['info'] = "archive successful";
  header("location: ../index.php?page=userlijst");
?>
