<?php
  session_start(); // start the session
  require_once '../private/dbconnect.php'; // require_once the database connection

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

  session_unset(); // remove all session variables
  session_destroy(); // destroy the session
  session_start(); // start a new session

  $_SESSION['info'] = "You have been logged out."; // set the session info message

  header('Location: ../index.php'); // redirect to the index page
  exit; // exit the script
?>
