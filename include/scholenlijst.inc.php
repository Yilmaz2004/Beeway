<?php if (isset($_SESSION['userrol'])) { // check if user is logedin ?>
  <div class="beewaylijst">
      <?php if ($_SESSION['userrol'] == "superuser") { ?>
        <div class="beewaylijsttitel"><h1>Welkom op het super user dashboard</h1></div>
        <h2>beheer hier dingen (:</h2>

        <div class="beewaylijstopties">
          <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=scholenlijst';" id="beewaylijstopties5"><u>Scholen</u></button>
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
          <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
      <?php } else { ?>
        <div class="beewaylijsttitel"><h1>Welkom op het docenten dashboard</h1></div>
        <h2>beheer hier dingen (:</h2>

        <div class="beewaylijstopties">
          <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
      <?php } ?>
    </div>

    <hr>

    <br>

      <?php
        if (isset($_GET['offset'])) {
          $offset = $_GET['offset'] * 4;

          $sql = 'SELECT * FROM schools
                  WHERE schoolid<>"0"
                  ORDER BY schoolid DESC
                  LIMIT 4 OFFSET '.intval($offset);
          $sth = $conn->prepare($sql);
          $sth->execute();
        } else {
          $sql = 'SELECT * FROM schools
                  WHERE schoolid<>"0"
                  ORDER BY schoolid DESC
                  LIMIT 4';
          $sth = $conn->prepare($sql);
          $sth->execute();
        }
        if ($sth->rowCount() > 0) {
          echo '<table class="beewaylijsttable">
            <tr>
              <th><h3>school naam</h3></th>
              <th><h3>geblokkeerd/verwijderd</h3></th>
              <th><a href="schooltoevoegen.html" class="addbutton">toevoegen</a></th>
            </tr>';
          while ($schools = $sth->fetch(PDO::FETCH_OBJ)) {
            if ($schools->archive == "1") {$archive = "yes";}
            else {$archive = "no";}

            echo'
              <tr>
                <td><b>'.$schools->schoolname.'</b></td>
                <td><b>'.$archive.'</b></td>
                <td><a href="schoolaanpassen.html" class="editbutton">bewerken</a></td>
              </tr>
            ';
          }
          echo '</table>

          <div class="tablebuttons">';
            if (isset($_GET['offset'])) {
              $terug = $_GET['offset'] - 1;
              $volgende = $_GET['offset'] + 1;
              if ($_GET['offset'] == '0') {
                echo '
                  <a href="index.php?page=scholenlijst&offset='.$volgende.'" class="addbutton">volgende</a>
                ';
              } else {
                echo '
                  <a href="index.php?page=scholenlijst&offset='.$terug.'" class="addbutton">terug</a>
                  <a href="index.php?page=scholenlijst&offset='.$volgende.'" class="addbutton">volgende</a>
                ';
              }
            } else {
              echo '
                <a href="index.php?page=scholenlijst&offset=1" class="addbutton">volgende</a>
              ';
            }
          echo '</div>';
        } else {
          // the query did not return any rows
          echo '<h2><strong>the query did not return any rows</string></h2>';
          if (isset($_GET['offset']) && $_GET['offset'] >= '1') {
            $terug = $_GET['offset'] - 1;

            echo '<div class="tablebuttons"><a href="index.php?page=scholenlijst&offset='.$terug.'" class="addbutton">terug</a></div>';
          } else if (isset($_GET['offset'])) {
            echo '<div class="tablebuttons"><a href="index.php?page=scholenlijst" class="addbutton">terug</a></div>';
          }
          $_SESSION['error'] = "the query did not return any rows. Pech!";
        }
      ?>


    <hr>
  </div>

  <?php include 'include/error.inc.php'; ?>
<?php } else {
  $_SESSION['error'] = "er ging iets mis. Pech!";
  header("location: index.php?page=login");
} ?>
