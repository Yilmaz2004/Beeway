<?php
if (isset($_SESSION['userrole'])) { // controleer of de gebruiker is ingelogd
?>
<div class="beewaylijst">
    <?php if ($_SESSION['userrole'] == "superuser") { ?>
    <div class="beewaylijsttitel">
      <h1>Welkom op het super user dashboard</h1>
    </div>
    <h2>beheer hier dingen (:</h2>
    <div class="beewaylijstopties">
      <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
      <b>|</b>
      <button onclick="window.location.href='index.php?page=scholenlijst';" id="beewaylijstopties5"><u>Scholen</u></button>
      <b>|</b>
      <button onclick="window.location.href='index.php?page=logslijst';" id="beewaylijstopties5">Site Logs</button>
    </div>
    <?php } else if ($_SESSION['userrole'] == "admin") { ?>
    <div class="beewaylijsttitel">
        <h1>Welkom op het admin dashboard</h1>
    </div>
    <h2>beheer hier dingen (:</h2>
    <div class="beewaylijstopties">
      <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
      <b>|</b>
      <button onclick="window.location.href='index.php?page=klassenlijst';" id="beewaylijstopties4">Klassen</button>
      <b>|</b>
      <button onclick="window.location.href='index.php?page=vakkenlijst';" id="beewaylijstopties2"><u>Vakken</u></button>
      <b>|</b>
      <button onclick="window.location.href='index.php?page=Hoofdthemalijst';" id="beewaylijstopties3">Hoofdthema's</button>
      <b>|</b>
      <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
    <?php } else { ?>
    <div class="beewaylijsttitel">
      <h1>Welkom op het docenten dashboard</h1>
    </div>
    <h2>beheer hier dingen (:</h2>
    <div class="beewaylijstopties">
      <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
    </div>
    <?php } ?>
  </div>
  <hr>
  <br>
  <?php
    $sql = 'SELECT schoolid
         FROM users
         WHERE schoolid<>0
         AND archive=0
         AND userid=:userid';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':userid', $_SESSION['userid']);
    $sth->execute();

    $result = $sth->fetch(); // Fetch the result from the executed query
    $schoolid = $result['schoolid']; // Access the schoolid value from the result array

    if ($schoolid) {
      $sql = 'SELECT disciplinename, disciplineid FROM disciplines
              WHERE archive=0
              AND schoolid=:schoolid';
      $sth = $conn->prepare($sql);
      $sth->bindValue(':schoolid', $schoolid);
      $sth->execute();
      echo '
        <table class="beewaylijsttable">
        <tr>
          <th>
            <h3>vakken</h3>
            <th><a href="index.php?page=adddiscipline" class="addbutton">toevoegen</a></th>
          </th>
        </tr>
        ';
        while ($disciplines = $sth->fetch(PDO::FETCH_OBJ)) {
          echo '
            <tr>
              <td><b>'.$disciplines->disciplinename.'</b></td>
              <td><a href="index.php?page=editdiscipline&disciplineid='.$disciplines->disciplineid.'" class="editbutton">bewerken</a></td>
            </tr>
          ';
        }
        echo '</table>
        <hr>
        <br>
        <div class="tablebuttons"> ';
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
    } elseif (!isset($offset)) {
      $_SESSION['error'] = "Er zijn geen resultaten gevonden. Pech!";
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
      <h3>bekijk verwijderde vakken: </h3>
      <a class="deletebutton" id="trashbutton2" href="index.php?page=disciplinearchive"><iconify-icon icon="tabler:trash"></iconify-icon></a>
    </div>
    <br>
    <br>
  </div>
    <hr>
    </div>
  <?php
    require_once 'include/info.inc.php';
    require_once 'include/error.inc.php';
    } else {
      $_SESSION['error'] = "er ging iets mis. Pech!";
      header("location: php/logout.php");
    }
  ?>
