<?php if (isset($_SESSION['userid']) && isset($_SESSION['userrol']) && $_SESSION['userrol'] == 'superuser') { // check if user is logedin ?>
  <div class="beewaylijst">
    <?php if ($_SESSION['userrol'] == "superuser") { ?>
      <div class="beewaylijsttitel"><h1>Welkom op het super user dashboard</h1></div>
      <h2>deleted scholen</h2>

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
        $sql = 'SELECT * FROM schools
                WHERE schoolid<>0
                AND archive=1
                ORDER BY schoolid';
        $sth = $conn->prepare($sql);
        $sth->execute();

        if ($sth->rowCount() > 0) {
          echo '<table class="beewaylijsttable">
            <tr>
              <th><h3>school naam</h3></th>
              <th><h3>users van deze school bekijken</h3></th>
            </tr>';
          while ($schools = $sth->fetch(PDO::FETCH_OBJ)) {

            echo'
              <tr>
                <td><b>'.$schools->schoolname.'</b></td>
                <td><a href="php/getbackschool.php?userid='.$schools->schoolid.'" class="editbutton">terug halen</a></td>
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
