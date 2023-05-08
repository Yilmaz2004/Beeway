<?php
  include'../private/dbconnect.php';
  session_start();

  try {
    if ($_POST['email'] == '' || $_POST['password'] == '' || $_POST['school'] == '') {
      $_SESSION['error'] = "fout, vul ff iets in";
      header("location: ../index.php?page=login");
    } elseif (checkForIllegalCharacters($_POST['email']) || checkForIllegalCharacters($_POST['password'])) {
      $_SESSION['error'] = "illegal character used";
      header("location: ../index.php?page=login");
    } else {
      if ($_POST['school'] == "0") {
        $sql = "SELECT role, userid, password FROM users WHERE email=:email AND schoolid='0' AND archive<>'1'";
        $sth = $conn->prepare($sql);
        $sth->bindParam(':email', $_POST['email']);
        $sth->execute();
      } else {
        $sql = "SELECT role, userid, password FROM users WHERE email=:email AND schoolid=:schoolid AND role<>'2' AND archive<>'1'";
        $sth = $conn->prepare($sql);
        $sth->bindParam(':email', $_POST['email']);
        $sth->bindParam(':schoolid', $_POST['school']);
        $sth->execute();
      }

      if ($user = $sth->fetch(PDO::FETCH_OBJ)) {
        $sql = "INSERT INTO `logs`(`userid`, `action`, `tableid`, `interactionid`) VALUES (:userid, '4', '6', :interactionid)";
        $sth = $conn->prepare($sql);
        $sth->bindParam(':userid', $user->userid);
        $sth->bindParam(':interactionid', $user->userid);
        $sth->execute();

        if (password_verify($_POST['password'], $user->password)) {
            echo 'Password is valid!';
            if (isset($user->role) && $user->role == '2') {
              $_SESSION['userrol'] = 'superuser';
              $_SESSION['userid'] = $user->userid;
              header('location: ../index.php?page=dashboard');
            } else if (isset($user->role) && $user->role == '1') {
              $_SESSION['userrol'] = 'admin';
              $_SESSION['userid'] = $user->userid;
              header('location: ../index.php?page=dashboard');
            } else {
              $_SESSION['userrol'] = 'docent';
              $_SESSION['userid'] = $user->userid;
              header('location: ../index.php?page=dashboard');
            }
        } else {
          header('location: ../index.php?page=login');
          $_SESSION['error'] = 'geen geldige login. Probeer het opnieuw!';
        }
      } else {
        header('location: ../index.php?page=login');
        $_SESSION['error'] = 'geen geldige login. Probeer het opnieuw!';
      }
    }
  } catch (\Exception $e) {
    $_SESSION['error'] = "er ging iets mis. Pech!";
    header("location: ../index.php?page=login");
  }

  function checkForIllegalCharacters($str) { // check for iliegal characters
  $illegalChars = array('<', '>', '{', '}', '(', ')', '[', ']', '*', '$', '`', '|', '\\', '\'', '"', ':', ';', ',', '/');
  foreach ($illegalChars as $char) {
    if (strpos($str, $char) !== false) {
      return true;
    }
  }
  return false;
}

?>
