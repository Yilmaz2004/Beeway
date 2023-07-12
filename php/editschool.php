<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (!isset($_SESSION['userid'], $_SESSION['userrole']) || $_SESSION['userrole'] !== 'superuser') {
      $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
      header('location: ../index.php?page=dashboard');
      exit;
  }

  try {
      if (empty($_POST['schoolname'])) {
          $_SESSION['error'] = "Please enter a school name.";
          redirectToEditSchool($_GET['schoolid']);
      } elseif (checkForIllegalCharacters($_POST['schoolname'])) {
          $_SESSION['error'] = "Illegal character used.";
          redirectToEditSchool($_GET['schoolid']);
      } else {
          $timestamp = time();
          $date_time = date('Y-m-d H:i:s', $timestamp);

          $schoolId = $_GET['schoolid'];
          $schoolname = $_POST['schoolname'];
          $updatedBy = $_SESSION['userid'];

          $sql = "UPDATE schools SET schoolname=:schoolname, updatedby=:updatedby, updatedat=:updatedat WHERE schoolid=:schoolid";
          $sth = $conn->prepare($sql);
          $sth->bindParam(':schoolname', $schoolname);
          $sth->bindParam(':updatedby', $updatedBy);
          $sth->bindParam(':updatedat', $date_time);
          $sth->bindParam(':schoolid', $schoolId);
          $sth->execute();

          if ($sth->rowCount() > 0) {
              logSchoolUpdate($schoolId);
              $_SESSION['info'] = 'School updated.';
              header('location: ../index.php?page=scholenlijst');
          } else {
              logError('Failed to update school.', '2', $schoolId);
              redirectToSchoolList('An error occurred. Please try again.');
          }
      }
  } catch (\Exception $e) {
      logError('An error occurred.', '2', $_GET['schoolid']);
      redirectToSchoolList('An error occurred. Please try again.');
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

  function redirectToEditSchool($schoolId)
  {
      header("Location: ../index.php?page=editschool&schoolid=$schoolId");
      exit;
  }

  function logSchoolUpdate($schoolId)
  {
      global $conn;

      $sql = "INSERT INTO logs (userid, useragent, action, tableid, interactionid) VALUES (:userid, :useragent, '2', '5', :interactionid)";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':userid', $_SESSION['userid']);
      $sth->bindParam(':useragent', $_SESSION['useragent']);
      $sth->bindParam(':interactionid', $schoolId);
      $sth->execute();
  }

  function redirectToSchoolList($errorMessage)
  {
      $_SESSION['error'] = $errorMessage;
      header("Location: ../index.php?page=scholenlijst");
      exit;
  }

  function logError($errorMessage, $action, $schoolId)
  {
      global $conn;

      $sql = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ('9999', :useragent, :action, '5', :interactionid, '5')";
      $sth = $conn->prepare($sql);
      $sth->bindValue(':useragent', $_SESSION['useragent']);
      $sth->bindParam(':action', $action);
      $sth->bindParam(':interactionid', $schoolId);
      $sth->execute();
  }
?>
