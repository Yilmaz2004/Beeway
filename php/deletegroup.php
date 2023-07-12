<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole']) && $_SESSION['userrole'] === 'admin') {
    try {
      $loggedInUserId = $_SESSION['userid'];
      $groupId = $_GET['groupid'];
      $timestamp = time();
      $date_time = date('Y-m-d H:i:s', $timestamp);

      // Update groups table
      $sqlUpdateGroup = "UPDATE `groups` SET archive=1, deletedby=:deletedby, deletedat=:deletedat WHERE groupid=:groupid";
      $stmtUpdateGroup = $conn->prepare($sqlUpdateGroup);
      $stmtUpdateGroup->bindParam(':deletedby', $loggedInUserId);
      $stmtUpdateGroup->bindParam(':deletedat', $date_time);
      $stmtUpdateGroup->bindParam(':groupid', $groupId);
      $stmtUpdateGroup->execute();

      // Insert into logs table
      $sqlInsertLog = "INSERT INTO logs (userid, useragent, action, tableid, interactionid) VALUES (:userid, :useragent, 3, 3, :interactionid)";
      $stmtInsertLog = $conn->prepare($sqlInsertLog);
      $stmtInsertLog->bindParam(':userid', $_SESSION['userid']);
      $stmtInsertLog->bindParam(':useragent', $_SESSION['useragent']);
      $stmtInsertLog->bindParam(':interactionid', $groupId);
      $stmtInsertLog->execute();

      $_SESSION['info'] = "Archiving successful.";
      header("Location: ../index.php?page=klassenlijst");
    } catch (\Exception $e) {
      // Error occurred while updating the database
      $sqlInsertErrorLog = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES (9999, :useragent, 3, 3, 0, 5)";
      $stmtInsertErrorLog = $conn->prepare($sqlInsertErrorLog);
      $stmtInsertErrorLog->bindParam(':useragent', $_SESSION['useragent']);
      $stmtInsertErrorLog->execute();

      $_SESSION['error'] = "Archiving failed.";
      header("Location: ../index.php?page=klassenlijst");
    }
  } else {
    // Unauthorized access attempt
    $sqlInsertUnauthorizedLog = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES (9999, :useragent, 3, 3, 0, 1)";
    $stmtInsertUnauthorizedLog = $conn->prepare($sqlInsertUnauthorizedLog);
    $stmtInsertUnauthorizedLog->bindParam(':useragent', $_SESSION['useragent']);
    $stmtInsertUnauthorizedLog->execute();

    $_SESSION['error'] = "Unauthorized access. Please log in with appropriate credentials.";
    header("Location: ../index.php?page=vakkenlijst");
  }
?>
