<?php if (isset($_SESSION['userid']) && isset($_SESSION['userrol']) && $_SESSION['userrol'] == 'superuser' || $_SESSION['userrol'] == 'admin') { // check if user is logedin and if a user was selected to edit ?>
  <script src="script/admin_gebruikertoevoegen.js"></script>
  <?php echo'<form class="form addedit" method="POST" action="php/edituser.php?userid='.$_GET['userid'].'">'; ?>
    <!-- <div class="admin_adduser form"> -->
      <div id="logintittle"><h1>admin - gebruiker aanpassen <iconify-icon icon="akar-icons:person"></iconify-icon></h1></div>
      <hr>

      <?php
        $sql = 'SELECT * FROM users
                WHERE userid=:userid';
        $sth = $conn->prepare($sql);
        $sth->bindParam(':userid', $_GET['userid']);
        $sth->execute();

        while ($user = $sth->fetch(PDO::FETCH_OBJ)) {
          $sql1 = 'SELECT firstname, lastname FROM users WHERE userid = :userid1
                  UNION ALL
                  SELECT firstname, lastname FROM users WHERE userid = :userid2';
          $sth1 = $conn->prepare($sql1);
          $sth1->bindParam(':userid1', $user->createdby);
          $sth1->bindParam(':userid2', $user->updatedby);
          $sth1->execute();

          $y = 1;
          echo'<div id="editedby">';

          while ($editedby = $sth1->fetch(PDO::FETCH_OBJ)) {
            if ($y == 1) {
              echo'<p>Aangemaakt door: <b>'.$editedby->firstname.' '.$editedby->lastname.'</b></p>';
            } else {
              echo'<p>Als laast bewerkt door: <b>'.$editedby->firstname.' '.$editedby->lastname.'</b></p>';
            }

            $y++;
          }

          echo'
        </div>

        <hr>
        <div id="LP">
          <label for="name"><b>voornaam</b></label>
          <br>
          <input type="text" placeholder="Enter voornaam" name="firstname" value="'.$user->firstname.'" required>
          <br>
          <label for="lastname"><b>achternaam</b></label>
          <br>
          <input type="text" placeholder="Enter achternaam" name="lastname" value="'.$user->lastname.'" required>
          <br>
          <label for="rol"><b>rol</b></label>
          <br>
          <p id="editedby">je kan de rol niet aanpassen. Deze user is: <b>';

          if ($user->role == "0") {$role = "docent";}
          else if ($user->role == "1") {$role = "school admin";}
          else {$role = "super user";}

          echo $role.'</b></p>

          <div class="klassenselect" id="klassenselect">
            <br>
            <label for="lastname"><b>groepen</b></label>
            <br>

            <div class="multiselect">
              <div class="selectBox" onclick="showCheckboxes()">
                <select>
                  <option style="text-align:center;">-- Selecteer groepen die bij de docent horen --</option>
                </select>
                <div class="overSelect"></div>
              </div>
              <div id="checkboxes">';
                  $sql2 = 'SELECT groups, groupid
                          FROM groups
                          WHERE archive<>"1"';
                  $sth2 = $conn->prepare($sql2);
                  $sth2->execute();

                  while ($groups = $sth2->fetch(PDO::FETCH_OBJ)) {
                    echo'
                      <label for="groepen">
                      <input type="checkbox" name="groepen[]" value="'.$groups->groupid.'"
                    ';
                    $sql3 = 'SELECT *
                            FROM linkgroups
                            WHERE userid=:userid
                            AND archive<>"1"';
                    $sth3 = $conn->prepare($sql3);
                    $sth3->bindParam(':userid', $_GET['userid']);
                    $sth3->execute();

                    while ($linkgroups = $sth3->fetch(PDO::FETCH_OBJ)) {
                      if ($groups->groupid == $linkgroups->groupid) {echo "checked";}
                    }
                    echo'/>groepen '.$groups->groups.'</label>';
                  }
                  echo'
              </div>
            </div>
          </div>

        </div>
        <div id="RP">

          <label for="rol"><b>school</b></label>
          <br>
          <select id="schoolselect" name="school">
            <option value="0">-- selecteer de bijbehorende school --</option>';
            $sql4 = 'SELECT schoolname, schoolid
                      FROM schools
                      WHERE schoolid<>"0"
                      AND archive<>"1"';
            $sth4 = $conn->prepare($sql4);
            $sth4->execute();

            while ($schools = $sth4->fetch(PDO::FETCH_OBJ)) {
              $selected = '';
              if ($schools->schoolid == $user->schoolid) {
                $selected = 'selected="selected"';
              }
              echo '<option value="'.$schools->schoolid.'" '.$selected.'>'.$schools->schoolname.'</option>';
            }
              echo'
          </select>

          <hr>

          <br>
          <label for="email"><b>Email</b></label>
          <br>
          <input type="email" placeholder="Enter Email" name="email" value="'.$user->email.'" required>
          <br>
          <label for="psw"><b>Password</b></label>
          <br>
          <p id="passwordchangewarning">Als je hier iets invult word dat het nieuwe wachtwoord voor deze user!</p>
          <input type="password" placeholder="Enter Password" name="password" id="password" style="margin-bottom:0;">
          <p id="password-validation"></p>

        </div>';

        }
        echo'
      <button type="submit" id="adduserbtn" class="registerbtn">aanpasingen opslaan</button>

      <a class="deletebutton" id="trashbutton" onclick="deleteuser()"><iconify-icon icon="tabler:trash"></iconify-icon></a>

      <script>
        function deleteuser() {
          var txt;
          if (confirm("Weet je zekker dat je deze user wilt verwijderen!?")) {
            window.location.href = "php/deleteuser.php?userid='.$_GET['userid'].'";
          }
        }
      </script>

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

          // Update the validation message and button based on the requirements and input
          if (password === "") {
            validationField.innerHTML = "";
            submitButton.disabled = false;
          } else if (hasUpperCase && hasLowerCase && hasMinLength) {
            validationField.innerHTML = "";
            submitButton.disabled = false;
          } else {
            validationField.innerHTML = "Het wachtwoord moet minimaal één hoofdletter en één kleine letter bevatten en minimaal 6 tekens lang zijn.";
            submitButton.disabled = true;
          }
        });
      </script>

    <!-- </div> -->
  </form>';

   include 'include/error.inc.php';


  } else {
    $_SESSION['error'] = "er ging iets mis. Pech!";
    header("location: index.php?page=dashboard");
  }
?>
