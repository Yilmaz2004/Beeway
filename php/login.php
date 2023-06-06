<?php
  require_once '../private/dbconnect.php';
  session_start();

  try {
    // Validate the input fields
    $email = $_POST['email'];
    $password = $_POST['password'];
    $schoolId = $_POST['schoolselect'];

    if (empty($email) || empty($password)) {
      $_SESSION['error'] = 'Please fill in all fields.';
      header('Location: ../index.php?page=login');
      exit();
    }

    // Check for illegal characters in the input fields
    if (checkForIllegalCharacters([$email, $password])) {
      $_SESSION['error'] = 'Illegal characters used.';
      header('Location: ../index.php?page=login');
      exit();
    }

    // Check if the school exists and is not archived
    $sql = 'SELECT COUNT(*) AS count FROM schools WHERE schoolid = :schoolid AND archive = 0';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':schoolid', $schoolId);
    $sth->execute();
    $schoolCount = $sth->fetchColumn();

    if ($schoolCount === 0) {
      $_SESSION['error'] = 'Invalid school selected.';
      header('Location: ../index.php?page=login');
      exit();
    }

    // Get the user from the database
    $sql = 'SELECT role, userid, password FROM users WHERE email=:email AND schoolid=:schoolid AND archive=0';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':email', $email);
    $sth->bindValue(':schoolid', $schoolId);
    $sth->execute();
    $user = $sth->fetch(PDO::FETCH_OBJ);

    // Log the login attempt
    if ($user) {
      $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid) VALUES (:userid, :useragent, 4, 6, :interactionid)';
      $sth = $conn->prepare($sql);
      $sth->bindValue(':userid', $user->userid);
      $sth->bindValue(':useragent', $_SESSION['useragent']);
      $sth->bindValue(':interactionid', $user->userid);
      $sth->execute();
    }

    // Check if the user exists and the password is correct
    if (!$user || !password_verify($password, $user->password)) {
      $_SESSION['school'] = $schoolId;
      $_SESSION['email'] = $email;
      $_SESSION['error'] = 'Invalid school, email or password. Please try again.';
      header('Location: ../index.php?page=login');
      exit();
    }

    // Set the session variables based on the user role
    if ($user->role == 2) {
      $_SESSION['userrole'] = 'superuser';
    } elseif ($user->role == 1) {
      $_SESSION['userrole'] = 'admin';
    } else {
      $_SESSION['userrole'] = 'docent';
    }

    $_SESSION['userid'] = $user->userid;
    header('Location: ../index.php?page=dashboard');
    exit();
  } catch (\Exception $e) {
    $_SESSION['school'] = $schoolId;
    $_SESSION['email'] = $email;
    $_SESSION['error'] = "An error occurred. Please try again.";
    header("location: ../index.php?page=login");
  }

  // Check for illegal characters in an array of strings
  function checkForIllegalCharacters($strings) {
    $illegalChars = array('<', '>', '{', '}', '(', ')', '[', ']', '*', '$', '`', '|', '\\', '\'', '"', ':', ';', ',', '/');

    foreach ($strings as $str) {
      foreach ($illegalChars as $char) {
        if (strpos($str, $char) !== false) {
          return true;
        }
      }
    }

    return false;
  }
?>
