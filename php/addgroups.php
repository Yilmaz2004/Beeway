<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole']) && ($_SESSION['userrole'] === 'superuser' || $_SESSION['userrole'] === 'admin')) {
    try {
      if (empty($_POST['groups'])) {
        $_SESSION['error'] = "Please fill in the group name.";
        header("Location: ../index.php?page=addgroups");
        exit;
      } elseif (checkForIllegalCharacters($_POST['groups'])) {
        $_SESSION['error'] = "Illegal character used.";
        header("Location: ../index.php?page=addgroups");
        exit;
      }

      $sql = "SELECT schoolid FROM users WHERE userid = :userid";
      $stmt1 = $conn->prepare($sql);
      $stmt1->bindParam(':userid', $_SESSION['userid']);
      $stmt1->execute();

      while ($school = $stmt1->fetch(PDO::FETCH_OBJ)) {
        $sql = "INSERT INTO groups (`groups`, `schoolid`, `createdby`, `updatedby`)
                VALUES (:groups, :schoolid, :createdby, :updatedby)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':groups', $_POST['groups']);
        $stmt->bindParam(':schoolid', $school->schoolid);
        $stmt->bindParam(':createdby', $_SESSION['userid']);
        $stmt->bindParam(':updatedby', $_SESSION['userid']);
        $stmt->execute();

        $groupid = $conn->lastInsertId();

        if ($groupid) {
          $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '1', '3', :interactionid)";
          $stmt = $conn->prepare($sql);
          $stmt->bindParam(':userid', $_SESSION['userid']);
          $stmt->bindParam(':useragent', $_SESSION['useragent']);
          $stmt->bindParam(':interactionid', $groupid);
          $stmt->execute();

          $_SESSION['info'] = "Group added successfully.";
          header("Location: ../index.php?page=klassenlijst");
          exit;
        } else {
          $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 1, 3, 0, 5)';
          $stmt = $conn->prepare($sql);
          $stmt->bindValue(':useragent', $_SESSION['useragent']);
          $stmt->execute();

          $_SESSION['error'] = "Failed to add group.";
          header("Location: ../index.php?page=addgroups");
          exit;
        }
      }
    } catch (\Exception $e) {
      $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 1, 3, 0, 5)';
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':useragent', $_SESSION['useragent']);
      $stmt->execute();

      $_SESSION['error'] = "An error occurred. Please try again.";
      header("Location: ../index.php?page=addgroups");
      exit;
    }
  } else {
    $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 1, 3, 0, 1)';
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
