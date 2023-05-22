<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrol']) && ($_SESSION['userrol'] === 'superuser' || $_SESSION['userrol'] === 'admin')) {
    // User has the necessary privileges
  } else {
    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('location: ../index.php?page=dashboard');
    exit;
  }

  try {
    if ($_POST['firstname'] == '' || $_POST['lastname'] == '' || $_POST['school'] == '0' || $_POST['email'] == '') {
      $_SESSION['error'] = "vul ff iets in";
      header("location: ../index.php?page=edituser&userid=".$_GET['userid']);
    } elseif (checkForIllegalCharacters($_POST['firstname']) || checkForIllegalCharacters($_POST['lastname']) || checkForIllegalCharacters($_POST['email'])) {
      $_SESSION['error'] = "illegal character used";
      header("location: ../index.php?page=edituser&userid=".$_GET['userid']);
    } else {
      $timestamp = time();
      $date_time = date('Y-m-d H:i:s', $timestamp);

      if (isset($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "UPDATE users SET schoolid = :schoolid, firstname = :firstname, lastname = :lastname, email = :email, password = :password, updatedby = :updatedby, updatedat = :updatedat
                WHERE userid=:userid";
        $sth = $conn->prepare($sql);
        $sth->bindParam(':schoolid', $_POST['school']);
        $sth->bindParam(':firstname', $_POST['firstname']);
        $sth->bindParam(':lastname', $_POST['lastname']);
        $sth->bindParam(':email', $_POST['email']);
        $sth->bindParam(':password', $password);
        $sth->bindParam(':updatedby', $_SESSION['userid']);
        $sth->bindParam(':updatedat', $date_time);
        $sth->bindParam(':userid', $_GET['userid']);
        $sth->execute();
      } else {
        $sql = "UPDATE users SET schoolid = :schoolid, firstname = :firstname, lastname = :lastname, email = :email, updatedby = :updatedby, updatedat = :updatedat
                WHERE userid=:userid";
        $sth = $conn->prepare($sql);
        $sth->bindParam(':schoolid', $_POST['school']);
        $sth->bindParam(':firstname', $_POST['firstname']);
        $sth->bindParam(':lastname', $_POST['lastname']);
        $sth->bindParam(':email', $_POST['email']);
        $sth->bindParam(':updatedby', $_SESSION['userid']);
        $sth->bindParam(':updatedat', $date_time);
        $sth->bindParam(':userid', $_GET['userid']);
        $sth->execute();

      }

      // $lastInsertedId = $conn->lastInsertId();
      //
      // if ($lastInsertedId) {
          $sql = "UPDATE `linkgroups` SET `archive`='1'
                  WHERE userid=:userid
                  AND archive<>'1'";
          $sth = $conn->prepare($sql);
          $sth->bindParam(':userid', $_GET['userid']);
          $sth->execute();
        try {
          $selectedGroepen = $_POST['groepen'];

          foreach ($selectedGroepen as $groep) {
            $sql = "INSERT INTO `linkgroups` (`userid`, `groupid`) VALUES (:userid, :groupid)";
            $sth = $conn->prepare($sql);
            $sth->bindParam(':userid', $_GET['userid']);
            $sth->bindParam(':groupid', $groep);
            $sth->execute();
          }
        } catch (\Exception $e) {
          $_SESSION['error'] = 'kon geen groepen koppelen. Pech';
          header('location: ../index.php?page=userlijst');
          exit;
        }

        $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '2', '6', :interactionid)";
        $sth = $conn->prepare($sql);
        $sth->bindParam(':userid', $_SESSION['userid']);
        $sth->bindParam(':useragent', $_SESSION['useragent']);
        $sth->bindParam(':interactionid', $_GET['userid']);
        $sth->execute();

        $_SESSION['info'] = 'user aangepast';
        header('location: ../index.php?page=userlijst');
      // } else {
      //   $_SESSION['error'] = 'er ging iets mis. Pech';
      //   header('location: ../index.php?page=userlijst');
      // }
    }
  } catch (\Exception $e) {
    $_SESSION['error'] = "er ging iets mis. Pech";
    header("location: ../index.php?page=userlijst");
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
