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
        <button onclick="window.location.href='index.php?page=klassenlijst';" id="beewaylijstopties5">Site Logs</button>
    </div>
    <?php } else if ($_SESSION['userrole'] == "admin") { ?>
    <div class="beewaylijsttitel">
        <h1>Welkom op het admin dashboard</h1>
    </div>
    <h2>beheer hier dingen (:</h2>
    <div class="beewaylijstopties">
        <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=klassenlijst';" id="beewaylijstopties4"><u>klassen</u></button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=vakkenlijst';" id="beewaylijstopties2">Vakken</button>
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
  $sql = 'SELECT groups, groupid FROM groups
          WHERE archive=0';
  $sth = $conn->prepare($sql);
  $sth->execute();
  echo '<table class="beewaylijsttable">
    <tr>
        <th>
            <h3>groepen</h3>
            <th><a href="index.php?page=addgroups" class="addbutton">toevoegen</a></th>
        </th>
    </tr>';
    while ($groups = $sth->fetch(PDO::FETCH_OBJ)) {
      echo '
        <tr>
            <td><b>'.$groups->groups.'</b></td>
            <td><a id="groupsdelete" onclick="return confirm(\'Weet je zeker dat je deze groep wilt verwijderen!?\')" href="php/groupsverwijderen.php?groupid='.$groups->groupid.'" class="deletebutton">groep verwijderen</a></td>
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
                <a href="index.php?page=klassenlijst&offset='.$volgende.'" class="addbutton">volgende</a>
            ';
        } else {
            echo '
                <a href="index.php?page=klassenlijst&offset='.$terug.'" class="addbutton">terug</a>
                <p style="margin:6px;">pagina: '.$pagina.'</p>
                <a href="index.php?page=klassenlijst&offset='.$volgende.'" class="addbutton">volgende</a>
            ';
        }
    } else {
        echo '
            <p style="margin:6px;">pagina: 1</p>
            <a href="index.php?page=klassenlijst&offset=1" class="addbutton">volgende</a>
        ';
    }
    echo '</div>';
    } else {
        // de query heeft geen rijen geretourneerd
        $pagina = $_GET['offset'] + 1;
        echo '<h2 style="text-align:center;"><strong>Er zijn geen resultaten gevonden</strong></h2>';
        if (isset($_GET['offset']) && $_GET['offset'] >= '1') {
            $terug = $_GET['offset'] - 1;
            echo '
                <div class="tablebuttons">
                    <p style="margin:6px;">pagina: '.$pagina.'</p>
                    <a href="index.php?page=klassenlijst&offset='.$terug.'" class="addbutton">terug</a>
                </div>
            ';
        } else if (isset($_GET['offset'])) {
            echo '
                <div class="tablebuttons">
                    <p style="margin:6px;">pagina: '.$pagina.'</p>
                    <a href="index.php?page=klassenlijst&offset='.$terug.'" class="addbutton">terug</a>
                </div>
            ';
        }
        $_SESSION['error'] = "Er zijn geen resultaten gevonden. Pech!";
    }
    ?>
    <div class="seedeleted">
      <h3>bekijk verwijderde klassen: </h3>
      <a class="deletebutton" id="trashbutton2" href="index.php?page=klassendeletedlijst"><iconify-icon icon="tabler:trash"></iconify-icon></a>
    </div>
    <br>
    <br>
  </div>
  <?php
    require_once 'include/error.inc.php';
    require_once 'include/info.inc.php';
  ?>
