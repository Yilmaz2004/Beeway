<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole']) && ($_SESSION['userrole'] === 'admin')) {
    try {
      if (isset($_GET['beewayid'])) {
        $beewayId = $_GET['beewayid'];

        $sql = "UPDATE beeway SET `lock`=0 WHERE beewayid=:beewayid";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':beewayid', $beewayId);
        $stmt->execute();

        $_SESSION['info'] = "Beeway unlocked";
        header("Location: ../index.php?page=beewaylijst");
      } else {
        $_SESSION['error'] = "beewayid klopt niet. Pech";
        header("Location: ../index.php?page=beewaylijst");
      }

    } catch (\Exception $e) {
      $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 2, 1, 0, 5)';
      $sth = $conn->prepare($sql);
      $sth->bindValue(':useragent', $_SESSION['useragent']);
      $sth->execute();

      $_SESSION['error'] = "er ging iets mis. Pech";
      header("Location: ../index.php?page=beewaylijst");
    }
  } else {
    $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 2, 1, 0, 1)';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':useragent', $_SESSION['useragent']);
    $sth->execute();

    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('location: ../index.php?page=beewaylijst');
    exit;
  }
?>
