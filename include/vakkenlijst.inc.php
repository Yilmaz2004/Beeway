<?php
if (isset($_SESSION['userrol'])) { // controleer of de gebruiker is ingelogd
?>
<div class="beewaylijst">
    <?php if ($_SESSION['userrol'] == "superuser") { ?>
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

    <?php } else if ($_SESSION['userrol'] == "admin") { ?>

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
$sql = 'SELECT disciplinename, disciplineid FROM disciplines
        WHERE archive<>1';
$sth = $conn->prepare($sql);
$sth->execute();

echo '<table class="beewaylijsttable">
    <tr>
        <th>
            <h3>vakken</h3>
            <th><a href="index.php?page=disciplinetoevoegen&disciplineid" class="addbutton">toevoegen</a></th>
        </th>

    </tr>';

    while ($disciplines = $sth->fetch(PDO::FETCH_OBJ)) {
        echo '
            <tr>
                <td><b>'.$disciplines->disciplinename.'</b></td>
                <td><a href="index.php?page=disciplinebewerken&disciplineid='.$disciplines->disciplineid.'" class="editbutton">bewerken</a></td>
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
                <a href="index.php?page=logslijst&offset='.$volgende.'" class="addbutton">volgende</a>
                <p style="margin:6px;">pagina: '.$pagina.'</p>
            ';
        } else {
            echo '
                <a href="index.php?page=logslijst&offset='.$terug.'" class="addbutton">terug</a>
                <p style="margin:6px;">pagina: '.$pagina.'</p>
                <a href="index.php?page=logslijst&offset='.$volgende.'" class="addbutton">volgende</a>
            ';
        }
    } else {
        echo '
            <a href="index.php?page=logslijst&offset=1" class="addbutton">volgende</a>
            <p style="margin:6px;">pagina: 1</p>
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
                    <a href="index.php?page=logslijst&offset='.$terug.'" class="addbutton">terug</a>
                </div>
            ';
        } else if (isset($_GET['offset'])) {
            echo '
                <div class="tablebuttons">
                    <p style="margin:6px;">pagina: '.$pagina.'</p>
                    <a href="index.php?page=logslijst&offset='.$terug.'" class="addbutton">terug</a>
                </div>
            ';
        }

        $_SESSION['error'] = "Er zijn geen resultaten gevonden. Pech!";
    }
    ?>
    <div <a class="deletebutton archivebutton" href="index.php?page=disciplinearchive"><iconify-icon icon="mdi:trash-outline" style="font-size:20px"></iconify-icon></a>
  </div>

    <hr>
    </div>
    <?php include 'include/error.inc.php'; ?>
    <?php    ?>
