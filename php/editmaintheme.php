<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (!isset($_SESSION['userid']) || !isset($_SESSION['userrole']) || $_SESSION['userrole'] !== 'admin') {
      logErrorAndRedirect('Unauthorized access. Please log in with appropriate credentials.', '2', '2');
  }

  try {
      $requiredFields = array('namethemep1', 'namethemep2', 'namethemep3', 'namethemep4', 'namethemep5', 'schoolyear');
      foreach ($requiredFields as $field) {
          if (empty($_POST[$field])) {
              logErrorAndRedirect('Please fill in all fields.', '2', '4');
          } elseif (checkForIllegalCharacters($_POST[$field])) {
              logErrorAndRedirect('Illegal character used.', '2', '4');
          }
      }

      $userId = $_SESSION['userid'];

      $schoolId = getSchoolIdForUser($userId);
      if ($schoolId === false) {
          logErrorAndRedirect('Failed to retrieve school ID for the user.', '2', '4');
      }

      $mainThemeId = $_GET['mainthemeid'];
      $namethemep1 = $_POST['namethemep1'];
      $namethemep2 = $_POST['namethemep2'];
      $namethemep3 = $_POST['namethemep3'];
      $namethemep4 = $_POST['namethemep4'];
      $namethemep5 = $_POST['namethemep5'];
      $schoolYear = $_POST['schoolyear'];

      $sql = "UPDATE `maintheme` SET `schoolid`=:schoolid, `namethemep1`=:namethemep1, `namethemep2`=:namethemep2, `namethemep3`=:namethemep3, `namethemep4`=:namethemep4, `namethemep5`=:namethemep5, `schoolyear`=:schoolyear WHERE themeid=:themeid";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':schoolid', $schoolId);
      $sth->bindParam(':namethemep1', $namethemep1);
      $sth->bindParam(':namethemep2', $namethemep2);
      $sth->bindParam(':namethemep3', $namethemep3);
      $sth->bindParam(':namethemep4', $namethemep4);
      $sth->bindParam(':namethemep5', $namethemep5);
      $sth->bindParam(':schoolyear', $schoolYear);
      $sth->bindParam(':themeid', $mainThemeId);
      $sth->execute();

      if ($sth->rowCount() > 0) {
          logInteractionUpdate($userId, $mainThemeId);
          $_SESSION['info'] = "Updated successfully.";
          header("Location: ../index.php?page=hoofdthemalijst");
      } else {
          logErrorAndRedirect('Failed to update main theme.', '2', '4');
      }
  } catch (\Exception $e) {
      logErrorAndRedirect('An error occurred. Please try again.', '2', '4');
  }

  function checkForIllegalCharacters($str)
  {
      $illegalChars = array('<', '>', '{', '}', '(', ')', '[', ']', '*', '$', '^', '`', '~', '|', '\\', '\'', '"', ':', ';', ',', '/');
      foreach ($illegalChars as $char) {
          if (strpos($str, $char) !== false) {
              return true;
          }
      }
      return false;
  }

  function getSchoolIdForUser($userId)
  {
      global $conn;
      $sql = 'SELECT schoolid FROM users WHERE userid=:userid';
      $sth = $conn->prepare($sql);
      $sth->bindParam(':userid', $userId);
      $sth->execute();
      $school = $sth->fetch(PDO::FETCH_OBJ);
      return $school ? $school->schoolid : false;
  }

  function logErrorAndRedirect($errorMessage, $action, $tableId)
  {
      global $conn;
      $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, :action, :tableid, 0, 5)';
      $sth = $conn->prepare($sql);
      $sth->bindValue(':useragent', $_SESSION['useragent']);
      $sth->bindParam(':action', $action);
      $sth->bindParam(':tableid', $tableId);
      $sth->execute();
      $_SESSION['error'] = $errorMessage;
      header("Location: ../index.php?page=hoofdthemalijst");
      exit;
  }

  function logInteractionUpdate($userId, $interactionId)
  {
      global $conn;
      $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '2', '4', :interactionid)";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':userid', $userId);
      $sth->bindParam(':useragent', $_SESSION['useragent']);
      $sth->bindParam(':interactionid', $interactionId);
      $sth->execute();
  }
?>
