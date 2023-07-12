<?php
  session_start();
  require_once '../private/dbconnect.php';

  // Check if the beeway lock session is set and the user is not on the editbeewaytest page
  if (isset($_SESSION['beewaylock']) && $_SESSION['beewaylock'] === true && $page !== 'editbeewaytest') {
    // Update the lock to 0 in the database
    $stmt = $conn->prepare("UPDATE beeway SET `lock` = 0 WHERE `lock` = :userid");
    $stmt->bindValue(':userid', $_SESSION['userid'], PDO::PARAM_INT);
    $stmt->execute();

    // Unset the session variable
    unset($_SESSION['beewaylock']);
  }

  try {
    $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`) VALUES (:userid, :useragent, 5, 6, :interactionid)";
    $sth = $conn->prepare($sql);
    $sth->bindValue(':userid', $_SESSION['userid']);
    $sth->bindValue(':useragent', $_SESSION['useragent']);
    $sth->bindValue(':interactionid', $_SESSION['userid']);
    $sth->execute();
  } catch (\Exception $e) {
    $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES (:userid, :useragent, 5, "failed to proper logout, no userid set", 6, 0)';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':userid', '9999');
    $sth->bindValue(':useragent', $_SESSION['useragent']);
    $sth->execute();
  }

  session_unset();
  session_destroy();
  session_start();

  $_SESSION['info'] = "You have been logged out.";

  header('Location: ../index.php');
  exit;
?>
