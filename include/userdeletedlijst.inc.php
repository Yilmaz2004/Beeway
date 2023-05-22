<?php if (isset($_SESSION['userid']) && isset($_SESSION['userrol']) && $_SESSION['userrol'] == 'superuser' || $_SESSION['userrol'] == 'admin') { // check if user is logedin ?>
  <div class="beewaylijst">
      <?php if ($_SESSION['userrol'] == "superuser") { ?>
        <div class="beewaylijsttitel"><h1>Welkom op het super user dashboard</h1></div>
        <h2>deleted users</h2>

        <div class="beewaylijstopties">
          <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5"><u>Users</u></button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=scholenlijst';" id="beewaylijstopties5">Scholen</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=logslijst';" id="beewaylijstopties5">Site Logs</button>
      <?php } else if ($_SESSION['userrol'] == "admin") {?>
        <div class="beewaylijsttitel"><h1>Welkom op het admin dashboard</h1></div>
        <h2>beheer hier dingen (:</h2>

        <div class="beewaylijstopties">
          <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=klassenlijst';" id="beewaylijstopties4">Klassen</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=vakkenlijst';" id="beewaylijstopties2">Vakken</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=Hoofdthemalijst';" id="beewaylijstopties3">Hoofdthema's</button>
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
        $sql = 'SELECT u.*, s.schoolname FROM users as u, schools as s
                WHERE s.schoolid=u.schoolid
                AND u.userid<>0
                AND u.archive=1
                ORDER BY userid';
          $sth = $conn->prepare($sql);
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
            if ($users->role == "0") {$role = "docent";}
            else if ($users->role == "1") {$role = "school admin";}
            else {$role = "super user";}

            echo'
              <tr>
                <td><b>'.$users->firstname.' '.$users->lastname.'</b></td>
                <td><b>'.$users->email.'</b></td>
                <td><b>'.$role.'</b></td>
                <td><b>'; if ($users->schoolname == '') {echo'<i>(none)</i></b></td>';} else {echo $users->schoolname.'</b></td>';}
            echo '
                <td><b><i>(none)</i></b></td>
                <td><a href="php/getbackuser.php?userid='.$users->userid.'" class="editbutton">terug halen</a></td>
              </tr>
            ';
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
    include 'include/info.inc.php';
    include 'include/error.inc.php';

  } else {
    $_SESSION['error'] = "er ging iets mis. Pech!";
    header("location: php/logout.php");
  }
?>
