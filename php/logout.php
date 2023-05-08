<?php
  session_start();
  include'../private/dbconnect.php';

  $sql = "INSERT INTO `logs`(`userid`, `action`, `tableid`, `interactionid`) VALUES (:userid, '5', '6', :interactionid)";
  $sth = $conn->prepare($sql);
  $sth->bindParam(':userid', $_SESSION['userid']);
  $sth->bindParam(':interactionid', $_SESSION['userid']);
  $sth->execute();

  session_destroy();
  header('location: ../index.php');
?>
