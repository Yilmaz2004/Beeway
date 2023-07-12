<?php
  require_once '../private/dbconnect.php';
  session_start();

  // Check user privileges
  if (!(isset($_SESSION['userid'], $_SESSION['userrole']) && ($_SESSION['userrole'] === 'superuser' || $_SESSION['userrole'] === 'admin'))) {
    $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 1, 6, 0, 1)';
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':useragent', $_SESSION['useragent']);
    $stmt->execute();

    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('location: ../index.php?page=dashboard');
    exit;
  }

  // Check if all required fields are filled in
  $requiredFields = ['firstname', 'lastname', 'email', 'password'];
  foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
      $_SESSION['error'] = 'Please fill in all required fields.';
      header('Location: ../index.php?page=adduser');
      exit;
    }
  }

  // Check for illegal characters in user input
  $illegalCharacters = ['<', '>', '{', '}', '(', ')', '[', ']', '*', '$', '^', '`', '~', '|', '\\', '\'', '"', ':', ';', ',', '/'];
  $inputFields = ['firstname', 'lastname', 'email', 'password'];
  foreach ($inputFields as $field) {
    if (strpbrk($_POST[$field], implode('', $illegalCharacters))) {
      $_SESSION['error'] = 'Illegal character used.';
      header('Location: ../index.php?page=adduser');
      exit;
    }
  }

  try {
    $conn->beginTransaction();

    // Check if the role value is valid
    $role = $_POST['role'];
    if ($role !== '0' && $role !== '1') {
      $_SESSION['error'] = 'Invalid role selected.';
      header('Location: ../index.php?page=adduser');
      exit;
    }

    // Check if the email is already in use
    $email = $_POST['email'];
    $sqlEmailCount = 'SELECT COUNT(*) AS count FROM users WHERE email = :email';
    $stmtEmailCount = $conn->prepare($sqlEmailCount);
    $stmtEmailCount->bindValue(':email', $email);
    $stmtEmailCount->execute();
    $emailCount = $stmtEmailCount->fetchColumn();

    if ($emailCount > 0) {
      $_SESSION['error'] = 'Email already in use. Please choose a different email.';
      header('Location: ../index.php?page=adduser');
      exit;
    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($_SESSION['userrole'] === 'admin') {
      // Retrieve schoolid for admin user
      $adminId = $_SESSION['userid'];
      $sqlAdmin = 'SELECT schoolid FROM users WHERE userid = :adminId';
      $stmtAdmin = $conn->prepare($sqlAdmin);
      $stmtAdmin->bindValue(':adminId', $adminId);
      $stmtAdmin->execute();
      $schoolId = $stmtAdmin->fetchColumn();

      if (!$schoolId) {
        throw new Exception('Failed to retrieve schoolid for admin user.');
      }
    } else {
      $schoolId = $_POST['school'];
    }

    $sqlInsertUser = "INSERT INTO users (schoolid, firstname, lastname, email, password, role, createdby, updatedby)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtInsertUser = $conn->prepare($sqlInsertUser);
    $stmtInsertUser->execute([$schoolId, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $password, $_POST['role'], $_SESSION['userid'], $_SESSION['userid']]);

    $userId = $conn->lastInsertId();

    // Insert user into selected groups
    if ($userId) {
      $selectedGroups = $_POST['groepen'];

      foreach ($selectedGroups as $groupId) {
        $sqlInsertLinkGroup = "INSERT INTO linkgroups (userid, groupid)
                               VALUES (?, ?)";
        $stmtInsertLinkGroup = $conn->prepare($sqlInsertLinkGroup);
        $stmtInsertLinkGroup->execute([$userId, $groupId]);
      }

      $sqlInsertLog = "INSERT INTO logs (userid, useragent, action, info, tableid, interactionid)
                       VALUES (:userid, :useragent, '1', 'user added', '6', :interactionid)";
      $stmtInsertLog = $conn->prepare($sqlInsertLog);
      $stmtInsertLog->bindParam(':userid', $_SESSION['userid']);
      $stmtInsertLog->bindParam(':useragent', $_SESSION['useragent']);
      $stmtInsertLog->bindParam(':interactionid', $userId);
      $stmtInsertLog->execute();

      $conn->commit();

      $_SESSION['info'] = 'User added.';
      header('Location: ../index.php?page=userlijst');
      exit;
    } else {
      throw new Exception('Failed to insert user into the database.');
    }
  } catch (Exception $e) {
    $conn->rollback();

    $sqlInsertErrorLog = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 1, 6, 0, 5)';
    $stmtInsertErrorLog = $conn->prepare($sqlInsertErrorLog);
    $stmtInsertErrorLog->bindValue(':useragent', $_SESSION['useragent']);
    $stmtInsertErrorLog->execute();

    $_SESSION['error'] = 'Failed to add user.';
    header('Location: ../index.php?page=adduser');
    exit;
  }
?>
