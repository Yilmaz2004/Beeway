<?php
include '../private/dbconnect.php';
session_start();

if ($_POST['namethemep1'] == '' || $_POST['namethemep2'] == '' || $_POST['namethemep3'] == '' || $_POST['namethemep4'] == '' || $_POST['namethemep5'] == '' || $_POST['schoolyear'] == '' ) {
  $_SESSION['error'] = "Please fill in all the fields";
  header("location: ../index.php?page=hoofdthematoevoegen");
} elseif (checkForIllegalCharacters($_POST['namethemep1']) || checkForIllegalCharacters($_POST['namethemep2']) || checkForIllegalCharacters($_POST['namethemep3']) || checkForIllegalCharacters($_POST['namethemep4']) || checkForIllegalCharacters($_POST['namethemep5']) || checkForIllegalCharacters($_POST['schoolyear'])) {
  $_SESSION['error'] = "Illegal character used";
  header("location: ../index.php?page=hoofdthematoevoegen");
} else {
  $sql = "select schoolid from users WHERE userid=:userid";
  $sth1 = $conn->prepare($sql);
  $sth1->bindParam(':userid', $_SESSION['userid']);
  $sth1->execute();

  while ($school = $sth1->fetch(PDO::FETCH_OBJ)) {
    $sql = "INSERT INTO maintheme (`schoolid`, `groupid`,`namethemep1`, `namethemep2`, `namethemep3`, `namethemep4`, `namethemep5`, `schoolyear`) VALUES (:schoolid, :groupid, :namethemep1, :namethemep2, :namethemep3, :namethemep4, :namethemep5, :schoolyear)";
    $sth = $conn->prepare($sql);
    $sth->bindParam(':schoolid', $school->schoolid);
    $sth->bindParam(':groupid', $_POST['groupid']);
    $sth->bindParam(':namethemep1', $_POST['namethemep1']);
    $sth->bindParam(':namethemep2', $_POST['namethemep2']);
    $sth->bindParam(':namethemep3', $_POST['namethemep3']);
    $sth->bindParam(':namethemep4', $_POST['namethemep4']);
    $sth->bindParam(':namethemep5', $_POST['namethemep5']);
    $sth->bindParam(':schoolyear', $_POST['schoolyear']);
    $sth->execute();
  }
  $_SESSION['info'] = "added successful";
  header("location: ../index.php?page=hoofdthemalijst");
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
