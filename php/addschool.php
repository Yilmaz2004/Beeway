<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole']) && ($_SESSION['userrole'] === 'superuser')) {
    // Check if the school name field is empty
    if (empty($_POST['schoolname'])) {
      $_SESSION['schoolname'] = $_POST['schoolname'];
      $_SESSION['error'] = 'Please fill in all required fields.';
      header('Location: ../index.php?page=addschool');
      exit;
    }

    // Check for illegal characters in the school name
    if (strpbrk($_POST['schoolname'], '<>{()}[]*$^`~|\\\'":;,/')) {
      $_SESSION['error'] = 'Illegal character used.';
      header('Location: ../index.php?page=addschool');
      exit;
    }

    try {
      $conn->beginTransaction();

      $sqlInsertSchool = "INSERT INTO schools (schoolname, createdby, updatedby) VALUES (?, ?, ?)";
      $stmtInsertSchool = $conn->prepare($sqlInsertSchool);
      $stmtInsertSchool->execute([$_POST['schoolname'], $_SESSION['userid'], $_SESSION['userid']]);

      $schoolId = $conn->lastInsertId();

      if ($schoolId) {
        $sqlInsertLog = "INSERT INTO logs (userid, useragent, action, info, tableid, interactionid)
                         VALUES (:userid, :useragent, '1', 'school created', '5', :interactionid)";
        $stmtInsertLog = $conn->prepare($sqlInsertLog);
        $stmtInsertLog->bindParam(':userid', $_SESSION['userid']);
        $stmtInsertLog->bindParam(':useragent', $_SESSION['useragent']);
        $stmtInsertLog->bindParam(':interactionid', $schoolId);
        $stmtInsertLog->execute();

        if (isset($_POST['schooladmin']) && $_POST['schooladmin'] == 1) {
          $schoolName = $_POST['schoolname'];
          $schoolName = str_replace(' ', '', $schoolName); // Remove spaces from school name

          $schoolAdminPassword = $schoolName . '2023!';

          $hashedPassword = password_hash($schoolAdminPassword, PASSWORD_DEFAULT);

          $sqlInsertUser = "INSERT INTO users (schoolid, firstname, lastname, email, password, role, createdby, updatedby)
                            VALUES (?, 'schooladmin', 'one', ?, ?, '1', ?, ?)";
          $stmtInsertUser = $conn->prepare($sqlInsertUser);
          $stmtInsertUser->execute([$schoolId, $_POST['schoolname'], $hashedPassword, $_SESSION['userid'], $_SESSION['userid']]);

          $userId = $conn->lastInsertId();

          $sqlInsertUserLog = "INSERT INTO logs (userid, useragent, info, action, tableid, interactionid)
                               VALUES (:userid, :useragent, CONCAT('User added for new school ', :schoolid), '1', '6', :interactionid)";
          $stmtInsertUserLog = $conn->prepare($sqlInsertUserLog);
          $stmtInsertUserLog->bindParam(':userid', $_SESSION['userid']);
          $stmtInsertUserLog->bindParam(':useragent', $_SESSION['useragent']);
          $stmtInsertUserLog->bindParam(':schoolid', $schoolId);
          $stmtInsertUserLog->bindParam(':interactionid', $userId);
          $stmtInsertUserLog->execute();

          $conn->commit();

          $_SESSION['info'] = 'School and user added successfully.';
          header('Location: ../index.php?page=scholenlijst');
          exit;
        } else {
          $conn->commit();

          $_SESSION['info'] = 'School added successfully.';
          header('Location: ../index.php?page=scholenlijst');
          exit;
        }
      } else {
        throw new Exception('Failed to insert school into the database.');
      }
    } catch (Exception $e) {
      $conn->rollback();

      $sqlInsertErrorLog = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, error)
                            VALUES ('9999', :useragent, 1, 5, 0, 5)";
      $stmtInsertErrorLog = $conn->prepare($sqlInsertErrorLog);
      $stmtInsertErrorLog->bindValue(':useragent', $_SESSION['useragent']);
      $stmtInsertErrorLog->execute();

      $_SESSION['schoolname'] = $_POST['schoolname'];
      $_SESSION['error'] = 'Failed to add school.';
      header('Location: ../index.php?page=addschool');
      exit;
    }
  } else {
    $sqlInsertUnauthorizedLog = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, error)
                                 VALUES ('9999', :useragent, 1, 5, 0, 1)";
    $stmtInsertUnauthorizedLog = $conn->prepare($sqlInsertUnauthorizedLog);
    $stmtInsertUnauthorizedLog->bindValue(':useragent', $_SESSION['useragent']);
    $stmtInsertUnauthorizedLog->execute();

    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('Location: ../index.php?page=dashboard');
    exit;
  }
?>
