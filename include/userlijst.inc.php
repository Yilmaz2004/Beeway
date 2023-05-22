<?php if (isset($_SESSION['userid']) && isset($_SESSION['userrol']) && $_SESSION['userrol'] == 'superuser' || $_SESSION['userrol'] == 'admin') { // check if user is logedin ?>
  <div class="beewaylijst">
      <?php if ($_SESSION['userrol'] == "superuser") { ?>
        <div class="beewaylijsttitel"><h1>Welkom op het super user dashboard</h1></div>
        <h2>beheer hier dingen (:</h2>

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
        if (isset($_GET['offset'])) {
          $offset = $_GET['offset'] * 25;

          $sql = 'SELECT u.*, s.schoolname FROM users as u, schools as s
                  WHERE s.schoolid=u.schoolid
                  AND u.userid<>0
                  AND u.archive=0
                  ORDER BY userid
                  LIMIT 25 OFFSET '.intval($offset);
          $sth = $conn->prepare($sql);
          $sth->execute();
        } else {
          $sql = 'SELECT u.*, s.schoolname FROM users as u, schools as s
                  WHERE s.schoolid=u.schoolid
                  AND u.userid<>0
                  AND u.archive=0
                  ORDER BY userid
                  LIMIT 25';
          $sth = $conn->prepare($sql);
          $sth->execute();
        }

        if ($sth->rowCount() > 0) {
          echo '<table class="beewaylijsttable">
            <tr>
              <th><h3>Naam</h3></th>
              <th><h3>Email</h3></th>
              <th><h3>Rol</h3></th>
              <th><h3>School</h3></th>
              <th><h3>groepen</h3></th>
              <th><a href="index.php?page=adduser" class="addbutton">toevoegen</a></th>
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

              $sql1 = 'SELECT groups FROM groups as g, linkgroups as l
                      WHERE l.userid=:userid
                      AND g.groupid=l.groupid
                      AND g.archive<>"1"
                      AND l.archive<>"1"';
              $sth1 = $conn->prepare($sql1);
              $sth1->bindParam(':userid', $users->userid);
              $sth1->execute();

              if($sth1->rowCount() == 0) {
                echo "<td><b><i>(none)</i></b></td>.";
              } else {
                echo '<td><b>';
                $totalRows = $sth1->rowCount();
                $rowNum = 0;
                while ($groups = $sth1->fetch(PDO::FETCH_OBJ)) {
                  echo $groups->groups;
                  if (++$rowNum < $totalRows) {
                    echo ", ";
                  }
                }
                echo '</b></td>';
              }

            echo '
                <td><a href="index.php?page=edituser&userid='.$users->userid.'" class="editbutton">bewerken</a></td>
              </tr>
            ';
          }
          echo '</table>

          <hr>
          <br>

          <div class="tablebuttons">';
            if (isset($_GET['offset'])) {
              $pagina = $_GET['offset'] + 1;
              $terug = $_GET['offset'] - 1;
              $volgende = $_GET['offset'] + 1;
              if ($_GET['offset'] == '0') {
                echo '
                  <p style="margin:6px;">pagina: '.$pagina.'</p>
                  <a href="index.php?page=userlijst&offset='.$volgende.'" class="addbutton">volgende</a>
                ';
              } else {
                echo '
                  <a href="index.php?page='.$_GET['page'].'&offset='.$terug.'" class="addbutton">terug</a>
                  <p style="margin:6px;">pagina: '.$pagina.'</p>
                  <a href="index.php?page='.$_GET['page'].'&offset='.$volgende.'" class="addbutton">volgende</a>
                ';
              }
            } else {
              echo '
                <p style="margin:6px;">pagina: 1</p>
                <a href="index.php?page='.$_GET['page'].'&offset=1" class="addbutton">volgende</a>
              ';
            }
          echo '</div>';
        } else {
          // the query did not return any rows
          $pagina = $_GET['offset'] + 1;

          echo '<h2 style="text-align:center;"><strong>Er zijn geen resultaten gevonden</string></h2>';
          if (isset($_GET['offset']) && $_GET['offset'] >= '1') {
            $terug = $_GET['offset'] - 1;

            echo '
              <div class="tablebuttons">
                <a href="index.php?page='.$_GET['page'].'&offset='.$terug.'" class="addbutton">terug</a>
                <p style="margin:6px;">pagina: '.$pagina.'</p>
              </div>
              ';
          } else if (isset($_GET['offset'])) {
            echo '
              <div class="tablebuttons">
                <a href="index.php?page='.$_GET['page'].'&offset='.$terug.'" class="addbutton">terug</a>
                <p style="margin:6px;">pagina: '.$pagina.'</p>
              </div>
              ';
          }
          $_SESSION['error'] = "Er zijn geen resultaten gevonden. Pech!";
        }
      ?>

    <div class="seedeleted">
      <h3>bekijk verwijderde users: </h3>
      <a class="deletebutton" id="trashbutton2" href="index.php?page=usersdeletedlijst"><iconify-icon icon="tabler:trash"></iconify-icon></a>
    </div>
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
