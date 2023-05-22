<?php if (isset($_SESSION['userid']) && isset($_SESSION['userrol']) && $_SESSION['userrol'] == 'superuser') { // check if user is logedin ?>
  <div class="beewaylijst">
      <?php if ($_SESSION['userrol'] == "superuser") { ?>
        <div class="beewaylijsttitel"><h1>Welkom op het super user dashboard</h1></div>
        <h2>beheer hier dingen (:</h2>

        <div class="beewaylijstopties">
          <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=scholenlijst';" id="beewaylijstopties5">Scholen</button>
          <b>|</b>
          <button onclick="window.location.href='index.php?page=logslijst';" id="beewaylijstopties5"><u>Site Logs</u></button>
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

      <h2>filters</h2>

      <label for="rol"><b>filter op user</b></label>
      <br>
      <select id="schoolselect" name="school">
        <option value="0" selected="selected">-- sorteer op user --</option>
        <?php
          $sql = 'SELECT userid, firstname, lastname FROM users';
          $sth = $conn->prepare($sql);
          $sth->execute();

          while ($user = $sth->fetch(PDO::FETCH_OBJ)) {
            echo'
            <option value="index.php?page=logslijst&userid='.$user->userid.'">'.$user->firstname." ".$user->lastname.'</option>
            ';
          }
        ?>
      </select>

      <script> // some random code from chat-gpt that checks if user wants to sort per user
        const selectElement = document.getElementById('schoolselect');

        // Add an event listener for the "change" event
        selectElement.addEventListener('change', (event) => {
          // Get the selected option's value
          const selectedValue = event.target.value;
          // Redirect to the selected URL
          window.location.href = selectedValue;
        });
      </script>

      <!-- <br> -->

      <input style="width:200px;" type="text" id="myInput" onkeyup="myFunction()" placeholder="zoek op naam..." title="Type in a name">

      <script src="script/tablesearch.js"></script>

    <hr>
    <br>

    <?php
      // Check if offset parameter is set in the URL
      if (isset($_GET['offset'])) {
        // Multiply offset by 25 to get the correct number of records to skip
        $offset = $_GET['offset'] * 50;
        // Check if userid parameter is also set in the URL
        if (isset($_GET['userid'])) {
          // If userid is set, get logs and user data for that specific user
          $sql = 'SELECT l.*, u.firstname, u.lastname
                  FROM logs as l, users as u
                  WHERE u.userid=:userid
                  AND l.userid=u.userid
                  ORDER BY id DESC
                  LIMIT 50 OFFSET '.intval($offset);
          $sth = $conn->prepare($sql);
          // Bind userid parameter to the prepared statement
          $sth->bindParam(':userid', $_GET['userid']);
          $sth->execute();
        } else {
          // If userid is not set, get logs and user data for all users
          $sql = 'SELECT l.*, u.firstname, u.lastname
                  FROM logs as l, users as u
                  WHERE l.userid=u.userid
                  ORDER BY id DESC
                  LIMIT 50 OFFSET '.intval($offset);
          $sth = $conn->prepare($sql);
          $sth->execute();
        }
        } else {
        // If offset parameter is not set, get logs and user data for all users starting from the beginning
        $sql = 'SELECT l.*, u.firstname, u.lastname
                FROM logs as l, users as u
                WHERE l.userid=u.userid
                ORDER BY id DESC
                LIMIT 50';
        $sth = $conn->prepare($sql);
        $sth->execute();
        }

        // Check if there are any rows returned by the query
        if ($sth->rowCount() > 0) {
          // Output table headers
          echo '<table class="beewaylijsttable">
                <tr>
                  <th><h3>username</h3></th>
                  <th><h3>actie</h3></th>
                  <th><h3>tabel van actie</h3></th>
                  <th><h3>id van actie</h3></th>
                  <th><h3>datum en tijd</h3></th>
                </tr>';
          // Output table rows with log data
          while ($logs = $sth->fetch(PDO::FETCH_OBJ)) {
            // Translate action code to human-readable text
            if ($logs->action == '0') {$action = 'select';}
            elseif ($logs->action == '1') {$action = 'insert';}
            elseif ($logs->action == '2') {$action = 'update';}
            elseif ($logs->action == '3') {$action = 'delete';}
            elseif ($logs->action == '4') {$action = 'login';}
            elseif ($logs->action == '5') {$action = 'logout';}

            // Translate tableid to human-readable text
            if ($logs->tableid == '1') {$tableid = 'beeway';}
            elseif ($logs->tableid == '2') {$tableid = 'vakken';}
            elseif ($logs->tableid == '3') {$tableid = 'groepen';}
            elseif ($logs->tableid == '4') {$tableid = 'hoofdthemas';}
            elseif ($logs->tableid == '5') {$tableid = 'scholen';}
            elseif ($logs->tableid == '6') {$tableid = 'users';}

            echo'
              <tr>
                <td><b><i>('.$logs->userid.")</i> - ".$logs->firstname." ".$logs->lastname.'</b></td>
                <td><b>'.$action.'</b></td>
                <td><b>'.$tableid.'</b></td>
                <td><b>'.$logs->interactionid.'</b></td>
                <td><b>'.$logs->date.'</b></td>
              </tr>
            ';
          }
          echo '</table>

          <hr>
          <br>

          <div class="tablebuttons">';
            if (isset($_GET['offset'])) {
              $pagina = $_GET['offset'] + 1;
              $terug = $_GET['offset'] - 1;
              $volgende = $_GET['offset'] + 1;
              if ($_GET['offset'] == '0') {
                echo '
                  <p style="margin:6px;">pagina: '.$pagina.'</p>
                  <a href="index.php?page=logslijst&offset='.$volgende.'" class="addbutton">volgende</a>
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
                <p style="margin:6px;">pagina: 1</p>
                <a href="index.php?page=logslijst&offset=1" class="addbutton">volgende</a>
              ';
            }
          echo '</div>';
        } else {
          // the query did not return any rows
          $pagina = $_GET['offset'] + 1;

          echo '<h2 style="text-align:center;"><strong>Er zijn geen resultaten gevonden</string></h2>';
          if (isset($_GET['offset']) && $_GET['offset'] >= '1') {
            $terug = $_GET['offset'] - 1;

            echo '
              <div class="tablebuttons">
                <a href="index.php?page=logslijst&offset='.$terug.'" class="addbutton">terug</a>
                <p style="margin:6px;">pagina: '.$pagina.'</p>
              </div>
              ';
          } else if (isset($_GET['offset'])) {
            echo '
              <div class="tablebuttons">
                <a href="index.php?page=logslijst&offset='.$terug.'" class="addbutton">terug</a>
                <p style="margin:6px;">pagina: '.$pagina.'</p>
              </div>
              ';
          }
          $_SESSION['error'] = "Er zijn geen resultaten gevonden. Pech!";
        }
      ?>

  </div>

  <?php
    include 'include/info.inc.php';
    include 'include/error.inc.php';

  } else {
    $_SESSION['error'] = "er ging iets mis. Pech!";
    header("location: php/logout.php");
  }
?>
