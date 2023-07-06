<?php
  if (isset($_SESSION['userid']) && isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'superuser') { // check if user is logedin
    $currentURL = $_SERVER['REQUEST_URI'];
    $modifiedURL = str_replace('/beewayphp/', '', $currentURL);

  if (!isset($_GET['offset'])) {
    header("Location: ".$modifiedURL."&offset=0");
    exit;
  }

  if (isset($_GET['userid']) && $_GET['userid'] == 0) {
    header("Location: index.php?page=logslijst&offset=0");
    exit;
  }
?>

  <div class="beewaylijst">
    <?php if ($_SESSION['userrole'] == "superuser") { ?>
      <div class="beewaylijsttitel"><h1>Welkom op het super user dashboard</h1></div>
      <h2>beheer hier dingen (:</h2>

      <div class="beewaylijstopties">
        <button onclick="window.location.href='index.php?page=userlijst';" id="beewaylijstopties5">Users</button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=scholenlijst';" id="beewaylijstopties5">Scholen</button>
        <b>|</b>
        <button onclick="window.location.href='index.php?page=logslijst';" id="beewaylijstopties5"><u>Site Logs</u></button>
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
    <?php } else { ?>
      <div class="beewaylijsttitel"><h1>Welkom op het docenten dashboard</h1></div>
      <h2>beheer hier dingen (:</h2>

      <div class="beewaylijstopties">
        <button onclick="window.location.href='index.php?page=beewaylijst';" id="beewaylijstopties1">Beeway's</button>
    <?php } ?>
    </div>

    <hr>

    <label for="schoolselect"><b>filter op user</b></label>
    <br>
    <select id="schoolselect" name="school">
      <option value="0" selected="selected">-- sorteer op user --</option>
      <?php
        $roles = array(
          0 => 'docenten',
          1 => 'school admins',
          2 => 'superusers',
          3 => 'system monitor'
        );

        foreach ($roles as $roleId => $roleName) {
          echo '<optgroup label="' . $roleName . '">';

          $sql = 'SELECT userid, firstname, lastname, role FROM users
                  WHERE role=:role
                  AND userid<>0
                  ORDER BY firstname, lastname';
          $sth = $conn->prepare($sql);
          $sth->bindParam(':role', $roleId, PDO::PARAM_INT);
          $sth->execute();

          while ($user = $sth->fetch(PDO::FETCH_OBJ)) {
            $urlParams = $_GET;
            $urlParams['userid'] = $user->userid;
            $selectedUrl = 'index.php?' . http_build_query($urlParams);
            $selectedAttribute = '';

            // Check if the current user id matches the $_GET['userid']
            if (isset($_GET['userid']) && $_GET['userid'] == $user->userid) {
              $selectedAttribute = 'selected';
            }

            echo '
              <option value="'.$user->userid.'" '.$selectedAttribute.'>'.$user->userid.' - '.$user->firstname.' '.$user->lastname.'</option>
            ';
          }

          echo '</optgroup>';
        }
      ?>
    </select>


    <script>
      const selectElement = document.getElementById('schoolselect');

      // Add an event listener for the "change" event
      selectElement.addEventListener('change', (event) => {
        // Get the selected option's value
        const selectedValue = event.target.value;
        // Get the current URL
        const currentUrl = window.location.href;
        // Check if the userid parameter already exists in the current URL
        const userIdRegex = /([&?])userid=[^&]+(&|$)/;
        const hasUserIdParam = userIdRegex.test(currentUrl);

        let updatedUrl = currentUrl;
        if (hasUserIdParam) {
          // Update the existing userid parameter
          updatedUrl = currentUrl.replace(userIdRegex, `$1userid=${selectedValue}$2`);
        } else {
          // Append the new userid parameter to the current URL
          const separator = currentUrl.includes('?') ? '&' : '?';
          updatedUrl = currentUrl + separator + 'userid=' + selectedValue;
        }

        // Redirect to the updated URL
        window.location.href = updatedUrl;
      });
    </script>

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
                AND l.userid<>0
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
                AND l.userid<>0
                ORDER BY id DESC
                LIMIT 50 OFFSET '.intval($offset);
        $sth = $conn->prepare($sql);
        $sth->execute();
      }
    }

      // Check if there are any rows returned by the query
      if ($sth->rowCount() > 0) {
        // Output table headers
        echo '<table class="beewaylijsttable">
              <tr>
                <th><h3>gedaan door</h3></th>
                <th><h3>actie</h3></th>
                <th><h3>info</h3></th>
                <th><h3>tabel</h3></th>
                <th><h3>actie id</h3></th>
                <th><h3>error</h3></th>
                <th><h3>datum en tijd</h3></th>
              </tr>';
        // Output table rows with log data
        while ($logs = $sth->fetch(PDO::FETCH_OBJ)) {
          if ($logs->action == '0') {$action = 'select';}
          elseif ($logs->action == '1') {$action = 'insert';}
          elseif ($logs->action == '2') {$action = 'update';}
          elseif ($logs->action == '3') {$action = 'delete';}
          elseif ($logs->action == '4') {$action = 'login';}
          elseif ($logs->action == '5') {$action = 'logout';}

          if ($logs->tableid == '1') {$tableid = 'beeway';}
          elseif ($logs->tableid == '2') {$tableid = 'vakken';}
          elseif ($logs->tableid == '3') {$tableid = 'groepen';}
          elseif ($logs->tableid == '4') {$tableid = "hoofdthema's";}
          elseif ($logs->tableid == '5') {$tableid = 'scholen';}
          elseif ($logs->tableid == '6') {$tableid = 'users';}

          if ($logs->error == '0') {$error = '-';}
          elseif ($logs->error == '1') {$error = 'Unauthorized access';}
          elseif ($logs->error == '2') {$error = 'not allowed';}
          elseif ($logs->error == '3') {$error = "unknown";}
          elseif ($logs->error == '4') {$error = "failed login";}
          elseif ($logs->error == '5') {$error = "failed";}

          echo '
            <tr>
              <td><b><i>('.$logs->userid.")</i> - ".$logs->firstname." ".$logs->lastname.'</b></td>
              <td><b>'.$action.'</b></td>
              <td style="width:40%;"><b>'.$logs->info.'</b></td>
              <td><b>'.$tableid.'</b></td>
              <td><b>'.(($logs->interactionid == 0) ? "<i>(none)</i>" : $logs->interactionid).'</b></td>
              <td><b>'.$error.'</b></td>
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
                <a href="javascript:void(0);" onclick="updateOffset('.$volgende.')" class="addbutton">volgende</a>
              ';
            } else {
              echo '
                <a href="javascript:void(0);" onclick="updateOffset('.$terug.')" class="addbutton">terug</a>
                <p style="margin:6px;">pagina: '.$pagina.'</p>
                <a href="javascript:void(0);" onclick="updateOffset('.$volgende.')" class="addbutton">volgende</a>
              ';
            }
          } else {
            echo '
              <p style="margin:6px;">pagina: 1</p>
              <a href="javascript:void(0);" onclick="updateOffset(1)" class="addbutton">volgende</a>
            ';
          }
        echo '</div>';
      } else {
        // the query did not return any rows
        $pagina = $_GET['offset'] + 1;

        echo '<h2 style="text-align:center;"><strong>Er zijn geen resultaten gevonden</strong></h2>';
        if (isset($_GET['offset']) && $_GET['offset'] >= '1') {
          $terug = $_GET['offset'] - 1;

          echo '
            <div class="tablebuttons">
              <a href="javascript:void(0);" onclick="updateOffset('.$terug.')" class="addbutton">terug</a>
              <p style="margin:6px;">pagina: '.$pagina.'</p>
            </div>
            ';
        } else if (isset($_GET['offset'])) {
        }
        $_SESSION['error'] = "Er zijn geen resultaten gevonden. Pech!";
      }
    ?>

    <script>
      function updateOffset(offset) {
        var urlParams = new URLSearchParams(window.location.search);
        urlParams.set('offset', offset);
        var newUrl = window.location.pathname + '?' + urlParams.toString();
        window.location.href = newUrl;
      }
    </script>
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
