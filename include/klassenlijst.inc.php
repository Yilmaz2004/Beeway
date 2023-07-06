<?php if (isset($_SESSION['userrole']) && isset($_SESSION['userid']) && $_SESSION['userrole'] == 'admin') { // Check if user is logged in ?>
  <div class="beewaylijst">
    <?php if ($_SESSION['userrole'] == "superuser") { ?>
      <div class="beewaylijsttitel"><h1>Welkom op het super user dashboard</h1></div>
      <h2>beheer hier dingen (:</h2>

      <div class="beewaylijstopties">
        <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=scholenlijst';" id="beewaylijstopties5"><u>Scholen</u></button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=logslijst';" id="beewaylijstopties5">Site Logs</button>
      </div>
    <?php } else if ($_SESSION['userrole'] == "admin") { ?>
      <div class="beewaylijsttitel"><h1>Welkom op het admin dashboard</h1></div>
      <h2>beheer hier dingen (:</h2>

      <div class="beewaylijstopties">
        <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=klassenlijst';" id="beewaylijstopties4"><u>Groepen/Klassen</u></button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=vakkenlijst';" id="beewaylijstopties2">Vakken</button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=hoofdthemalijst';" id="beewaylijstopties3">Hoofdthema's</button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
      <?php } else { ?>
        <div class="beewaylijsttitel"><h1>Welkom op het docenten dashboard</h1></div>
        <h2>beheer hier dingen (:</h2>

        <div class="beewaylijstopties">
          <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
        </div>
      <?php } ?>
    </div>
    <hr>
    <br>

<?php
    $userId = $_SESSION['userid'];
    // Get the schoolid associated with the logged-in user
    $sqlSchool = 'SELECT schoolid FROM users WHERE userid = :userid';
    $sthSchool = $conn->prepare($sqlSchool);
    $sthSchool->bindParam(':userid', $userId, PDO::PARAM_INT);
    $sthSchool->execute();
    $schoolId = $sthSchool->fetch(PDO::FETCH_OBJ)->schoolid;

    $sqlGroups = 'SELECT groups, groupid FROM groups
                  WHERE archive = 0 AND schoolid = :schoolid';
    $sthGroups = $conn->prepare($sqlGroups);
    $sthGroups->bindParam(':schoolid', $schoolId, PDO::PARAM_INT);
    $sthGroups->execute();

    // Check if any rows are returned
    if ($sthGroups->rowCount() > 0) {
      echo '<table class="beewaylijsttable">
        <tr>
          <th>
            <h3>groepen/klassen</h3>
            <th><a href="index.php?page=addgroups" class="addbutton">toevoegen</a></th>
          </th>
        </tr>';

      while ($groups = $sthGroups->fetch(PDO::FETCH_OBJ)) {
        echo '
          <tr>
            <td><b>'.$groups->groups.'</b></td>
            <td><a id="groupsdelete" onclick="return confirm(\'Weet je zeker dat je deze groep/klas wilt verwijderen!?\')" href="php/deletegroup.php?groupid='.$groups->groupid.'" class="deletebutton">groep/klas verwijderen</a></td>
          </tr>
          ';
      }
      echo '</table>
      <hr>
      <br>
      <div class="seedeleted">
        <h3>Bekijk verwijderde groepen/klassen:</h3>
        <a class="deletebutton" id="trashbutton2" href="index.php?page=klassenarchivelijst"><iconify-icon icon="tabler:trash"></iconify-icon></a>
      </div>
      <br>
      <br>';
    } else {
      echo '<h2 style="text-align: center;"><strong>The query did not return any rows</strong></h2>';
      echo '<a href="index.php?page=addgroups" class="addbutton" id="addfirst">groep/klas toevoegen</a>';
      $_SESSION['error'] = "Er zijn geen resultaten gevonden. Pech!";
    }

    echo'</div>';

  } else {
    $_SESSION['error'] = "er ging iets mis. Pech!";
    header("Location: index.php?page=dashboard");
    exit;
  }

  require_once 'include/info.inc.php';
  require_once 'include/error.inc.php';
?>
