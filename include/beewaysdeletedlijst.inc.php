<?php
if (isset($_SESSION['userrole'])) { // check if user is logged in
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
          <button onclick="window.location.href='index.php?page=vakkenlijst';" id="beewaylijstopties2">Vakken</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=Hoofdthemalijst';" id="beewaylijstopties3"><u>Hoofdthema's</u></button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
        <?php } else { ?>
        <div class="beewaylijsttitel">
          <h1>Welkom op het docenten dashboard</h1>
        </div>
        <h2>beheer hier dingen (:</h2>
        <div class="beewaylijstopties">
          <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
        <?php } ?>
      </div>
      <hr>
      <br>
      <?php
      // Make sure to establish a database connection before executing the code
      // $conn = new PDO(...);

      $sql1 = 'SELECT schoolid FROM users WHERE userid=:userid';
      $sth1 = $conn->prepare($sql1);

      // Check if $_SESSION['userid'] is set before using it in the SQL query
      if (isset($_SESSION['userid'])) {
        $sth1->bindParam(':userid', $_SESSION['userid']);
        $sth1->execute();

        if ($sth1->rowCount() > 0) {
          while ($user = $sth1->fetch(PDO::FETCH_OBJ)) {
            $schoolid = $user->schoolid;
          }
        }

        if (isset($_GET['offset'])) {
          $offset = $_GET['offset'] * 25;

          $sql = 'SELECT b.*, g.groups, m.namethemep1, d.disciplinename
            FROM beeway AS b
            JOIN groups AS g ON g.groupid = b.groupid
            JOIN maintheme AS m ON m.themeid = b.mainthemeid
            JOIN disciplines as d ON d.disciplineid = b.disciplineid
            WHERE b.schoolid = :schoolid
            AND b.archive = 1
            ORDER BY b.beewayid
            LIMIT 25 OFFSET :offset';
          $sth = $conn->prepare($sql);
          $sth->bindParam(':schoolid', $schoolid);
          $sth->bindParam(':offset', intval($offset), PDO::PARAM_INT);
          $sth->execute();
        } else {
          $sql = 'SELECT b.*, g.groups, m.namethemep1, d.disciplinename
            FROM beeway AS b
            JOIN groups AS g ON g.groupid = b.groupid
            JOIN maintheme AS m ON m.themeid = b.mainthemeid
            JOIN disciplines as d ON d.disciplineid = b.disciplineid
            WHERE b.schoolid = :schoolid
            AND b.archive = 1
            ORDER BY b.beewayid
            LIMIT 25';
          $sth = $conn->prepare($sql);
          $sth->bindParam(':schoolid', $schoolid);
          $sth->execute();
        }

        if ($sth->rowCount() > 0) {
          echo '<table class="beewaylijsttable">
            <tr>
              <th><h3>Beeway Naam</h3></th>
              <th><h3>groep(en)</h3></th>
              <th><h3>hoofdthema</h3></th>
              <th><h3>vakgebied</h3></th>
              <th><h3>concreet doel</h3></th>
              <th><h3>status</h3></th>
              <th><a href="index.php?page=addbeeway" class="addbutton">toevoegen</a></th>
            </tr>';

          while ($beeway = $sth->fetch(PDO::FETCH_OBJ)) {
            if ($beeway->status == 0) {
              $status = "open";
            } elseif ($beeway->status == 1) {
              $status = "closed";
            } else {
              $status = "unknown";
            }

            echo '
              <tr>
                <td><b>' . $beeway->beewayname . '</b></td>
                <td><b>' . $beeway->groups . '</b></td>';

            $sql1 = 'SELECT m.*
              FROM maintheme AS m
              WHERE m.themeid = :themeid
              AND m.archive = 1';
            $sth1 = $conn->prepare($sql1);
            $sth1->bindParam(':beewayid', $beeway->beewayid);
            $sth1->execute();

            if ($maintheme = $sth1->fetch(PDO::FETCH_OBJ)) {
              $mainthemeName = '';

              switch ($maintheme->themeperiodid) {
                case 1:
                  $mainthemeName = $maintheme->namethemep1;
                  break;
                case 2:
                  $mainthemeName = $maintheme->namethemep2;
                  break;
                case 3:
                  $mainthemeName = $maintheme->namethemep3;
                  break;
                case 4:
                  $mainthemeName = $maintheme->namethemep4;
                  break;
                default:
                  $mainthemeName = $maintheme->namethemep5;
                  break;
              }

              echo '<td><b>' . $mainthemeName . '</b></td>';
            }

            echo '
              <td><b>' . $beeway->disciplinename . '</b></td>
              <td><b>' . (strlen($beeway->concretegoal) > 35 ? substr($beeway->concretegoal, 0, 35) . '...' : $beeway->concretegoal) . '</b></td>
              <td><b>' . $status . '</b></td>
              <td><a href="index.php?page=editbeeway&beewayid=' . $beeway->beewayid . '" class="editbutton">bewerken</a></td>
            </tr>';
          }
          echo '</table>';

          echo '<hr><br>';
        }
      }
    }

echo '</table>
<div class="tablebuttons">';
if (isset($_GET['offset'])) {
  $terug = $_GET['offset'] - 1;
  $volgende = $_GET['offset'] + 1;
  if ($_GET['offset'] == '0') {
    // echo '
    //   <a href="index.php?page=scholenlijst&offset='.$volgende.'" class="addbutton">volgende</a>
    // ';
  } else {
    // echo '
    //   <a href="index.php?page=scholenlijst&offset='.$terug.'" class="addbutton">terug</a>
    //   <a href="index.php?page=scholenlijst&offset='.$volgende.'" class="addbutton">volgende</a>
    // ';
  }
} else {
  // echo '
  //   <a href="index.php?page=scholenlijst&offset=1" class="addbutton">volgende</a>
  // ';
}
echo '</div>';
} else {
// the query did not return any rows
echo '<h2><strong>the query did not return any rows</strong></h2>';
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
<?php require_once 'include/error.inc.php'; ?>
<?php } else {
$_SESSION['error'] = "er ging iets mis. Pech!";
header("location: index.php?page=login");
} ?>
