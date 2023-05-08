<?php
  include'../private/dbconnect.php';
  session_start();

  // try {
    if ($_POST['firstname'] == '' || $_POST['lastname'] == '' || $_POST['role'] == '' || $_POST['email'] == '' || $_POST['password'] == '') {
      $_SESSION['error'] = "vul ff iets in";
      header("location: ../index.php?page=adduser");
    } elseif (checkForIllegalCharacters($_POST['firstname']) || checkForIllegalCharacters($_POST['lastname']) || checkForIllegalCharacters($_POST['email']) || checkForIllegalCharacters($_POST['password'])) {
      $_SESSION['error'] = "illegal character used";
      header("location: ../index.php?page=login");
    } else {
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $sql = "INSERT INTO users (`schoolid`, `firstname`, `lastname`, `email`, `password`, `role`) VALUES ('1', :firstname, :lastname, :email, :password, :role)";
      $sth = $conn->prepare($sql);
      $sth->bindParam(':firstname', $_POST['firstname']);
      $sth->bindParam(':lastname', $_POST['lastname']);
      $sth->bindParam(':role', $_POST['role']);
      $sth->bindParam(':email', $_POST['email']);
      $sth->bindParam(':password', $password);
      $sth->execute();

      // if ($user = $sth->fetch(PDO::FETCH_OBJ)) {
      //   if (isset($user->role) && $user->role == '2') {
      //     $_SESSION['userid'] = $user->role;
      //     header('location: ../index.php?page=dashboard');
      //   } else if (isset($user->role) && $user->role == '1') {
      //     $_SESSION['userid'] = $user->role;
      //     header('location: ../index.php?page=dashboard');
      //   } else {
      //     $_SESSION['userid'] = $user->userid;
      //     // echo "<pre>", print_r($_SESSION),"</pre>";
      //     header('location: ../index.php?page=dashboard');
      //   }
      // } else {
      //   header('location: ../index.php?page=login');
      //   $_SESSION['error'] = 'Fout, geen geldige login. Probeer opnieuw';
      // }
    }
  // } catch (\Exception $e) {
  //   // $_SESSION['error'] = "Fout, er ging iets mis. Pech";
  //   // header("location: ../index.php?page=login");
  //   echo "string";
  // }

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
