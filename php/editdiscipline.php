<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid']) && isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'admin') {
    if ($_POST['disciplinename'] == '') {
      $_SESSION['error'] = "Vul iets in.";
      header("Location: ../index.php?page=editdiscipline");
    } elseif (checkForIllegalCharacters($_POST['disciplinename'])) {
      $_SESSION['error'] = "Ongeoorloofd teken gebruikt.";
      header("Location: ../index.php?page=editdiscipline");
    } else {
      try {
        $sql = "UPDATE `disciplines`
                SET `disciplinename` = :disciplinename, `updatedby` = :updatedby
                WHERE `disciplineid` = :disciplineid";
        $sth = $conn->prepare($sql);
        $sth->bindParam(':disciplinename', $_POST['disciplinename']);
        $sth->bindParam(':updatedby', $_SESSION['userid']);
        $sth->bindParam(':disciplineid', $_GET['disciplineid']);
        $sth->execute();

        if ($sth->rowCount() > 0) {
          $sql1 = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`)
                   VALUES (:userid, :useragent, '2', '2', :interactionid)";
          $sth1 = $conn->prepare($sql1);
          $sth1->bindParam(':userid', $_SESSION['userid']);
          $sth1->bindParam(':useragent', $_SESSION['useragent']);
          $sth1->bindParam(':interactionid', $_GET['disciplineid']);
          $sth1->execute();

          $_SESSION['info'] = "Update succesvol.";
          header("Location: ../index.php?page=vakkenlijst");
        } else {
          $sql1 = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error)
                  VALUES ("9999", :useragent, 2, 2, 0, 5)';
          $sth1 = $conn->prepare($sql1);
          $sth1->bindValue(':useragent', $_SESSION['useragent']);
          $sth1->execute();

          $_SESSION['error'] = "Er is iets misgegaan. Probeer het opnieuw.";
          // header("Location: ../index.php?page=vakkenlijst");
        }
      } catch (\Exception $e) {
        $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error)
                VALUES ("9999", :useragent, 2, 2, 0, 5)';
        $sth = $conn->prepare($sql);
        $sth->bindValue(':useragent', $_SESSION['useragent']);
        $sth->execute();

        $_SESSION['error'] = "Er is iets misgegaan. Probeer het opnieuw.";
        header("Location: ../index.php?page=vakkenlijst");
      }
    }
  } else {
    $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error)
            VALUES ("9999", :useragent, 2, 2, 0, 1)';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':useragent', $_SESSION['useragent']);
    $sth->execute();

    $_SESSION['error'] = "Ongeoorloofde toegang. Log in met de juiste referenties.";
    header("Location: ../index.php?page=vakkenlijst");
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
