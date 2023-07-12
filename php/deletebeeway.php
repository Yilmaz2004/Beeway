<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole']) ) {
    try {
      $beewayid = $_GET['beewayid']; // Get the beewayid from the URL
      $timestamp = time();
      $date_time = date('Y-m-d H:i:s', $timestamp);

      // Set the archive bit to 1 and update the deletedat and deletedby fields in the beeway table
      $sql = 'UPDATE beeway
              SET archive = 1, deletedat = NOW(), deletedby = :deletedby, deletedat=:deletedat
              WHERE beewayid = :beewayid';
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':deletedby', $_SESSION['userid']);
      $stmt->bindParam(':deletedat', $date_time);
      $stmt->bindValue(':beewayid', $beewayid);
      $stmt->execute();

      // Set the archive bit to 1 and update the deletedat and deletedby fields in the beewayplanning table
      $sql = 'UPDATE beewayplanning
              SET archive = 1, deletedat = NOW(), deletedby = :deletedby, deletedat=:deletedat
              WHERE beewayid = :beewayid';
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':deletedby', $_SESSION['userid']);
      $stmt->bindParam(':deletedat', $date_time);
      $stmt->bindValue(':beewayid', $beewayid);
      $stmt->execute();

      // Set the archive bit to 1 and update the deletedat and deletedby fields in the beewayobservation table
      $sql = 'UPDATE beewayobservation
              SET archive = 1, deletedat = NOW(), deletedby = :deletedby, deletedat=:deletedat
              WHERE beewayid = :beewayid';
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':deletedby', $_SESSION['userid']);
      $stmt->bindParam(':deletedat', $date_time);
      $stmt->bindValue(':beewayid', $beewayid);
      $stmt->execute();

      // Insert into logs table
      $sqlInsertLog = "INSERT INTO logs (userid, useragent, action, info, tableid, interactionid) VALUES (:userid, :useragent, 3, 'beeway deleted', 1, :interactionid)";
      $stmtInsertLog = $conn->prepare($sqlInsertLog);
      $stmtInsertLog->bindParam(':userid', $_SESSION['userid']);
      $stmtInsertLog->bindParam(':useragent', $_SESSION['useragent']);
      $stmtInsertLog->bindParam(':interactionid', $beewayid);
      $stmtInsertLog->execute();

      $_SESSION['info'] = "Archiving successful.";
      header("Location: ../index.php?page=beewaylijst");
    } catch (\Exception $e) {
      $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 3, 1, 0, 5)';
      $sth = $conn->prepare($sql);
      $sth->bindValue(':useragent', $_SESSION['useragent']);
      $sth->execute();

      $_SESSION['error'] = "er ging iets mis. Pech";
      header("Location: ../index.php?page=beewaylijst");
    }
  } else {
    $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 3, 1, 0, 1)';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':useragent', $_SESSION['useragent']);
    $sth->execute();

    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('location: ../index.php?page=beewaylijst');
    exit;
  }
?>
