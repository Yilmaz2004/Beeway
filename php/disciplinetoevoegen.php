<?php
  include'../private/dbconnect.php';
  session_start();

  // try {
    if ($_POST['disciplinename'] == '' ) {
      $_SESSION['error'] = "vul ff iets in";
      header("location: ../index.php?page=disciplinetoevoegen");
    } elseif (checkForIllegalCharacters($_POST['disciplinename'])) {
      $_SESSION['error'] = "illegal character used";
      header("location: ../index.php?page=disciplinetoevoegen");
    } else {
      $sql = "INSERT INTO disciplines (`disciplinename`, `createdby`, `updatedby`) VALUES (:disciplinename, :createdby, :updatedby)";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':disciplinename', $_POST['disciplinename']);
      $sth->bindParam(':createdby', $_SESSION['userid']);
      $sth->bindParam(':updatedby', $_SESSION['userid']);
      $sth->execute();
      $_SESSION['success'] = "added successful";
      header("location: ../index.php?page=vakkenlijst");
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
