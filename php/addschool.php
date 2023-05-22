<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrol']) && ($_SESSION['userrol'] === 'superuser' || $_SESSION['userrol'] === 'admin')) {
    // User has the necessary privileges
  } else {
    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('location: ../index.php?page=dashboard');
    exit;
  }

  // Check if all required fields are filled in
  if (empty($_POST['schoolname'])) {
    // If the school name field is empty, redirect back to the add user page with an error message
    $_SESSION['schoolnaam'] = $_POST['schoolnaam'];
    $_SESSION['error'] = 'Please fill in all required fields ';
    header('Location: ../index.php?page=addschool');
    exit;
  }

  // Check for illegal characters in user input
  if (strpbrk($_POST['schoolname'], '<>{()}[]*$^`~|\\\'":;,/')) {
    // If illegal characters are found in the school name, redirect back to the add user page with an error message
    $_SESSION['error'] = 'Illegal character used';
    header('Location: ../index.php?page=addschool');
    exit;
  }

  // Insert school into database
  try {
    // Begin a transaction to ensure the database is consistent if there is an error
    $conn->beginTransaction();

    // Prepare an SQL statement to insert the school into the schools table
    $sql = "INSERT INTO schools (`schoolname`, `createdby`, `updatedby`)
            VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$_POST['schoolname'], $_SESSION['userid'], $_SESSION['userid']]);

    // Get the ID of the newly inserted school
    $schoolid = $conn->lastInsertId();

    // Insert a school admin user into the database
    if ($schoolid) {
      $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '1', '5', :interactionid)";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':userid', $_SESSION['userid']);
      $sth->bindParam(':useragent', $_SESSION['useragent']);
      $sth->bindParam(':interactionid', $schoolid);
      $sth->execute();

      if (isset($_POST['schooladmin']) == 1) {
        // Create a temporary password for the school admin user
        $schooladminpassword = $_POST['schoolname'] . '2023!';
        // Hash the password
        $password = password_hash($schooladminpassword, PASSWORD_DEFAULT);

        // Prepare an SQL statement to insert the user into the users table
        $sql2 = "INSERT INTO users (`schoolid`, `firstname`, `lastname`, `email`, `password`, `role`, `createdby`, `updatedby`)
                VALUES (?, 'schooladmin', 'one', ?, ?, '1', ?, ?)";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute([$schoolid, $_POST['schoolname'], $password, $_SESSION['userid'], $_SESSION['userid']]);

        $userId = $conn->lastInsertId();

        $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`) VALUES (:userid, :useragent, '1', '6', :interactionid)";
        $sth = $conn->prepare($sql);
        $sth->bindParam(':userid', $_SESSION['userid']);
        $sth->bindParam(':useragent', $_SESSION['useragent']);
        $sth->bindParam(':interactionid', $userId);
        $sth->execute();

        // Commit the transaction
        $conn->commit();

        // Redirect to the school list page with a success message
        $_SESSION['info'] = 'School and user added successfully';
        header('Location: ../index.php?page=scholenlijst');
        exit;
      } else {
        // Commit the transaction
        $conn->commit();

        // Redirect to the school list page with a success message
        $_SESSION['info'] = 'School added successfully';
        header('Location: ../index.php?page=scholenlijst');
        exit;
      }
    } else {
      // If the school ID cannot be retrieved, throw an exception
      throw new Exception('Failed to insert user into database');
    }
  } catch (Exception $e) {
    // If there is an error, rollback the transaction and redirect back to the add user page with an error message
    $conn->rollback();

    $_SESSION['schoolnaam'] = $_POST['schoolnaam'];
    $_SESSION['error'] = 'Failed to add school';
    header('Location: ../index.php?page=addschool');
    exit;
  }

  function checkForIllegalCharacters($str) { // check for iliegal characters
    $illegalChars = array('<', '>', '{', '}', '(', ')', '[', ']', '*', '$', '^', '`', '~', '|', '\\', '\'', '"', ':', ';', ',', '/');
    foreach ($illegalChars as $char) {
      if (strpos($str, $char) !== false) {
        return true;
      }
    }
    return false;
  }
?>
