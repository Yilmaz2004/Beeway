<?php
  // check if user is logged in and has superuser role
  if (isset($_SESSION['userid']) && isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'superuser') {
?>

  <div class="addeditschool">
    <form class="form" action="php/addschool.php" method="POST">
      <div id="name">
        <h1>School toevoegen</h1>
        <p>Voeg een nieuwe school toe aan het systeem</p>
      </div>
      <hr style="margin: 20px 0;">
      <label for="schoolname"><b>School naam</b></label>
      <input type="text" placeholder="school naam" name="schoolname" id="schoolname" maxlength="40" required oninput="updateWachtwoord()">

      <br>
      <label for="schooladmin">
        <input type="checkbox" name="schooladmin" value="1" id="schooladmin" checked>
        <b> automatisch een school admin toevoegen.</b>
      </label>

      <br>
      <label>
        <b>de school naam word het email <br>en het wachtwoord word: </b>
        <span id="wachtwoord"></span>
      </label>

      <script>
        function updateWachtwoord() {
          // get the school name from the input field and remove any spaces
          var schoolnaam = document.getElementById("schoolname").value.replace(/\s+/g, '');
          // get the current year
          var jaar = new Date().getFullYear();
          // create the password by combining the school name, year, and exclamation mark
          var wachtwoord = schoolnaam + jaar + "!";
          // set the password text in the span element
          document.getElementById("wachtwoord").innerHTML = wachtwoord;
        }
      </script>

      <hr style="margin: 20px 0;">
      <button type="submit" class="registerbtn" style="font-weight: bold;">School toevoegen</button>
    </form>
  </div>

<?php
  // require_once any error messages
  require_once 'include/error.inc.php';

  } else {
    // redirect to dashboard if user is not logged in or does not have superuser role
    $_SESSION['error'] = "Er ging iets mis. Pech!";
    header("location: index.php?page=dashboard");
  }
?>
