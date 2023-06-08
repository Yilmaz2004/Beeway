<?php
  require_once '../private/dbconnect.php';
  session_start();

  // try {
    if ($_POST['namethemep1'] == '' || $_POST['namethemep2'] == '' || $_POST['namethemep3'] == '' || $_POST['namethemep4'] == '' || $_POST['namethemep5'] == '' || $_POST['schoolyear'] == '') {
      $_SESSION['error'] = "vul ff iets in";
      header("location: ../index.php?page=addmaintheme");
    } elseif (checkForIllegalCharacters($_POST['namethemep1']) || checkForIllegalCharacters($_POST['namethemep2']) || checkForIllegalCharacters($_POST['namethemep3']) || checkForIllegalCharacters($_POST['namethemep4']) || checkForIllegalCharacters($_POST['namethemep5']) || checkForIllegalCharacters($_POST['schoolyear'])) {
      $_SESSION['error'] = "illegal character used";
      header("location: ../index.php?page=addmaintheme");
    } else {

      $sql = "select schoolid from users WHERE userid=:userid";
      $sth1 = $conn->prepare($sql);
      $sth1->bindParam(':userid', $_SESSION['userid']);
      $sth1->execute();

     while ($school = $sth1->fetch(PDO::FETCH_OBJ)) {

        $sql = "INSERT INTO maintheme (`schoolid`, `namethemep1`, `namethemep2`, `namethemep3`, `namethemep4`, `namethemep5`, `schoolyear`)
                VALUES (:schoolid, :namethemep1, :namethemep2, :namethemep3, :namethemep4, :namethemep5, :schoolyear)";
        $sth = $conn->prepare($sql);
        $sth->bindParam(':schoolid', $school->schoolid);
        $sth->bindParam(':namethemep1', $_POST['namethemep1']);
        $sth->bindParam(':namethemep2', $_POST['namethemep2']);
        $sth->bindParam(':namethemep3', $_POST['namethemep3']);
        $sth->bindParam(':namethemep4', $_POST['namethemep4']);
        $sth->bindParam(':namethemep5', $_POST['namethemep5']);
        $sth->bindParam(':schoolyear', $_POST['schoolyear']);
        $sth->execute();

         $lastInsertedId = $conn->lastInsertId();

   if ($lastInsertedId) {

       $sql = "INSERT INTO `logs` (`userid`, `action`, `tableid`, `interactionid`) VALUES (:userid, '1', '4', :interactionid)";
       $sth = $conn->prepare($sql);
       $sth->bindParam(':userid', $_SESSION['userid']);
       $sth->bindParam(':interactionid', $lastInsertedId);
       $sth->execute();

       $_SESSION['info'] = 'hoofdthema toegevoegd';
       header('location: ../index.php?page=hoofdthemalijst');

     } else {
       $_SESSION['error'] = 'er ging iets mis. Pech';
       header('location: ../index.php?page=hoofdthemalijst');
      }
    }
  }
  //  catch (\Exception $e) {
  //   $_SESSION['error'] = "er ging iets mis. Pech";
  //   header("location: ../index.php?page=userlijst");
  // }

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
