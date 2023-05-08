<?php if (isset($_SESSION['userrol']) && $_SESSION['userrol'] == 'superuser') {?>
  <script src="script/admin_gebruikertoevoegen.js"></script>
  <form class="form adduserform" method="POST" action="php/adduser.php">
    <div class="admin_adduser form">
      <div id="logintittle"><h1>admin - gebruiker toevoegen <iconify-icon icon="akar-icons:person"></iconify-icon></h1></div>
      <hr>

      <label for="name"><b>voornaam</b></label>
      <br>
      <input type="text" placeholder="Enter voornaam" name="firstname" required>
      <br>
      <label for="lastname"><b>achternaam</b></label>
      <br>
      <input type="text" placeholder="Enter achternaam" name="lastname" required>
      <br>
      <label for="rol"><b>rol</b></label>
      <br>
      <select id="rolselect" name="role">
        <option value="1">docent</option>
        <option value="2">admin</option>
      </select>

      <div class="klassenselect" id="klassenselect">
        <br>
        <label for="lastname"><b>groepen</b></label>
        <br>

        <div class="multiselect">
          <div class="selectBox" onclick="showCheckboxes()">
            <select>
              <option>-- Selecteer groepen die bij de docent horen --</option>
            </select>
            <div class="overSelect"></div>
          </div>
          <div id="checkboxes">
            <label for="groepen">
              <input type="checkbox" name="1" />groepen 1</label>
            <label for="groepen">
              <input type="checkbox" name="2" />groepen 2</label>
            <label for="groepen">
              <input type="checkbox" name="3" />groepen 3</label>
          </div>
        </div>
      </div>

      <hr>

      <br>
      <label for="email"><b>Email</b></label>
      <br>
      <input type="email" placeholder="Enter Email" name="email" required>
      <br>
      <label for="psw"><b>Password</b></label>
      <br>
      <input type="password" placeholder="Enter Password" name="password" required>

      <div id="errormsg"></div>

      <button type="submit" id="adduserbtn" class="registerbtn">aanmaken</button>
      <hr>
    </div>
  </form>
<?php } else {
  $_SESSION['error'] = "er ging iets mis. Pech!";
  header("location: index.php?page=dashboard");
} ?>
