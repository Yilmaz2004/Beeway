<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole']) && ($_SESSION['userrole'] === 'superuser' || $_SESSION['userrole'] === 'admin')) {
    // User has the necessary privileges
  } else {
    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('location: ../index.php?page=dashboard');
    exit;
  }

  try {
    if ($_POST['firstname'] == '' || $_POST['lastname'] == '' || $_POST['school'] == '0' || $_POST['email'] == '') {
      $_SESSION['error'] = "Please fill in all required fields.";
      header("location: ../index.php?page=edituser&userid=".$_GET['userid']);
    } elseif (checkForIllegalCharacters($_POST['firstname']) || checkForIllegalCharacters($_POST['lastname']) || checkForIllegalCharacters($_POST['email'])) {
      $_SESSION['error'] = "Illegal character used.";
      header("location: ../index.php?page=edituser&userid=".$_GET['userid']);
    } else {
      $timestamp = time();
      $date_time = date('Y-m-d H:i:s', $timestamp);

      // Check if the edited email already exists in the database
      $existingEmail = false;
      $editedEmail = $_POST['email'];
      $userId = $_GET['userid'];

      $sql = "SELECT COUNT(*) AS count FROM users WHERE email = :email AND userid <> :userid";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':email', $editedEmail);
      $sth->bindParam(':userid', $userId);
      $sth->execute();
      $count = $sth->fetchColumn();

      if ($count > 0) {
        $existingEmail = true;
        $_SESSION['error'] = 'Email already exists. Please choose a different email.';
        header("location: ../index.php?page=edituser&userid=".$_GET['userid']);
        exit;
      }

      if (!$existingEmail) {
        if (isset($_POST['password'])) {
          $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

          $sql = "UPDATE users SET firstname=:firstname, lastname=:lastname, email=:email, password=:password, updatedby=:updatedby, updatedat=:updatedat
                  WHERE userid=:userid";
          $sth = $conn->prepare($sql);
          $sth->bindParam(':firstname', $_POST['firstname']);
          $sth->bindParam(':lastname', $_POST['lastname']);
          $sth->bindParam(':email', $_POST['email']);
          $sth->bindParam(':password', $password);
          $sth->bindParam(':updatedby', $_SESSION['userid']);
          $sth->bindParam(':updatedat', $date_time);
          $sth->bindParam(':userid', $userId);
          $sth->execute();
        } else {
          $sql = "UPDATE users SET firstname=:firstname, lastname=:lastname, email=:email, updatedby=:updatedby, updatedat=:updatedat
                  WHERE userid=:userid";
          $sth = $conn->prepare($sql);
          $sth->bindParam(':firstname', $_POST['firstname']);
          $sth->bindParam(':lastname', $_POST['lastname']);
          $sth->bindParam(':email', $_POST['email']);
          $sth->bindParam(':updatedby', $_SESSION['userid']);
          $sth->bindParam(':updatedat', $date_time);
          $sth->bindParam(':userid', $userId);
          $sth->execute();
        }

        $sql = "UPDATE linkgroups SET archive=1
                WHERE userid=:userid
                AND archive<>1";
        $sth = $conn->prepare($sql);
        $sth->bindParam(':userid', $userId);
        $sth->execute();

        try {
          $selectedGroepen = $_POST['groepen'];

          foreach ($selectedGroepen as $groep) {
            $sql = "INSERT INTO `linkgroups` (`userid`, `groupid`) VALUES (:userid, :groupid)";
            $sth = $conn->prepare($sql);
            $sth->bindParam(':userid', $userId);
            $sth->bindParam(':groupid', $groep);
            $sth->execute();
          }
        } catch (\Exception $e) {
          $_SESSION['error'] = 'Failed to link groups.';
          header('location: ../index.php?page=userlijst');
          exit;
        }

        $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`)
                VALUES (:userid, :useragent, '2', '6', :interactionid)";
        $sth = $conn->prepare($sql);
        $sth->bindParam(':userid', $_SESSION['userid']);
        $sth->bindParam(':useragent', $_SESSION['useragent']);
        $sth->bindParam(':interactionid', $userId);
        $sth->execute();

        $_SESSION['info'] = 'User updated.';
        header('location: ../index.php?page=userlijst');
      }
    }
  } catch (\Exception $e) {
    $_SESSION['error'] = 'Something went wrong.';
    header("location: ../index.php?page=userlijst");
  }

  function checkForIllegalCharacters($str) { // check for illegal characters
    $illegalChars = array('<', '>', '{', '}', '(', ')', '[', ']', '*', '$', '^', '`', '~', '|', '\\', '\'', '"', ':', ';', ',', '/');
    foreach ($illegalChars as $char) {
      if (strpos($str, $char) !== false) {
        return true;
      }
    }
    return false;
  }
?>
