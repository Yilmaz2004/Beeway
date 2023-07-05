<?php if (isset($_SESSION['userid']) && isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'admin') { // check if user is logedin ?>

  <div class="addeditdiscipline">
    <form class="form" action="php/adddiscipline.php" method="POST">
      <div id="name"><h1>vakken toevoegen</h1>
      <p>Voeg een nieuwe vak toe aan het systeem</p></div>
      <hr style="margin: 20px 0;">

      <label for="vak"><b>vak</b></label>
      <br>
      <input id="vak" type="text" placeholder="vak" name="disciplinename" required>

      <hr style="margin: 20px 0;">
      <button type="submit" class="adddisciplinerbtn" style="font-size:20px;font-weight: bold;">vak toevoegen</button>
    </form>
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
