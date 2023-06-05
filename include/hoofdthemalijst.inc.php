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
          <button onclick="window.location.href='index.php?page=Hoofdthemalijst';" id="beewaylijstopties3"><u>Hoofdthema's</u></button>
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
      $sql = 'SELECT schoolid FROM users
              WHERE userid= :userid';
      $sth = $conn->prepare($sql);
      $sth->bindParam(':userid', $_SESSION['userid']);
      $sth->execute();
      while ($school = $sth->fetch(PDO::FETCH_OBJ)) {
        $schoolid = $school -> schoolid;
      }
        if (isset($_GET['offset'])) {
          $offset = $_GET['offset'] * 25;
        } else {
          $sql = 'SELECT * FROM maintheme
                  WHERE schoolid = :schoolid and archive = 0
                  LIMIT 25';
          $sth = $conn->prepare($sql);
          $sth->bindParam(':schoolid', $schoolid);
          $sth->execute();
        }
        if ($sth->rowCount() > 0) {
          echo '<table class="beewaylijsttable">
            <tr>
              <th><h3>Schooljaar</h3></th>
              <th><h3>Periode 1</h3></th>
              <th><h3>Periode 2</h3></th>
              <th><h3>Periode 3</h3></th>
              <th><h3>Periode 4</h3></th>
              <th><h3>Periode 5</h3></th>
              <th><h3>verwijderd</h3></th>
              <th><a href="index.php?page=hoofdthematoevoegen" class="addbutton">toevoegen</a></th>
            </tr>';
          while ($maintheme = $sth->fetch(PDO::FETCH_OBJ)) {
            if ($maintheme->archive == "1") {$archive = "yes";}
            else {$archive = "no";}

            if ($maintheme->schoolyear == "1") {$schoolyear = "2021/2022";}
            else if ($maintheme->schoolyear == "2") {$schoolyear = "2022/2023";}
            else if ($maintheme->schoolyear == "3") {$schoolyear = "2023/2024";}
            else if ($maintheme->schoolyear == "4") {$schoolyear = "2024/2025";}
            else if ($maintheme->schoolyear == "5") {$schoolyear = "2025/2026";}
            else if ($maintheme->schoolyear == "6") {$schoolyear = "2026/2027";}
            else if ($maintheme->schoolyear == "7") {$schoolyear = "2027/2028";}

            echo'
              <tr>
                <td><b>'.$schoolyear.'</b></td>
                <td><b>'.$maintheme->namethemep1.'</b></td>
                <td><b>'.$maintheme->namethemep2.'</b></td>
                <td><b>'.$maintheme->namethemep3.'</b></td>
                <td><b>'.$maintheme->namethemep4.'</b></td>
                <td><b>'.$maintheme->namethemep5.'</b></td>
                <td><b>'.$archive.'</b></td>
                <td><a href="index.php?page=hoofdthemabewerken&mainthemeid='.$maintheme->themeid.'" class="editbutton">bewerken</a></td>
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
                <a href="index.php?page=hoofdthemalijst&offset='.$volgende.'" class="addbutton">volgende</a>
              ';
          } else {
              echo '
                <a href="index.php?page=hoofdthemalijst&offset='.$terug.'" class="addbutton">terug</a>
                <a href="index.php?page=hoofdthemalijst&offset='.$volgende.'" class="addbutton">volgende</a>
              ';
          }
          } else {
            echo '
              <a href="index.php?page=hoofdthemalijst&offset=1" class="addbutton">volgende</a>
            ';
          }
            echo '</div>';
          } else {
          // the query did not return any rows
            echo '<h2><strong>the query did not return any rows</strong></h2>'; // Fix: Close the <strong> tag before closing the <h2> tag
          if (isset($_GET['offset']) && $_GET['offset'] >= '1') {
              $terug = $_GET['offset'] - 1;
              echo '<div class="tablebuttons"><a href="index.php?page=hoofdthemalijst&offset='.$terug.'" class="addbutton">terug</a></div>';
          } else if (isset($_GET['offset'])) {
              echo '<div class="tablebuttons"><a href="index.php?page=hoofdthemalijst" class="addbutton">terug</a></div>';
          }
            $_SESSION['error'] = "the query did not return any rows. Pech!";
          }
      ?>
    <hr>
    <a class="deletebutton" href="index.php?page=hoofdthemaarchive"><iconify-icon icon="mdi:trash-outline" style="font-size:20px"  ></iconify-icon></a>
  </div>
  <?php include 'include/error.inc.php'; ?>
<?php } else {
  $_SESSION['error'] = "er ging iets mis. Pech!";
  header("location: index.php?page=login");
} ?>
