<?php
  require_once '../private/dbconnect.php';
  session_start();

  // Check user privileges
  if (!(isset($_SESSION['userid'], $_SESSION['userrole']) && ($_SESSION['userrole'] === 'superuser' || $_SESSION['userrole'] === 'admin'))) {
    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('location: ../index.php?page=dashboard');
    exit;
  }

  // Check if all required fields are filled in
  $requiredFields = ['firstname', 'lastname', 'email', 'password'];
  foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
      $_SESSION['school'] = $_POST['school'];
      $_SESSION['firstname'] = $_POST['firstname'];
      $_SESSION['lastname'] = $_POST['lastname'];
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['error'] = 'Please fill in all required fields';
      header('Location: ../index.php?page=adduser');
      exit;
    }
  }

  // Check for illegal characters in user input
  $illegalCharacters = ['<', '>', '{', '}', '(', ')', '[', ']', '*', '$', '^', '`', '~', '|', '\\', '\'', '"', ':', ';', ',', '/'];
  $inputFields = ['firstname', 'lastname', 'email', 'password'];
  foreach ($inputFields as $field) {
    if (strpbrk($_POST[$field], implode('', $illegalCharacters))) {
      $_SESSION['error'] = 'Illegal character used';
      header('Location: ../index.php?page=adduser');
      exit;
    }
  }

  try {
    $conn->beginTransaction();

    // Check if the role value is valid
    $role = $_POST['role'];
    if ($role !== '0' && $role !== '1') {
      $_SESSION['school'] = $_POST['school'];
      $_SESSION['firstname'] = $_POST['firstname'];
      $_SESSION['lastname'] = $_POST['lastname'];
      $_SESSION['email'] = $_POST['email'];
      $_SESSION['error'] = 'Invalid role selected';
      header('Location: ../index.php?page=adduser');
      exit;
    }

    // Check if the email is already in use
    $email = $_POST['email'];
    $sql = 'SELECT COUNT(*) AS count FROM users WHERE email = :email';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':email', $email);
    $sth->execute();
    $emailCount = $sth->fetchColumn();

    if ($emailCount > 0) {
      $_SESSION['school'] = $_POST['school'];
      $_SESSION['firstname'] = $_POST['firstname'];
      $_SESSION['lastname'] = $_POST['lastname'];
      $_SESSION['error'] = 'Email already in use. Please choose a different email.';
      header('Location: ../index.php?page=adduser');
      exit;
    }

    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if ($_SESSION['userrole'] === 'admin') {
      // Retrieve schoolid for admin user
      $adminId = $_SESSION['userid'];
      $sqlAdmin = 'SELECT schoolid FROM users WHERE userid = :adminId';
      $sthAdmin = $conn->prepare($sqlAdmin);
      $sthAdmin->bindValue(':adminId', $adminId);
      $sthAdmin->execute();
      $schoolId = $sthAdmin->fetchColumn();

      if (!$schoolId) {
        throw new Exception('Failed to retrieve schoolid for admin user');
      }
    } else {
      $schoolId = $_POST['school'];
    }

    $sql = "INSERT INTO users (`schoolid`, `firstname`, `lastname`, `email`, `password`, `role`, `createdby`, `updatedby`)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$schoolId, $_POST['firstname'], $_POST['lastname'], $_POST['email'], $password, $_POST['role'], $_SESSION['userid'], $_SESSION['userid']]);

    $userId = $conn->lastInsertId();

    // Insert user into selected groups
    if ($userId) {
      $selectedGroups = $_POST['groepen'];

      foreach ($selectedGroups as $groupId) {
        $sql = "INSERT INTO `linkgroups` (`userid`, `groupid`)
                VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $groupId]);
      }

      $sql2 = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`)
              VALUES (:userid, :useragent, '1', '6', :interactionid)";
      $sth2 = $conn->prepare($sql2);
      $sth2->bindParam(':userid', $_SESSION['userid']);
      $sth2->bindParam(':useragent', $_SESSION['useragent']);
      $sth2->bindParam(':interactionid', $userId);
      $sth2->execute();

      $conn->commit();

      $_SESSION['info'] = 'User added';
      header('Location: ../index.php?page=userlijst');
      exit;
    } else {
      throw new Exception('Failed to insert user into database');
    }
  } catch (Exception $e) {
    $conn->rollback();

    $_SESSION['school'] = $_POST['school'];
    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['lastname'] = $_POST['lastname'];
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['error'] = 'Failed to add user';
    header('Location: ../index.php?page=adduser');
    exit;
  }
?>
