<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole']) && ($_SESSION['userrole'] === 'superuser' || $_SESSION['userrole'] === 'admin')) {
    try {
      // Check if the user is an admin
      if ($_SESSION['userrole'] !== 'admin') {
        $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
        header('Location: ../index.php?page=dashboard');
        exit;
      }

      // Retrieve schoolid from the database based on userid
      $sql = "SELECT schoolid FROM users WHERE userid = :userid";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':userid', $_SESSION['userid']);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($result === false) {
        $sql = 'INSERT INTO logs (userid, useragent, action, info, tableid, interactionid, error) VALUES ("9999", :useragent, 1, "userid not found", 2, 0, 5)';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':useragent', $_SESSION['useragent']);
        $stmt->execute();

        $_SESSION['error'] = "Unable to fetch user's schoolid.";
        header("Location: ../index.php?page=adddiscipline");
        exit;
      }

      $schoolid = $result['schoolid'];

      // Proceed with the rest of the code
      if (empty($_POST['disciplinename'])) {
        $_SESSION['error'] = "Please fill in the discipline name.";
        header("Location: ../index.php?page=adddiscipline");
        exit;
      } elseif (checkForIllegalCharacters($_POST['disciplinename'])) {
        $_SESSION['error'] = "Illegal character used.";
        header("Location: ../index.php?page=adddiscipline");
        exit;
      }

      $disciplinename = $_POST['disciplinename'];

      $sql = "INSERT INTO disciplines (`schoolid`, `disciplinename`, `createdby`, `updatedby`)
              VALUES (:schoolid, :disciplinename, :createdby, :updatedby)";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':schoolid', $schoolid);
      $stmt->bindParam(':disciplinename', $disciplinename);
      $stmt->bindParam(':createdby', $_SESSION['userid']);
      $stmt->bindParam(':updatedby', $_SESSION['userid']);
      $stmt->execute();

      $disciplineid = $conn->lastInsertId();

      if ($disciplineid) {
        $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '1', '2', :interactionid)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $_SESSION['userid']);
        $stmt->bindParam(':useragent', $_SESSION['useragent']);
        $stmt->bindParam(':interactionid', $disciplineid);
        $stmt->execute();

        $_SESSION['info'] = "Discipline added successfully.";
        header("Location: ../index.php?page=vakkenlijst");
        exit;
      } else {
        $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 1, 4, 0, 5)';
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':useragent', $_SESSION['useragent']);
        $stmt->execute();

        $_SESSION['error'] = "An error occurred while adding the discipline.";
        header("Location: ../index.php?page=adddiscipline");
        exit;
      }
    } catch (\Exception $e) {
      $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 1, 4, 0, 5)';
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':useragent', $_SESSION['useragent']);
      $stmt->execute();

      $_SESSION['error'] = "An error occurred. Please try again.";
      header("Location: ../index.php?page=adddiscipline");
      exit;
    }
  } else {
    $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 6, 6, 0, 1)';
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
