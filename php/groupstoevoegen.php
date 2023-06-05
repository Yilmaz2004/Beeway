<?php
include '../private/dbconnect.php';
session_start();

if ($_POST['groups'] == '') {
  $_SESSION['error'] = "vul ff iets in";
  header("location: ../index.php?page=groupstoevoegen");
} elseif (checkForIllegalCharacters($_POST['groups'])) {
  $_SESSION['error'] = "illegal character used";
  header("location: ../index.php?page=groupstoevoegen");
} else {
  $sql = "select schoolid from users WHERE userid=:userid";
  $sth1 = $conn->prepare($sql);
  $sth1->bindParam(':userid', $_SESSION['userid']);
  $sth1->execute();

  while ($school = $sth1->fetch(PDO::FETCH_OBJ)) {

    $sql = "INSERT INTO groups (`groups`,`schoolid`, `createdby`, `updatedby`) VALUES (:groups, :schoolid, :createdby, :updatedby)";
    $sth = $conn->prepare($sql);
    $sth->bindParam(':groups', $_POST['groups']);
    $sth->bindParam(':schoolid', $school->schoolid);
    $sth->bindParam(':createdby', $_SESSION['userid']);
    $sth->bindParam(':updatedby', $_SESSION['userid']);
    $sth->execute();
    $_SESSION['info'] = "added successful";
    header("location: ../index.php?page=klassenlijst");
  }
}

function checkForIllegalCharacters($str) {
  $illegalChars = array('<', '>', '{', '}', '(', ')', '[', ']', '*', '$', '^', '`', '~', '|', '\\', '\'', '"', ':', ';', ',', '/');
  foreach ($illegalChars as $char) {
    if (strpos($str, $char) !== false) {
      return true;
    }
  }
  return false;
}
?>
