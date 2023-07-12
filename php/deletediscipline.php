<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole']) && $_SESSION['userrole'] === 'admin') {
    try {
      $loggedInUserId = $_SESSION['userid'];
      $disciplineId = $_GET['disciplineid'];
      $timestamp = time();
      $date_time = date('Y-m-d H:i:s', $timestamp);

      // Update disciplines table
      $sqlUpdateDiscipline = "UPDATE disciplines SET archive=1, deletedby=:deletedby, deletedat=:deletedat WHERE disciplineid=:disciplineid";
      $stmtUpdateDiscipline = $conn->prepare($sqlUpdateDiscipline);
      $stmtUpdateDiscipline->bindParam(':deletedby', $loggedInUserId);
      $stmtUpdateDiscipline->bindParam(':deletedat', $date_time);
      $stmtUpdateDiscipline->bindParam(':disciplineid', $disciplineId);
      $stmtUpdateDiscipline->execute();

      // Insert into logs table
      $sqlInsertLog = "INSERT INTO logs (userid, useragent, action, tableid, interactionid) VALUES (:userid, :useragent, 3, 2, :interactionid)";
      $stmtInsertLog = $conn->prepare($sqlInsertLog);
      $stmtInsertLog->bindParam(':userid', $_SESSION['userid']);
      $stmtInsertLog->bindParam(':useragent', $_SESSION['useragent']);
      $stmtInsertLog->bindParam(':interactionid', $disciplineId);
      $stmtInsertLog->execute();

      $_SESSION['info'] = "Archiving successful.";
      header("Location: ../index.php?page=vakkenlijst");
    } catch (\Exception $e) {
      // Error occurred while updating the database
      $sqlInsertErrorLog = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES (9999, :useragent, 3, 2, 0, 5)";
      $stmtInsertErrorLog = $conn->prepare($sqlInsertErrorLog);
      $stmtInsertErrorLog->bindValue(':useragent', $_SESSION['useragent']);
      $stmtInsertErrorLog->execute();

      $_SESSION['error'] = "Archiving failed.";
      header("Location: ../index.php?page=vakkenlijst");
    }
  } else {
    // Unauthorized access attempt
    $sqlInsertUnauthorizedLog = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES (9999, :useragent, 3, 2, 0, 1)";
    $stmtInsertUnauthorizedLog = $conn->prepare($sqlInsertUnauthorizedLog);
    $stmtInsertUnauthorizedLog->bindValue(':useragent', $_SESSION['useragent']);
    $stmtInsertUnauthorizedLog->execute();

    $_SESSION['error'] = "Unauthorized access. Please log in with appropriate credentials.";
    header("Location: ../index.php?page=vakkenlijst");
  }
?>
