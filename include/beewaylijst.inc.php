<?php if (isset($_SESSION['userid']) && isset($_SESSION['userrol']) && $_SESSION['userrol'] == 'docent' || $_SESSION['userrol'] == 'admin') { // check if user is logedin ?>
  <div class="beewaylijst">
      <?php if ($_SESSION['userrol'] == "superuser") { ?>
        <div class="beewaylijsttitel"><h1>Welkom op het super user dashboard</h1></div>
        <h2>beheer hier dingen (:</h2>

        <div class="beewaylijstopties">
          <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=scholenlijst';" id="beewaylijstopties5">Scholen</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=logslijst';" id="beewaylijstopties5">Site Logs</button>
      <?php } else if ($_SESSION['userrol'] == "admin") {?>
        <div class="beewaylijsttitel"><h1>Welkom op het admin dashboard</h1></div>
        <h2>beheer hier dingen (:</h2>

        <div class="beewaylijstopties">
          <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1"><u>Beeway's</u></button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=klassenlijst';" id="beewaylijstopties4">Klassen</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=vakkenlijst';" id="beewaylijstopties2">Vakken</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=Hoofdthemalijst';" id="beewaylijstopties3">Hoofdthema's</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
      <?php } else { ?>
        <div class="beewaylijsttitel"><h1>Welkom op het docenten dashboard</h1></div>
        <h2>beheer hier jouw beeways</h2>

        <div class="beewaylijstopties">
          <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1"><u>Beeway's</u></button>
      <?php } ?>
    </div>

    <hr>

    <input style="width:200px;" type="text" id="myInput" onkeyup="myFunction()" placeholder="zoek op naam..." title="Type in a name">

    <script src="script/tablesearch.js"></script>

    <br>

      <?php
        $sql1 = 'SELECT schoolid FROM users WHERE userid=:userid';
        $sth1 = $conn->prepare($sql1);
        $sth1->bindParam(':userid', $_SESSION['userid']);
        $sth1->execute();

        if ($sth1->rowCount() > 0) {
          while ($user = $sth1->fetch(PDO::FETCH_OBJ)) {
            $schoolid = $user->schoolid;
          }
        }

        if (isset($_GET['offset'])) {
          $offset = $_GET['offset'] * 25;

          $sql = 'SELECT b.*, g.groups, m.namethemep1, d.disciplinename
                  FROM beeway AS b, groups AS g, maintheme AS m, disciplines as d
                  WHERE b.schoolid=:schoolid
                  AND g.groupid=b.groupid
                  AND m.themeid=b.mainthemeid
                  AND d.disciplineid=b.disciplineid
                  AND b.archive=0
                  ORDER BY b.beewayid
                  LIMIT 25 OFFSET '.intval($offset);
          $sth = $conn->prepare($sql);
          $sth->bindParam(':schoolid', $schoolid);
          $sth->execute();
        } else {
          $sql = 'SELECT b.*, g.groups, m.namethemep1, d.disciplinename
                  FROM beeway AS b, groups AS g, maintheme AS m, disciplines as d
                  WHERE b.schoolid=:schoolid
                  AND g.groupid=b.groupid
                  AND m.themeid=b.mainthemeid
                  AND d.disciplineid=b.disciplineid
                  AND b.archive=0
                  ORDER BY b.beewayid
                  LIMIT 25';
          $sth = $conn->prepare($sql);
          $sth->bindParam(':schoolid', $schoolid);
          $sth->execute();
        }

        if ($sth->rowCount() > 0) {
          echo '<table class="beewaylijsttable">
            <tr>
              <th><h3>Beeway Naam</h3></th>
              <th><h3>groep(en)</h3></th>
              <th><h3>vakgebied</h3></th>
              <th><h3>concreet doel</h3></th>
              <th><h3>status</h3></th>
              <th><a href="index.php?page=addbeeway" class="addbutton">toevoegen</a></th>
            </tr>';

          while ($beeway = $sth->fetch(PDO::FETCH_OBJ)) {
            if ($beeway->status == 0) { $status = "open"; }
            elseif ($beeway->status == 1) { $status = "closed"; }
            else { $status = "unknown"; }
            echo'
              <tr>
                <td><b>'.$beeway->beewayname.'</b></td>
                <td><b>'.$beeway->groups.'</b></td>
                <td><b>'.$beeway->disciplinename.'</b></td>

                <td><b>'.$beeway->concretegoal.'</b></td>
                <td><b>'.$status.'</b></td>
                <td><a href="index.php?page=editbeeway&userid='.$beeway->beewayid.'" class="editbutton">bewerken</a></td>
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
                  <a href="index.php?page='.$_GET['page'].'&offset='.$volgende.'" class="addbutton">volgende</a>
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
      <h3>bekijk verwijderde beeways: </h3>
      <a class="deletebutton" id="trashbutton2" href="index.php?page=beewaysdeletedlijst"><iconify-icon icon="tabler:trash"></iconify-icon></a>
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
