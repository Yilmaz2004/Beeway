<?php
  include'../private/dbconnect.php';
  session_start();
  // try {
    if ($_POST['groups'] == '' ) {
      $_SESSION['error'] = "vul ff iets in";
      header("location: ../index.php?page=groupstoevoegen");
    } elseif (checkForIllegalCharacters($_POST['groups'])) {
      $_SESSION['error'] = "illegal character used";
      header("location: ../index.php?page=groupstoevoegen");
    } else {
      $sql = "INSERT INTO groups (`groups`, `createdby`, `updatedby`) VALUES (:groups, :createdby, :updatedby)";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':groups', $_POST['groups']);
      $sth->bindParam(':createdby', $_SESSION['userid']);
      $sth->bindParam(':updatedby', $_SESSION['userid']);
      $sth->execute();
      $_SESSION['success'] = "added successful";
      header("location: ../index.php?page=klassenlijst");
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
