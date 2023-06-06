<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole']) && ($_SESSION['userid'] === '1' && ($_SESSION['userrole'] === 'superuser') { // User has the necessary privileges
    if ($_GET['schoolid'] == '0' || $_GET['schoolid'] == '1') {
      $_SESSION['error'] = 'Deze school  mag niet verijdert worden.';
      header('location: ../index.php?page=scholenlijst');
      exit;
    } else {
      if (isset($_GET['schoolid']) && $_GET['schoolid'] != '') {
        $timestamp = time();
        $date_time = date('Y-m-d H:i:s', $timestamp);

        $archive = 1;
        try {
          $sql = "UPDATE users SET archive=:archive, deletedby=:deletedby, deletedat=:deletedat
                  WHERE schoolid=:schoolid";
          $sth = $conn->prepare($sql);
          $sth->bindParam(':archive', $archive);
          $sth->bindParam(':deletedby', $_SESSION['userid']);
          $sth->bindParam(':deletedat', $date_time);
          $sth->bindParam(':userid', $_GET['userid']);
          $sth->execute();

          $sql2 = "INSERT INTO `logs` (`userid`, `useragent`, `action`, `tableid`, `interactionid`)
                  VALUES (:userid, :useragent, '3', '5', :interactionid)";
          $sth2 = $conn->prepare($sql2);
          $sth2->bindParam(':userid', $_SESSION['userid']);
          $sth2->bindParam(':useragent', $_SESSION['useragent']);
          $sth2->bindParam(':interactionid', $_GET['schoolid']);
          $sth2->execute();

          $_SESSION['info'] = 'school successvol verwijderd';
          header('Location: ../index.php?page=scholenlijst');
        } catch (\Exception $e) {
          $_SESSION['error'] = 'er ging iets mis, pech.';
          header("location: ../index.php?page=editschool&userid=".$_GET['schoolid']);
          exit;
        }
      }
    }
  } else {
    $_SESSION['error'] = 'Unauthorized access. Please log in with appropriate credentials.';
    header('location: ../index.php?page=dashboard');
    exit;
  }
?>
