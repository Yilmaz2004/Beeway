<?php
  require_once 'private/dbconnect.php';
  // session_start();

  // Check if the logged-in user exists and is not archived
  $sql = 'SELECT role, schoolid FROM users WHERE userid=:userid AND archive=0';
  $sth = $conn->prepare($sql);
  $sth->bindParam(':userid', $_SESSION['userid']);
  $sth->execute();
  $user = $sth->fetch(PDO::FETCH_OBJ);

  if (!$user) {
    session_unset(); // remove all session variables
    session_destroy(); // destroy the session
    session_start(); // start a new session

    try {
      // Prepare the SQL statement for logging user activity
      $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '5', '6', :interactionid)";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':userid', $_SESSION['userid']); // bind the session userid to the SQL statement
      $sth->bindParam(':useragent', $_SESSION['useragent']); // bind the session useragent to the SQL statement
      $sth->bindParam(':interactionid', $_SESSION['userid']); // bind the session userid to the SQL statement
      $sth->execute(); // execute the SQL statement
    } catch (\Exception $e) {
      // handle any exceptions thrown during logging (in this case, do nothing)
      // $_SESSION['error'] = "Pech";
    }

    $_SESSION['error'] = 'User not found or archived. Please log in again.';
    header('location: index.php?page=login');
    exit;
  }

  $userrole = $user->role;
  $userschoolid = $user->schoolid;

  if ($userrole !== '2') {
    // Check if the school is valid
    if ($userschoolid !== '0') {
      $sql = 'SELECT COUNT(*) AS count FROM schools WHERE schoolid=:schoolid AND archive=0';
      $sth = $conn->prepare($sql);
      $sth->bindParam(':schoolid', $userschoolid);
      $sth->execute();
      $schoolCount = $sth->fetchColumn();

      if ($schoolCount === 0) {
        session_unset(); // remove all session variables
        session_destroy(); // destroy the session
        session_start(); // start a new session

        try {
          // Prepare the SQL statement for logging user activity
          $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '5', '6', :interactionid)";
          $sth = $conn->prepare($sql);
          $sth->bindParam(':userid', $_SESSION['userid']); // bind the session userid to the SQL statement
          $sth->bindParam(':useragent', $_SESSION['useragent']); // bind the session useragent to the SQL statement
          $sth->bindParam(':interactionid', $_SESSION['userid']); // bind the session userid to the SQL statement
          $sth->execute(); // execute the SQL statement
        } catch (\Exception $e) {
          // handle any exceptions thrown during logging (in this case, do nothing)
          // $_SESSION['error'] = "Pech";
        }

        $_SESSION['error'] = 'Invalid school. Please contact the administrator.';
        header('location: index.php?page=login');
        exit;
      }
    }
  }
?>
