<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole'])) {
    $beewayid = $_GET['beewayid'];

    if (empty($_POST['beewaynaam']) || empty($_POST['groepen']) || empty($_POST['hoofdthemaid']) || empty($_POST['vakgebiedid'])) {
      // If the required fields are not filled in, redirect back to the add beeway page with an error message
      $_SESSION['error'] = 'Please fill in all required fields.';
      header('Location: ../index.php?page=editbeeway&beewayid=' . $beewayid);
      exit;
    }

    // Check for illegal characters in user input
    if (strpbrk($_POST['beewaynaam'], '<>{}[]$^`:;/')) {
      // If illegal characters are found in the beeway name, redirect back to the add beeway page with an error message
      $_SESSION['error'] = 'Illegal character used.';
      header('Location: ../index.php?page=editbeeway&beewayid=' . $beewayid);
      exit;
    }

    $beewaynaam = $_POST['beewaynaam'];
    $groepen = $_POST['groepen'];
    $hoofdthemaid = $_POST['hoofdthemaid'];
    $vakgebiedid = $_POST['vakgebiedid'];
    $concreetdoel = isset($_POST['concreetdoel']) ? $_POST['concreetdoel'] : '';
    $begoed = isset($_POST['begoed']) ? $_POST['begoed'] : '';
    $bevoldoende = isset($_POST['bevoldoende']) ? $_POST['bevoldoende'] : '';
    $beonvoldoende = isset($_POST['beonvoldoende']) ? $_POST['beonvoldoende'] : '';

    try {
      $conn->beginTransaction();

      // Update beeway
      $sql = "UPDATE beeway
              SET `begood` = :begoed,
                  `beenough` = :bevoldoende,
                  `benotgood` = :beonvoldoende,
                  `mainthemeid` = :mainthemeid,
                  `themeperiodid` = :mainthemeid,
                  `disciplineid` = :disciplineid,
                  `concretegoal` = :concreetdoel,
                  `updatedby` = :updatedby,
                  `groupid` = :groupid,
                  `beewayname` = :beewayname
              WHERE beewayid = :beewayid";
      $stmt = $conn->prepare($sql);
      $stmt->bindValue(':begoed', $begoed);
      $stmt->bindValue(':bevoldoende', $bevoldoende);
      $stmt->bindValue(':beonvoldoende', $beonvoldoende);
      $stmt->bindValue(':mainthemeid', $hoofdthemaid);
      $stmt->bindValue(':disciplineid', $vakgebiedid);
      $stmt->bindValue(':concreetdoel', $concreetdoel);
      $stmt->bindValue(':updatedby', $_SESSION['userid']);
      $stmt->bindValue(':groupid', $groepen);
      $stmt->bindValue(':beewayname', $beewaynaam);
      $stmt->bindValue(':beewayid', $beewayid);
      $stmt->execute();

      // Update beewayobservation
      if (isset($_POST['observation'])) {
        foreach ($_POST['observation'] as $observationid => $observation) {
          $sql = "UPDATE beewayobservation
                  SET `dataclass` = :dataclass,
                      `learninggoal` = :learninggoal,
                      `evaluation` = :evaluation,
                      `workgoal` = :workgoal,
                      `action` = :action
                  WHERE observationid = :observationid";
          $stmt = $conn->prepare($sql);
          $stmt->bindValue(':dataclass', $observation['dataclass']);
          $stmt->bindValue(':learninggoal', $observation['learninggoal']);
          $stmt->bindValue(':evaluation', $observation['evaluation']);
          $stmt->bindValue(':workgoal', $observation['workgoal']);
          $stmt->bindValue(':action', $observation['action']);
          $stmt->bindValue(':observationid', $observationid);
          $stmt->execute();
        }
      }

      // Update beewayplanning
      if (isset($_POST['planning'])) {
        foreach ($_POST['planning'] as $planningid => $planning) {
          $sql = "UPDATE beewayplanning
                  SET `planning` = :planning,
                      `planningwhat` = :planningwhat,
                      `planningwho` = :planningwho,
                      `planningdeadline` = :planningdeadline,
                      `planningdone` = :planningdone
                  WHERE planningid = :planningid";
          $stmt = $conn->prepare($sql);
          $stmt->bindValue(':planning', $planning['planning']);
          $stmt->bindValue(':planningwhat', $planning['planningwhat']);
          $stmt->bindValue(':planningwho', $planning['planningwho']);
          $stmt->bindValue(':planningdeadline', $planning['planningdeadline']);
          $stmt->bindValue(':planningdone', isset($planning['planningdone']) ? '1' : '0');
          $stmt->bindValue(':planningid', $planningid);
          $stmt->execute();
        }
      }

      $conn->commit();
      $_SESSION['info'] = 'Beeway updated successfully';
      header('Location: ../index.php?page=beewaylijst');
      exit;
    } catch (PDOException $e) {
      $conn->rollback();
      $_SESSION['error'] = 'Error updating beeway: ' . $e->getMessage();
      header('Location: ../index.php?page=editbeeway&beewayid=' . $beewayid);
      exit;
    }
  } else {
    $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 2, 1, :beewayid, 1)';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':useragent', $_SESSION['useragent']);
    $sth->bindValue(':beewayid', $beewayid);
    $sth->execute();

    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('location: ../index.php?page=dashboard');
    exit;
  }
?>
