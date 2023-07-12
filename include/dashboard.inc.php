<?php if (isset($_SESSION['userrole']) && isset($_SESSION['userid']) && $_SESSION['userrole'] == 'docent' ||  $_SESSION['userrole'] == 'admin' || $_SESSION['userrole'] == 'superuser') { // check if user is logedin ?>
  <div class="beewaylijst">
    <?php if ($_SESSION['userrole'] == "superuser") { ?>
      <div class="beewaylijsttitel"><h1>Welkom op het super user dashboard</h1></div>
      <h2>beheer hier dingen (:</h2>

      <div class="beewaylijstopties">
        <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
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
        <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
    <?php } else if ($_SESSION['userrole'] == "docent") {?>
      <div class="beewaylijsttitel"><h1>Welkom op het docenten dashboard</h1></div>
      <h2>beheer hier dingen (:</h2>

      <div class="beewaylijstopties">
        <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
    <?php } else { // no valid user logedin
      $_SESSION['error'] = "er ging iets mis. Pech!";
      header("Location: index.php?page=login");
    } ?>
    </div>

    <hr>
    <br>

      <div id="beewaylijstdata" style="text-align:center;">
        <h1>hier kun je al je dingen beheren</h1>
        <h4>leuk dingen bekijken of voeg lekker wat toe dat moet je alemaal zelf weten</h4>
        <h4>veel plezier ig</h4>
      </div>

    <hr>
    <br>
  </div>

<?php
  require_once 'include/error.inc.php';

  } else { // no valid user logedin
    $_SESSION['error'] = "er ging iets mis. Pech!";
    header("Location: php/logout.php");
  }
?>
