<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (!isset($_SESSION['userid'], $_SESSION['userrole']) || ($_SESSION['userrole'] !== 'superuser' && $_SESSION['userrole'] !== 'admin')) {
      $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
      header('location: ../index.php?page=dashboard');
      exit;
  }

  try {
      validateInput();

      $userId = $_GET['userid'];
      $editedEmail = $_POST['email'];

      // Check if the edited email already exists in the database
      $existingEmail = checkExistingEmail($editedEmail, $userId);

      if ($existingEmail) {
          redirectToEditUser('Email already exists. Please choose a different email.', $userId);
      }

      updateUser($userId);

      linkGroups($userId, $_POST['groepen']);

      logUserUpdate($userId);

      $_SESSION['info'] = 'User updated.';
      header('location: ../index.php?page=userlijst');
      exit;
  } catch (\Exception $e) {
      logError('Something went wrong.', '2', $userId);
      $_SESSION['error'] = 'Something went wrong.';
      header("Location: ../index.php?page=userlijst");
      exit;
  }

  function validateInput()
  {
      if (
          empty($_POST['firstname']) ||
          empty($_POST['lastname']) ||
          empty($_POST['email'])
      ) {
          redirectToEditUser('Please fill in all required fields.', $_GET['userid']);
      }

      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];

      if (
          checkForIllegalCharacters($firstname) ||
          checkForIllegalCharacters($lastname) ||
          checkForIllegalCharacters($email)
      ) {
          redirectToEditUser('Illegal character used.', $_GET['userid']);
      }
  }

  function checkExistingEmail($editedEmail, $userId)
  {
      global $conn;

      $sql = "SELECT COUNT(*) AS count FROM users WHERE email = :email AND userid <> :userid";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':email', $editedEmail);
      $sth->bindParam(':userid', $userId);
      $sth->execute();

      $count = $sth->fetchColumn();
      return $count > 0;
  }

  function updateUser($userId)
  {
      global $conn;

      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
      $email = $_POST['email'];
      $updatedBy = $_SESSION['userid'];
      $updatedAt = date('Y-m-d H:i:s');

      $sql = "UPDATE users SET firstname=:firstname, lastname=:lastname, email=:email, updatedby=:updatedby, updatedat=:updatedat WHERE userid=:userid";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':firstname', $firstname);
      $sth->bindParam(':lastname', $lastname);
      $sth->bindParam(':email', $email);
      $sth->bindParam(':updatedby', $updatedBy);
      $sth->bindParam(':updatedat', $updatedAt);
      $sth->bindParam(':userid', $userId);
      $sth->execute();

      if (!empty($_POST['password']) && strlen($_POST['password']) > 6) {
          $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

          $sql = "UPDATE users SET password=:password WHERE userid=:userid";
          $sth = $conn->prepare($sql);
          $sth->bindParam(':password', $password);
          $sth->bindParam(':userid', $userId);
          $sth->execute();
      }
  }


  function linkGroups($userId, $selectedGroepen)
  {
      global $conn;

      $conn->beginTransaction();

      $sql = "DELETE FROM linkgroups WHERE userid = :userid AND archive <> 1";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':userid', $userId);
      $sth->execute();

      $sql = "INSERT INTO linkgroups (userid, groupid) VALUES (:userid, :groupid)";
      $sth = $conn->prepare($sql);

      foreach ($selectedGroepen as $groep) {
          $sth->bindParam(':userid', $userId);
          $sth->bindParam(':groupid', $groep);
          $sth->execute();
      }

      $conn->commit();
  }

  function logUserUpdate($userId)
  {
      global $conn;

      $sql = "INSERT INTO logs (userid, useragent, action, tableid, interactionid) VALUES (:userid, :useragent, '2', '6', :interactionid)";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':userid', $_SESSION['userid']);
      $sth->bindParam(':useragent', $_SESSION['useragent']);
      $sth->bindParam(':interactionid', $userId);
      $sth->execute();
  }

  function redirectToEditUser($errorMessage, $userId)
  {
      $_SESSION['error'] = $errorMessage;
      header("Location: ../index.php?page=edituser&userid=$userId");
      exit;
  }

  function logError($errorMessage, $action, $userId)
  {
      global $conn;

      $sql = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ('9999', :useragent, :action, '6', :interactionid, '5')";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':useragent', $_SESSION['useragent']);
      $sth->bindParam(':action', $action);
      $sth->bindParam(':interactionid', $userId);
      $sth->execute();

      $_SESSION['error'] = $errorMessage;
      header("Location: ../index.php?page=userlijst");
      exit;
  }

  function checkForIllegalCharacters($str)
  {
      $illegalChars = array('<', '>', '{', '}', '(', ')', '[', ']', '*', '$', '^', '`', '~', '|', '\\', '\'', '"', ':', ';', ',', '/');
      foreach ($illegalChars as $char) {
          if (strpos($str, $char) !== false) {
              return true;
          }
      }
      return false;
  }
?>
