<?php
  require_once 'php/authcheck.php';

  if (isset($_SESSION['userid']) && isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'superuser' || $_SESSION['userrole'] == 'admin') { // check if user is logedin
    $currentURL = $_SERVER['REQUEST_URI'];
    $modifiedURL = str_replace('/beewayphp/', '', $currentURL);

    if (!isset($_GET['offset'])) {
      header("Location: ".$modifiedURL."&offset=0");
      exit;
    }
?>

  <div class="beewaylijst">
      <?php if ($_SESSION['userrole'] == "superuser") { ?>
        <div class="beewaylijsttitel"><h1>Welkom op het super user dashboard</h1></div>
        <h2>beheer hier dingen (:</h2>

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
      global $userrole, $userschoolid;

      // Check if the schoolid is set in the URL
      if (isset($_GET['schoolid'])) {
        $selectedSchoolID = $_GET['schoolid'];
      } else {
        $selectedSchoolID = null;
      }

      if (isset($_GET['offset'])) {
        $offset = $_GET['offset'] * 25;

        try {
          if ($userrole == 2) { // userlist for superuser
            $sql = 'SELECT u.*, s.schoolname FROM users as u, schools as s
                    WHERE s.schoolid=u.schoolid
                    AND u.userid<>0
                    AND u.userid<>9999
                    AND u.archive=0';

            if ($selectedSchoolID) {
              $sql .= ' AND u.schoolid=:selectedSchoolID';
            }

            $sql .= ' ORDER BY userid LIMIT 25 OFFSET :offset';

            $sth = $conn->prepare($sql);
            $sth->bindParam(':offset', $offset, PDO::PARAM_INT);

            if ($selectedSchoolID) {
              $sth->bindParam(':selectedSchoolID', $selectedSchoolID);
            }

            $sth->execute();
          } elseif ($userrole == 1) { // userlist for school admin
            $sql = 'SELECT u.*, s.schoolname FROM users as u, schools as s
                    WHERE u.schoolid=:schoolid
                    AND s.schoolid=u.schoolid
                    AND u.userid<>0
                    AND u.userid<>9999
                    AND u.role<>2
                    AND u.archive=0';

            if ($selectedSchoolID) {
              $sql .= ' AND u.schoolid=:selectedSchoolID';
            }

            $sql .= ' ORDER BY userid LIMIT 25 OFFSET :offset';

            $sth = $conn->prepare($sql);
            $sth->bindParam(':schoolid', $userschoolid);
            $sth->bindParam(':offset', $offset, PDO::PARAM_INT);

            if ($selectedSchoolID) {
              $sth->bindParam(':selectedSchoolID', $selectedSchoolID);
            }

            $sth->execute();
          } else { // no access to userlist
            $_SESSION['error'] = "Unauthorized access. Please log in with appropriate credentials";
            header("Location: index.php?page=dashboard");
            exit;
          }
        } catch (PDOException $e) {
          // Handle database errors
          die("Database Error: " . $e->getMessage());
        }
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
                  <td><b>';

          if ($users->schoolname == '') {
            echo '<i>(none)</i></b></td>';
          } else {
            echo $users->schoolname.'</b></td>';
          }

          $sql1 = 'SELECT groups FROM groups as g, linkgroups as l
                    WHERE l.userid=:userid
                    AND g.groupid=l.groupid
                    AND g.archive=0
                    AND l.archive=0';

          $sth1 = $conn->prepare($sql1);
          $sth1->bindParam(':userid', $users->userid);
          $sth1->execute();

          if ($sth1->rowCount() == 0) {
            echo "<td><b><i>(none)</i></b></td>";
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

          echo '<td><a href="index.php?page=edituser&userid='.$users->userid.'" class="editbutton">bewerken</a></td>
                </tr>';
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

          echo '<h2 style="text-align:center;"><strong>Er zijn geen resultaten gevonden</strong></h2>';
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
      <a class="deletebutton" id="trashbutton2" href="index.php?page=userarchivelijst"><iconify-icon icon="tabler:trash"></iconify-icon></a>
    </div>
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
