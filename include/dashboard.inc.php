<?php if (isset($_SESSION['userrol']) && isset($_SESSION['userid'])) { // check if user is logedin ?>
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
          <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=klassenlijst';" id="beewaylijstopties4">Klassen</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=vakkenlijst';" id="beewaylijstopties2">Vakken</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=Hoofdthemalijst';" id="beewaylijstopties3">Hoofdthema's</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
      <?php } else if ($_SESSION['userrol'] == "docent") {?>
        <div class="beewaylijsttitel"><h1>Welkom op het docenten dashboard</h1></div>
        <h2>beheer hier dingen (:</h2>

        <div class="beewaylijstopties">
          <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
      <?php } else { // no valid user logedin
        $_SESSION['error'] = "er ging iets mis. Pech!";
        header("location: index.php?page=login");
      } ?>
    </div>

    <hr>


    <br>
    <!-- <table class="beewaylijsttable">
      <tr>
        <th><h3>Beeway Naam</h3></th>
        <th><h3>Groep(en)</h3></th>
        <th><h3>Vakgebied</h3></th>
        <th><h3>Hoofdthema</h3></th>
        <th><h3>aan gemaakt door</h3></th>
        <th><h3>Status</h3></th>
        <th><h3>verwijderd</h3></th>
        <th><a href="beewaybewerken.html" class="addbutton">toevoegen</a></th>
      </tr> -->

      <div id="beewaylijstdata"></div>

    <!-- </table> -->
    <!-- <hr> -->
  </div>

  <?php include 'include/error.inc.php'; ?>
<?php } else { // no valid user logedin
  $_SESSION['error'] = "er ging iets mis. Pech!";
  header("location: index.php?page=login");
} ?>
