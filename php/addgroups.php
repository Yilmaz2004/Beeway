<?php
  require_once '../private/dbconnect.php';
  session_start();
  // try {
    if ($_POST['groups'] == '' ) {
      $_SESSION['error'] = "vul ff iets in";
      header("location: ../index.php?page=addgroups");
    } elseif (checkForIllegalCharacters($_POST['groups'])) {
      $_SESSION['error'] = "illegal character used";
      header("location: ../index.php?page=addgroups");
    } else {

      $sql = "select schoolid from users WHERE userid=:userid";
      $sth1 = $conn->prepare($sql);
      $sth1->bindParam(':userid', $_SESSION['userid']);
      $sth1->execute();

     while ($school = $sth1->fetch(PDO::FETCH_OBJ)) {

      $sql = "INSERT INTO groups (`groups`, `schoolid`, `createdby`, `updatedby`)
              VALUES (:groups, :schoolid, :createdby, :updatedby)";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':groups', $_POST['groups']);
      $sth->bindParam(':schoolid', $school->schoolid);
      $sth->bindParam(':createdby', $_SESSION['userid']);
      $sth->bindParam(':updatedby', $_SESSION['userid']);
      $sth->execute();

      $groupid = $conn->lastInsertId();

      $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '1', '3', :interactionid)";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':userid', $_SESSION['userid']);
      $sth->bindParam(':useragent', $_SESSION['useragent']);
      $sth->bindParam(':interactionid', $groupid);
      $sth->execute();

      $_SESSION['info'] = "added successful";
      header("location: ../index.php?page=klassenlijst");
      }
    }
  function checkForIllegalCharacters($str) { // check for iliegal characters
    $illegalChars = array('<', '>', '{', '}', '(', ')', '[', ']', '*', '$', '^', '`', '~', '|', '\\', '\'', '"', ':', ';', ',', '/');
    foreach ($illegalChars as $char) {
      if (strpos($str, $char) !== false) {
        return true;
      }
    }
    return false;
  }
?>
