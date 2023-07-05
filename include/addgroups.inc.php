<?php if (isset($_SESSION['userid']) && isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'admin') { // check if user is logedin ?>

  <div class="addeditdiscipline">
    <form class="form" action="php/addgroups.php" method="POST">
      <div id="name"><h1>groepen toevoegen</h1>
      <p>Voeg een nieuwe groep toe aan het systeem</p></div>
      <hr style="margin: 20px 0;">

      <label for="groep"><b>groep</b></label>
      <br>
      <input id="groep" type="text" placeholder="groep" name="groups" required>

      <hr style="margin: 20px 0;">
      <button type="submit" class="adddisciplinerbtn" style="font-size:20px;font-weight: bold;">groep toevoegen</button>
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
