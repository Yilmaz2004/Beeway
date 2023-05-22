<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrol'], $_GET['userid']) && ($_SESSION['userrol'] === 'superuser' || $_SESSION['userrol'] === 'admin')) {
    $userId = $_GET['userid'];

    if ($userId == '0' || $userId == '1') {
      $_SESSION['error'] = 'Deze gebruiker kan niet worden verwijderd.';
      header('location: ../index.php?page=userlijst');
      exit;
    }

    $timestamp = time();
    $date_time = date('Y-m-d H:i:s', $timestamp);

    $archive = 1;

    try {
      $conn->beginTransaction();

      $sql = "UPDATE users SET archive = :archive, deletedby = :deletedby, deletedat = :deletedat WHERE userid=:userid";
      $sth = $conn->prepare($sql);
      $sth->execute([
        ':archive' => $archive,
        ':deletedby' => $_SESSION['userid'],
        ':deletedat' => $date_time,
        ':userid' => $userId
      ]);

      $sql1 = "UPDATE `linkgroups` SET `archive`='1'
              WHERE userid=:userid
              AND archive<>'1'";
      $sth1 = $conn->prepare($sql1);
      $sth1->execute([
        ':userid' => $userId
      ]);

      $sql2 = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '3', '6', :interactionid)";
      $sth2 = $conn->prepare($sql2);
      $sth2->execute([
        ':userid' => $_SESSION['userid'],
        ':useragent' => $_SESSION['useragent'],
        ':interactionid' => $userId
      ]);

      $conn->commit();

      $_SESSION['info'] = 'Gebruiker succesvol verwijderd.';
      header('Location: ../index.php?page=userlijst');
    } catch (\Exception $e) {
      $conn->rollBack();

      $_SESSION['error'] = 'Er ging iets mis, probeer het opnieuw.';
      header("location: ../index.php?page=edituser&userid={$userId}");
      exit;
    }
  } else {
    $_SESSION['error'] = 'Ongeautoriseerde toegang. Log in met de juiste referenties.';
    header('location: ../index.php?page=dashboard');
    exit;
  }
?>
