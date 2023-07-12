<?php if (isset($_SESSION['userid']) && isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'superuser' || $_SESSION['userrole'] == 'admin') { // check if user is logedin ?>
  <div class="beewaylijst">
    <?php if ($_SESSION['userrole'] == "superuser") { ?>
      <div class="beewaylijsttitel"><h1>Welkom op het super user dashboard</h1></div>
      <h2>deleted users</h2>

      <div class="beewaylijstopties">
        <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5"><u>Users</u></button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=scholenlijst';" id="beewaylijstopties5">Scholen</button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=logslijst';" id="beewaylijstopties5">Site Logs</button>
    <?php } else if ($_SESSION['userrole'] == "admin") {?>
      <div class="beewaylijsttitel"><h1>Welkom op het admin dashboard</h1></div>
      <h2>beheer hier dingen (:</h2>

      <div class="beewaylijstopties">
        <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=klassenlijst';" id="beewaylijstopties4">Groepen/Klassen</button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=vakkenlijst';" id="beewaylijstopties2">Vakken</button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=hoofdthemalijst';" id="beewaylijstopties3">Hoofdthema's</button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5"><u>Users</u></button>
    <?php } else { ?>
      <div class="beewaylijsttitel"><h1>Welkom op het docenten dashboard</h1></div>
      <h2>beheer hier dingen (:</h2>

      <div class="beewaylijstopties">
        <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
    <?php } ?>
    </div>

    <hr>

    <input style="width:200px;" type="text" id="myInput" onkeyup="myFunction()" placeholder="zoek op naam..." title="Type in a name">
    <script src="script/tablesearch.js"></script>

    <br>

    <?php
      if ($_SESSION['userrole'] == "admin") {
      $sql = 'SELECT u.*, s.schoolname
              FROM users as u
              JOIN schools as s ON s.schoolid = u.schoolid
              WHERE u.userid <> 0
              AND u.archive = 1
              AND u.schoolid = (
                SELECT schoolid
                FROM users
                WHERE userid = :userid
              )
              ORDER BY userid';
      $sth = $conn->prepare($sql);
      $sth->bindValue(':userid', $_SESSION['userid']);
      } elseif ($_SESSION['userrole'] == "superuser") {
      $sql = 'SELECT u.*, s.schoolname
              FROM users as u
              JOIN schools as s ON s.schoolid = u.schoolid
              WHERE u.userid <> 0
              AND u.archive = 1
              ORDER BY userid';
      $sth = $conn->prepare($sql);
      }

      $sth->execute();

      if ($sth->rowCount() > 0) {
      echo '<table class="beewaylijsttable">
              <tr>
                <th><h3>Naam</h3></th>
                <th><h3>Email</h3></th>
                <th><h3>Rol</h3></th>
                <th><h3>School</h3></th>
                <th><h3>groepen</h3></th>
              </tr>';

      while ($users = $sth->fetch(PDO::FETCH_OBJ)) {
        if ($users->role == "0") {
          $role = "docent";
        } elseif ($users->role == "1") {
          $role = "school admin";
        } else {
          $role = "super user";
        }

        echo '
              <tr>
                <td><b>'.$users->firstname.' '.$users->lastname.'</b></td>
                <td><b>'.$users->email.'</b></td>
                <td><b>'.$role.'</b></td>
                <td><b>'.($users->schoolname == '' ? '<i>(none)</i>' : $users->schoolname).'</b></td>
                <td><b><i>(none)</i></b></td>
                <td><a href="php/getbackuser.php?userid='.$users->userid.'" class="editbutton">terug halen</a></td>
              </tr>';
      }

      echo '</table>
            <hr>
            <br>
            <div class="tablebuttons">';
      } else {
      $_SESSION['error'] = "Er zijn geen resultaten gevonden. Pech!";
      }
      echo '</div>';
    ?>


    <br>
    <br>
  </div>

<?php
  } else {
    $_SESSION['error'] = "er ging iets mis. Pech!";
    header("Location: index.php?page=dashboard");
    exit;
  }

  require_once 'include/info.inc.php';
  require_once 'include/error.inc.php';
?>
