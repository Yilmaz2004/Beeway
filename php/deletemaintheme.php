<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole']) && $_SESSION['userrole'] === 'admin') {
    try {
      $loggedInUserId = $_SESSION['userid'];
      $themeId = $_GET['themeid'];
      $timestamp = time();
      $date_time = date('Y-m-d H:i:s', $timestamp);

      // Update maintheme table
      $sqlUpdateTheme = "UPDATE maintheme SET archive=1, deletedby=:deletedby, deletedat=:deletedat WHERE themeid=:themeid";
      $stmtUpdateTheme = $conn->prepare($sqlUpdateTheme);
      $stmtUpdateTheme->bindParam(':deletedby', $loggedInUserId);
      $stmtUpdateTheme->bindParam(':deletedat', $date_time);
      $stmtUpdateTheme->bindParam(':themeid', $themeId);
      $stmtUpdateTheme->execute();

      // Insert into logs table
      $sqlInsertLog = "INSERT INTO logs (userid, useragent, action, tableid, interactionid) VALUES (:userid, :useragent, 3, 4, :interactionid)";
      $stmtInsertLog = $conn->prepare($sqlInsertLog);
      $stmtInsertLog->bindParam(':userid', $_SESSION['userid']);
      $stmtInsertLog->bindParam(':useragent', $_SESSION['useragent']);
      $stmtInsertLog->bindParam(':interactionid', $themeId);
      $stmtInsertLog->execute();

      $_SESSION['info'] = "Archiving successful.";
      header("Location: ../index.php?page=hoofdthemalijst");
    } catch (\Exception $e) {
      // Error occurred while updating the database
      $sqlInsertErrorLog = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES (9999, :useragent, 3, 4, 0, 5)";
      $stmtInsertErrorLog = $conn->prepare($sqlInsertErrorLog);
      $stmtInsertErrorLog->bindParam(':useragent', $_SESSION['useragent']);
      $stmtInsertErrorLog->execute();

      $_SESSION['error'] = "Archiving failed.";
      header("Location: ../index.php?page=hoofdthemalijst");
    }
  } else {
    // Unauthorized access attempt
    $sqlInsertUnauthorizedLog = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES (9999, :useragent, 3, 4, 0, 1)";
    $stmtInsertUnauthorizedLog = $conn->prepare($sqlInsertUnauthorizedLog);
    $stmtInsertUnauthorizedLog->bindParam(':useragent', $_SESSION['useragent']);
    $stmtInsertUnauthorizedLog->execute();

    $_SESSION['error'] = "Unauthorized access. Please log in with appropriate credentials.";
    header("Location: ../index.php?page=vakkenlijst");
  }
?>
