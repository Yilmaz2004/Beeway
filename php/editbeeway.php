<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole'])) {
    // User has the necessary privileges
  } else {
    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('location: ../index.php?page=dashboard');
    exit;
  }

  // Check if all required fields are filled in
  if (empty($_POST['beewaynaam']) || empty($_POST['groepen']) || empty($_POST['hoofdthemaid']) || empty($_POST['vakgebiedid'])) {
    // If the school name field is empty, redirect back to the add user page with an error message
    $_SESSION['schoolnaam'] = $_POST['schoolnaam'];
    $_SESSION['error'] = 'Please fill in all required fields ';
    header('Location: ../index.php?page=addbeeway');
    exit;
  }

  // Check for illegal characters in user input
  if (strpbrk($_POST['beewaynaam'], '<>{}[]$^`:;/')) {
    // If illegal characters are found in the school name, redirect back to the add user page with an error message
    $_SESSION['error'] = 'Illegal character used';
    header('Location: ../index.php?page=addbeeway');
    exit;
  }

  // Insert school into database
  // try {
    $sql = 'SELECT schoolid
           FROM users
           WHERE schoolid<>0
           AND archive=0
           AND userid=:userid';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':userid', $_SESSION['userid']);
    $sth->execute();

    $result = $sth->fetch(); // Fetch the result from the executed query
    $schoolid = $result['schoolid']; // Access the schoolid value from the result array

    if ($schoolid) {
      // Begin a transaction to ensure the database is consistent if there is an error
      if (isset($_POST['concreetdoel'])) {$concreetdoel = $_POST['concreetdoel'];} else {$concreetdoel == '';}
      if (isset($_POST['begoed'])) {$begoed = $_POST['begoed'];} else {$begoed == '';}
      if (isset($_POST['bevoldoende'])) {$bevoldoende = $_POST['bevoldoende'];} else {$bevoldoende == '';}
      if (isset($_POST['beonvoldoende'])) {$beonvoldoende = $_POST['beonvoldoende'];} else {$beonvoldoende == '';}

      $groepen = $_POST['groepen'];
      $beewaynaam = $_POST['beewaynaam'];
      $hoofdthemaid = $_POST['hoofdthemaid'];
      $vakgebiedid = $_POST['vakgebiedid'];

      $conn->beginTransaction();

      try {
        $sql = "UPDATE beeway
                SET `begood`=:begoed,`beenough`=:bevoldoende,`benotgood`=:beonvoldoende,`mainthemeid`=1,`themeperiodid`=:mainthemeid,`disciplineid`=:disciplineid,`concretegoal`=:concreetdoel,`updatedby`=:updatedby,`schoolid`=:schoolid,`groupid`=:groupid,`beewayname`=:beewayname WHERE beewayid=:beewayid";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':schoolid', $schoolid);
        $stmt->bindValue(':groupid', $groepen);
        $stmt->bindValue(':beewayname', $beewaynaam);
        $stmt->bindValue(':begoed', $begoed);
        $stmt->bindValue(':bevoldoende', $bevoldoende);
        $stmt->bindValue(':beonvoldoende', $beonvoldoende);
        $stmt->bindValue(':mainthemeid', $hoofdthemaid);
        $stmt->bindValue(':disciplineid', $vakgebiedid);
        $stmt->bindValue(':concreetdoel', $concreetdoel);
        $stmt->bindValue(':updatedby', $_SESSION['userid']);
        $stmt->bindValue(':beewayid', $_GET['beewayid']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
          // Update was successful
          // Commit the transaction
          $conn->commit();

          // Insert log entry
          $sql = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`)
                  VALUES (:userid, :useragent, '2', '1', :interactionid)";
          $sth = $conn->prepare($sql);
          $sth->bindParam(':userid', $_SESSION['userid']);
          $sth->bindParam(':useragent', $_SESSION['useragent']);
          $sth->bindParam(':interactionid', $_GET['beewayid']);
          $sth->execute();

          // Redirect to the beeway list page with a success message
          $_SESSION['info'] = 'beeway updated successfully';
          header('Location: ../index.php?page=beewaylijst');
          exit;
        } else {
          // Update failed
          throw new Exception('Failed to update beeway into database');
        }
      } catch (Exception $e) {
        // An error occurred, rollback the transaction
        $conn->rollBack();
        throw $e; // You can handle the exception here or rethrow it
      }
    } else {
      throw new Exception('Failed to get schoolid');
    }

  // } catch (Exception $e) {
  //   // If there is an error, rollback the transaction and redirect back to the add user page with an error message
  //   $conn->rollback();
  //
  //   $_SESSION['schoolnaam'] = $_POST['schoolnaam'];
  //   $_SESSION['error'] = 'Failed to add beeway';
  //   header('Location: ../index.php?page=beewaylijst');
  //   exit;
  // }

?>