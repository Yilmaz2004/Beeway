<?php if (isset($_SESSION['userrole']) && isset($_SESSION['userid']) && $_SESSION['userrole'] == 'admin') { // Check if the user is logged in ?>
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
                  <button onclick="window.location.href='index.php?page=klassenlijst';" id="beewaylijstopties4">Groepen/Klassen</button>
                  <b>|</b>
                  <button onclick="window.location.href='index.php?page=vakkenlijst';" id="beewaylijstopties2"><u>Vakken</u></button>
                  <b>|</b>
                  <button onclick="window.location.href='index.php?page=hoofdthemalijst';" id="beewaylijstopties3">Hoofdthema's</button>
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
              WHERE schoolid <> 0
                AND archive = 0
                AND userid = :userid';
      $sth = $conn->prepare($sql);
      $sth->bindValue(':userid', $_SESSION['userid'], PDO::PARAM_INT);
      $sth->execute();

      $result = $sth->fetch(PDO::FETCH_ASSOC); // Fetch the result from the executed query
      $schoolid = $result['schoolid'] ?? null; // Access the schoolid value from the result array

      if ($schoolid) {
          $sql = 'SELECT disciplinename, disciplineid FROM disciplines
                  WHERE archive = 0
                    AND schoolid = :schoolid';
          $sth = $conn->prepare($sql);
          $sth->bindValue(':schoolid', $schoolid, PDO::PARAM_INT);
          $sth->execute();

          ?>
          <table class="beewaylijsttable">
              <tr>
                  <th>
                      <h3>vakken</h3>
                      <th><a href="index.php?page=adddiscipline" class="addbutton">toevoegen</a></th>
                  </th>
              </tr>
              <?php
              while ($disciplines = $sth->fetch(PDO::FETCH_OBJ)) {
                  ?>
                  <tr>
                      <td><b><?= $disciplines->disciplinename ?></b></td>
                      <td><a href="index.php?page=editdiscipline&disciplineid=<?= $disciplines->disciplineid ?>"
                             class="editbutton">bewerken</a></td>
                  </tr>
                  <?php
              }
              ?>
          </table>
          <hr>
          <br>
          <?php
      } else {
          $_SESSION['error'] = "Er zijn geen resultaten gevonden. Pech!";
      }
      ?>
      <div class="seedeleted">
          <h3>bekijk verwijderde vakken: </h3>
          <a class="deletebutton" id="trashbutton2" href="index.php?page=vakkenarchivelijst"><iconify-icon
                      icon="tabler:trash"></iconify-icon></a>
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
