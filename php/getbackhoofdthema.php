<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole'])) {
    try {
      $sql = "UPDATE maintheme SET archive = 0 WHERE themeid = :themeid";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':themeid', $_GET['themeid']);
      $sth->execute();

      $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES (9999, :useragent, 6, 6, :themeid, 0)';
      $sth = $conn->prepare($sql);
      $sth->bindValue(':useragent', $_SESSION['useragent']);
      $sth->bindParam(':themeid', $_GET['themeid']);
      $sth->execute();

      $_SESSION['info'] = 'user terug gehaald!';
      header('location: ../index.php?page=Hoofdthemalijst');
    } catch (\Exception $e) {
      $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES (9999, :useragent, 6, 4, :themeid, 5)';
      $sth = $conn->prepare($sql);
      $sth->bindValue(':useragent', $_SESSION['useragent']);
      $sth->bindParam(':themeid', $_GET['themeid']);
      $sth->execute();

      $_SESSION['error'] = "Something went wrong. Please try again.";
      header("Location: ../index.php?page=hoofdthemaarchivelijst");
      exit;
    }
  } else {
    $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES (9999, :useragent, 6, 6, 0, 1)';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':useragent', $_SESSION['useragent']);
    $sth->execute();

    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('location: ../index.php?page=hoofdthemaarchivelijst');
    exit;
  }
?>
