<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole'], $_GET['userid']) && ($_SESSION['userrole'] === 'superuser' || $_SESSION['userrole'] === 'admin')) {
    $userId = $_GET['userid'];

    if ($userId === $_SESSION['userid']) {
      $_SESSION['error'] = 'U kunt uw eigen account niet verwijderen.';
      header('location: ../index.php?page=userlijst');
      exit;
    }

    if ($userId == '0' || $userId == '1') {
      $_SESSION['error'] = 'Deze gebruiker kan niet worden verwijderd.';
      header('location: ../index.php?page=userlijst');
      exit;
    }

    $loggedInUserId = $_SESSION['userid'];
    $loggedInUserRole = $_SESSION['userrole'];

    // Get the schoolid and role of the logged-in user
    $sql = 'SELECT schoolid, role FROM users WHERE userid=:userid';
    $sth = $conn->prepare($sql);
    $sth->bindParam(':userid', $loggedInUserId);
    $sth->execute();
    $loggedInUser = $sth->fetch(PDO::FETCH_OBJ);

    if (!$loggedInUser) {
      $_SESSION['error'] = 'Gebruiker niet gevonden.';
      header('location: ../index.php?page=userlijst');
      exit;
    }

    $loggedInUserSchoolId = $loggedInUser->schoolid;
    $loggedInUserRole = $loggedInUser->role;

    if ($loggedInUserRole === 'admin' && $loggedInUserSchoolId !== '0') {
      // Check if the logged-in user and the user being deleted are in the same school
      $sql = 'SELECT COUNT(*) AS count FROM users WHERE userid=:userid AND schoolid=:schoolid';
      $sth = $conn->prepare($sql);
      $sth->bindParam(':userid', $loggedInUserId);
      $sth->bindParam(':schoolid', $loggedInUserSchoolId);
      $sth->execute();
      $sameSchoolCount = $sth->fetchColumn();

      if ($sameSchoolCount === 0) {
        $_SESSION['error'] = 'Ongeautoriseerde toegang. U kunt alleen gebruikers verwijderen van uw eigen school.';
        insertLog($loggedInUserId, '1', $userId);
        header('location: ../index.php?page=userlijst');
        exit;
      }

      // Check if the user being deleted is the last school admin
      $sql = 'SELECT COUNT(*) AS count FROM users WHERE schoolid=:schoolid AND role=:role';
      $sth = $conn->prepare($sql);
      $sth->bindParam(':schoolid', $loggedInUserSchoolId);
      $sth->bindValue(':role', '1');
      $sth->execute();
      $schoolAdminCount = $sth->fetchColumn();

      if ($schoolAdminCount === 1 && $loggedInUserId === $userId) {
        $_SESSION['error'] = 'Er moet minimaal één schoolbeheerder zijn.';
        insertLog($loggedInUserId, '2', $userId);
        header('location: ../index.php?page=userlijst');
        exit;
      }
    }

    // Check if the user being deleted has role = 2
    $sql = 'SELECT role FROM users WHERE userid=:userid';
    $sth = $conn->prepare($sql);
    $sth->bindParam(':userid', $userId);
    $sth->execute();
    $userRole = $sth->fetchColumn();

    if ($userRole === '2') {
      $_SESSION['error'] = 'Deze gebruiker kan niet worden verwijderd.';
      header('location: ../index.php?page=userlijst');
      exit;
    }

    $timestamp = time();
    $date_time = date('Y-m-d H:i:s', $timestamp);

    $archive = 1;

    try {
      $conn->beginTransaction();

      $sql = "UPDATE users SET archive=:archive, deletedby=:deletedby, deletedat=:deletedat
              WHERE userid=:userid";
      $sth = $conn->prepare($sql);
      $sth->execute([
        ':archive' => $archive,
        ':deletedby' => $loggedInUserId,
        ':deletedat' => $date_time,
        ':userid' => $userId
      ]);

      $sql1 = "UPDATE linkgroups SET archive=1
              WHERE userid=:userid
              AND archive<>1";
      $sth1 = $conn->prepare($sql1);
      $sth1->execute([
        ':userid' => $userId
      ]);

      $sql2 = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`)
              VALUES (:userid, :useragent, '3', '6', :interactionid)";
      $sth2 = $conn->prepare($sql2);
      $sth2->execute([
        ':userid' => $loggedInUserId,
        ':useragent' => $_SESSION['useragent'],
        ':interactionid' => $userId
      ]);

      $conn->commit();

      $_SESSION['info'] = 'Gebruiker succesvol verwijderd.';
      header('Location: ../index.php?page=userlijst');
    } catch (\Exception $e) {
      $conn->rollBack();

      $_SESSION['error'] = 'Er ging iets mis, probeer het opnieuw.';
      insertLog($loggedInUserId, '3', $userId);
      header("location: ../index.php?page=edituser&userid={$userId}");
      exit;
    }
  } else {
    $_SESSION['error'] = 'Ongeautoriseerde toegang. Log in met de juiste referenties.';
    header('location: ../index.php?page=dashboard');
    exit;
  }

  // Function to insert logs
  function insertLog($userId, $errorCode, $interactionId) {
    global $conn;

    $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`, `errorcode`)
            VALUES (:userid, :useragent, '3', '6', :interactionid, :errorcode)";
    $sth = $conn->prepare($sql);
    $sth->execute([
      ':userid' => $userId,
      ':useragent' => $_SESSION['useragent'],
      ':interactionid' => $interactionId,
      ':errorcode' => $errorCode
    ]);
  }
?>
