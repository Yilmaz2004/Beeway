<?php
  require_once '../private/dbconnect.php';
  session_start();
  // try {
  if ($_POST['disciplinename'] == '' ) {
    $_SESSION['error'] = "vul ff iets in";
    header("location: ../index.php?page=editdiscipline");
  } elseif (checkForIllegalCharacters($_POST['disciplinename'])) {
    $_SESSION['error'] = "illegal character used";
    header("location: ../index.php?page=editdiscipline");
  } else {
       try {
         $sql = "UPDATE `disciplines` SET `disciplinename`=:disciplinename, `updatedby`=:updatedby
                WHERE disciplineid=:disciplineid";
         $sth = $conn->prepare($sql);
         $sth->bindParam(':disciplinename', $_POST['disciplinename']);
         $sth->bindParam(':updatedby', $_SESSION['userid']);
         $sth->bindParam(':disciplineid',$_GET['disciplineid']);
         $sth->execute();

         $disciplineid = $conn->lastInsertId();

         $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '2', '2', :interactionid)";
         $sth = $conn->prepare($sql);
         $sth->bindParam(':userid', $_SESSION['userid']);
         $sth->bindParam(':useragent', $_SESSION['useragent']);
         $sth->bindParam(':interactionid', $disciplineid);
         $sth->execute();


         $_SESSION['info'] = "updated successful";
         header("location: ../index.php?page=vakkenlijst");
       } catch (\Exception $e) {
         echo "string1 ".$e;
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
