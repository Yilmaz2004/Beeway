<?php if (isset($_SESSION['userid']) && isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'superuser' || $_SESSION['userrole'] == 'admin') { // check if user is logedin ?>
  <script src="script/admin_gebruikertoevoegen.js"></script>
  <form class="form addedit" id="adduserform" method="POST" action="php/adduser.php">
    <div id="logintittle"><h1>admin - gebruiker toevoegen <iconify-icon icon="akar-icons:person"></iconify-icon></h1></div>
    <hr>
    <div id="LP">
      <label for="firstname"><b>voornaam</b></label>
      <br>
      <input type="text" placeholder="Enter voornaam" name="firstname" id="firstname" value="<?php echo isset($_SESSION['firstname']) ? htmlspecialchars($_SESSION['firstname']) : ''; unset($_SESSION['firstname']); ?>" required>
      <br>
      <label for="lastname"><b>achternaam</b></label>
      <br>
      <input type="text" placeholder="Enter achternaam" name="lastname" id="lastname" value="<?php echo isset($_SESSION['lastname']) ? htmlspecialchars($_SESSION['lastname']) : ''; unset($_SESSION['lastname']); ?>" required>
      <br>
      <label for="rolselect"><b>rol</b></label>
      <br>
      <select id="rolselect" name="role">
        <option id="rolselect" value="0">docent</option>
        <option id="rolselect" value="1">admin</option>
      </select>

      <div class="klassenselect" id="klassenselect">
        <br>
        <label for="groepen"><b>groepen</b></label>
        <br>

        <div class="multiselect">
          <div class="selectBox" onclick="showCheckboxes()">
            <select>
              <option style="text-align:center;">-- Selecteer groepen die bij de docent horen --</option>
            </select>
            <div class="overSelect"></div>
          </div>
          <div id="checkboxes">
            <?php
              if ($_SESSION['userrole'] == 'admin') {
                $sql1 = 'SELECT schoolid FROM users
                        WHERE userid=:userid';
                $sth1 = $conn->prepare($sql1);
                $sth1->bindParam(':userid', $_SESSION['userid']);
                $sth1->execute();

                while ($user = $sth1->fetch(PDO::FETCH_OBJ)) {
                  $sql = 'SELECT groups, groupid
                          FROM groups
                          WHERE schoolid=:schoolid
                          AND archive=0';
                  $sth = $conn->prepare($sql);
                  $sth->bindParam(':schoolid', $user->schoolid);
                  $sth->execute();
                }

                while ($groups = $sth->fetch(PDO::FETCH_OBJ)) {
                  echo'
                    <label for="groepen">
                      <input type="checkbox" name="groepen[]" value="'.$groups->groupid.'"/>groepen '.$groups->groups.'</label>
                  ';
                }
              } else {
                echo'
                  <label for="groepen">je kan als superuser tijdens het aanmaken van de user geen groepen selecteren</label>
                ';
              }
            ?>
          </div>
        </div>
      </div>

    </div>
    <div id="RP">
      <?php if ($_SESSION['userrole'] == 'superuser') { ?>
      <label for="schoolselect"><b>School</b></label>
      <br>
      <select id="schoolselect" name="school">
        <option value="0" selected="selected">-- selecteer de bijbehorende school --</option>
        <?php
        $sql = 'SELECT schoolname, schoolid
                FROM schools
                WHERE schoolid<>0
                AND archive=0';
        $sth = $conn->prepare($sql);
        $sth->execute();

        while ($schools = $sth->fetch(PDO::FETCH_OBJ)) {
          $selected = '';
          if (isset($_SESSION['school']) && $schools->schoolid == $_SESSION['school']) {
            echo $_SESSION['school'];
            $selected = 'selected="selected"';
            // unset($_SESSION['school']);
          }
          echo '<option value="' . $schools->schoolid . '" ' . $selected . '>' . $schools->schoolname . '</option>';
        }
        ?>
      </select>
      <hr>
    <?php } else { ?>
      <label><b>School</b></label>
      <br>
      <?php
        $loggedInUserId = $_SESSION['userid'];
        $sql = 'SELECT s.schoolname
                FROM schools s
                INNER JOIN users u ON s.schoolid = u.schoolid
                WHERE u.userid = :userid
                AND u.archive = 0';
        $sth = $conn->prepare($sql);
        $sth->bindParam(':userid', $loggedInUserId);
        $sth->execute();
        $schoolName = $sth->fetchColumn();
      ?>
      <input type="text" value="<?php echo $schoolName; ?>" readonly>
      <hr>
      <?php } ?>

      <br>
      <label for="email"><b>Email</b></label>
      <br>
      <input type="email" placeholder="Enter Email" name="email" id="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; unset($_SESSION['email']); ?>" required>
      <br>
      <label for="password"><b>Password</b></label>
      <br>
      <input type="password" placeholder="Enter Password" name="password" id="password" style="margin-bottom:0;" required>
      <p id="password-validation"></p>
    </div>

    <button type="submit" id="adduserbtn" class="registerbtn" disabled>aanmaken</button>

    <script>
      var passwordField = document.getElementById("password");
      var validationField = document.getElementById("password-validation");
      var submitButton = document.getElementById("adduserbtn");

      // Add a listener to the password field for when the user types
      passwordField.addEventListener("keyup", function() {
        // Get the value of the password field
        var password = passwordField.value;

        // Check if the password meets the requirements
        var hasUpperCase = /[A-Z]/.test(password);
        var hasLowerCase = /[a-z]/.test(password);
        var hasMinLength = password.length >= 6;

        // Update the validation message based on the requirements
        if (hasUpperCase && hasLowerCase && hasMinLength) {
          validationField.innerHTML = "";
          submitButton.disabled = false;
        } else {
          validationField.innerHTML = "Het wachtwoord moet minimaal één hoofdletter en één kleine letter bevatten en minimaal 6 tekens lang zijn.";
          submitButton.disabled = true;
        }
      });
    </script>
  </form>

<?php
  } else {
    $_SESSION['error'] = "er ging iets mis. Pech!";
    header("Location: index.php?page=dashboard");
    exit;
  }

  require_once 'include/info.inc.php';
  require_once 'include/error.inc.php';
?>
