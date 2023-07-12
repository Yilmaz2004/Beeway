<?php
  require_once 'private/dbconnect.php';

  $sql = 'SELECT role, schoolid FROM users WHERE userid=:userid ';
  $sth = $conn->prepare($sql);
  $sth->bindParam(':userid', $_SESSION['userid']);
  $sth->execute();
  $user = $sth->fetch(PDO::FETCH_OBJ);

  if (!$user) {
    session_unset();
    session_destroy();
    session_start();

    try {
      $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `info`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '5', 'Unauthorized access, user does not exist or is archived', '6', :interactionid)";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':userid', $_SESSION['userid']);
      $sth->bindParam(':useragent', $_SESSION['useragent']);
      $sth->bindParam(':interactionid', $_SESSION['userid']);
      $sth->execute();
    } catch (\Exception $e) {
      $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 5, "failed to proper logout, no userid set", 6, 0, 5)';
      $sth = $conn->prepare($sql);
      $sth->bindValue(':useragent', $_SESSION['useragent']);
      $sth->execute();
    }

    $_SESSION['error'] = 'User not found or archived. Please log in again.';
    header('location: index.php?page=login');
    exit;
  }

  $userrole = $user->role;
  $userschoolid = $user->schoolid;

  if ($userrole !== '2') {
    if ($userschoolid !== 0) {
      $sql = 'SELECT COUNT(*) AS count FROM schools WHERE schoolid=:schoolid AND archive=0';
      $sth = $conn->prepare($sql);
      $sth->bindParam(':schoolid', $userschoolid);
      $sth->execute();
      $schoolCount = $sth->fetchColumn();

      if ($schoolCount === 0) {
        session_unset();
        session_destroy();
        session_start();

        try {
          $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `info`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '5', 'Unauthorized access, users school does not exist or is archived', '6', :interactionid)";
          $sth = $conn->prepare($sql);
          $sth->bindParam(':userid', $_SESSION['userid']);
          $sth->bindParam(':useragent', $_SESSION['useragent']);
          $sth->bindParam(':interactionid', $_SESSION['userid']);
          $sth->execute();
        } catch (\Exception $e) {
          $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 5, "failed to proper logout, no userid set", 6, 0, 5)';
          $sth = $conn->prepare($sql);
          $sth->bindValue(':useragent', $_SESSION['useragent']);
          $sth->execute();
        }

        $_SESSION['error'] = 'Invalid school. Please contact the administrator.';
        header('location: index.php?page=login');
        exit;
      }
    }
  }
?>
