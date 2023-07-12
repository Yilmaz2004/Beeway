<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole'])) {
    try {

      //
      // code here
      //

    } catch (\Exception $e) {
      $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 6, 1, 0, 5)';
      $sth = $conn->prepare($sql);
      $sth->bindValue(':useragent', $_SESSION['useragent']);
      $sth->execute();

      $_SESSION['error'] = "er ging iets mis. Pech";
      header("Location: ../index.php?page=beewayarchivelijst");
    }
  } else {
    $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 6, 1, 0, 1)';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':useragent', $_SESSION['useragent']);
    $sth->execute();

    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('location: ../index.php?page=beewayarchivelijst');
    exit;
  }
?>
