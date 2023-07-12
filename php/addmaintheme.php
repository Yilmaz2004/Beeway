<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole']) && ($_SESSION['userrole'] === 'superuser' || $_SESSION['userrole'] === 'admin')) {
    try {
      if (empty($_POST['namethemep1']) || empty($_POST['namethemep2']) || empty($_POST['namethemep3']) || empty($_POST['namethemep4']) || empty($_POST['namethemep5']) || empty($_POST['schoolyear'])) {
        $_SESSION['error'] = "Please fill in all required fields.";
        header("Location: ../index.php?page=addmaintheme");
        exit;
      } elseif (checkForIllegalCharacters($_POST['namethemep1']) || checkForIllegalCharacters($_POST['namethemep2']) || checkForIllegalCharacters($_POST['namethemep3']) || checkForIllegalCharacters($_POST['namethemep4']) || checkForIllegalCharacters($_POST['namethemep5']) || checkForIllegalCharacters($_POST['schoolyear'])) {
        $_SESSION['error'] = "Illegal character used.";
        header("Location: ../index.php?page=addmaintheme");
        exit;
      }

      $sql = "SELECT schoolid FROM users WHERE userid = :userid";
      $stmt1 = $conn->prepare($sql);
      $stmt1->bindParam(':userid', $_SESSION['userid']);
      $stmt1->execute();

      while ($school = $stmt1->fetch(PDO::FETCH_OBJ)) {
        $sql = "INSERT INTO maintheme (`schoolid`, `namethemep1`, `namethemep2`, `namethemep3`, `namethemep4`, `namethemep5`, `schoolyear`)
                VALUES (:schoolid, :namethemep1, :namethemep2, :namethemep3, :namethemep4, :namethemep5, :schoolyear)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':schoolid', $school->schoolid);
        $stmt->bindParam(':namethemep1', $_POST['namethemep1']);
        $stmt->bindParam(':namethemep2', $_POST['namethemep2']);
        $stmt->bindParam(':namethemep3', $_POST['namethemep3']);
        $stmt->bindParam(':namethemep4', $_POST['namethemep4']);
        $stmt->bindParam(':namethemep5', $_POST['namethemep5']);
        $stmt->bindParam(':schoolyear', $_POST['schoolyear']);
        $stmt->execute();

        $lastInsertedId = $conn->lastInsertId();

        if ($lastInsertedId) {
          $sql = "INSERT INTO `logs` (`userid`, `action`, `tableid`, `interactionid`) VALUES (:userid, '1', '4', :interactionid)";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':userid', $_SESSION['userid']);
          $stmt->bindParam(':interactionid', $lastInsertedId);
          $stmt->execute();

          $_SESSION['info'] = 'Main theme added successfully.';
          header('Location: ../index.php?page=hoofdthemalijst');
          exit;
        } else {
          $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 1, 4, 0, 5)';
          $stmt = $conn->prepare($sql);
          $stmt->bindValue(':useragent', $_SESSION['useragent']);
          $stmt->execute();

          $_SESSION['error'] = 'Failed to add main theme.';
          header('Location: ../index.php?page=hoofdthemalijst');
          exit;
        }
      }
    } catch (\Exception $e) {
      $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 1, 4, 0, 5)';
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':useragent', $_SESSION['useragent']);
      $stmt->execute();

      $_SESSION['error'] = 'An error occurred. Please try again.';
      header('Location: ../index.php?page=userlijst');
      exit;
    }
  } else {
    $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 1, 4, 0, 1)';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':useragent', $_SESSION['useragent']);
    $stmt->execute();

    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('Location: ../index.php?page=dashboard');
    exit;
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
