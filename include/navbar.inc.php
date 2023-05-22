<div class="navbar sticky" id="menulist">
  <iconify-icon icon="ei:navicon" class="nav-icon" onclick="toggleresponsivemenu()"></iconify-icon>
  <div id="navbar_left">
    <?php if (isset($_SESSION['userid'])) { ?>
      <div id="navbuttons">
        <a href="index.php"><b>Home</b></a>
        <div class="dropdown">
          <a id="dashboard" href="index.php?page=dashboard"><b>dashboard</b></a>
          <!-- <div class="dropdown-content">
            <a href="beewaylijst.html"><b>Beeway's</b></a>
            <a href="klassenlijst.html"><b>Klassen</b></a>
            <a href="vakkenlijst.html"><b>Vakken</b></a>
            <a href="hoofdthemalijst.html"><b>Hoofdthema's</b></a>
            <a href="userlijst.html"><b>Users</b></a>
          </div> -->
        </div>
      </div>
    <?php } else { ?>
      <div id="navlogo">
        <a><b>Beeway</b></a>
      </div>
    <?php } ?>
  </div>

  <?php if (!isset($_SESSION['userid'])) { ?>
    <div id="gmnavbar">
      <h3 style="color:white;"><h2 style="font-weight:none;color:white;" class="day-message">Hallo!</h2>En welkom bij</h3>
    </div>
  <?php } ?>


  <div id="navbar_right">
    <?php if (isset($_SESSION['userid'])) { ?>
      <a id="menua" onclick="togglemenu()"><b><iconify-icon icon="ei:navicon" id="nav-icon_2"></iconify-icon></b></a>
    <?php } else { ?>
      <a id="menua1" onclick="togglemenu1()"><b><iconify-icon icon="ic:sharp-question-answer"></iconify-icon><iconify-icon icon="material-symbols:question-mark-rounded"></iconify-icon></b></a>
    <?php } ?>
  </div>
</div>



<?php if (isset($_SESSION['userid'])) { ?>
  <div class="menu" id="menu">
    <div class="menu_profiel">
      <div class="menu_profiel_foto">
        <iconify-icon icon="material-symbols:person" style="font-size:80px;"></iconify-icon>
      </div>
      <div class="menu_profiel_rechts" style="margin-top:20px;">
        <h2 id="menu_profiel_naam" style="font-weight:none;" class="day-message">Hallo</h2>
        <h3 id="voornaam" style="margin:0;margin-left:35px;"></h3>
        <script type='text/javascript'>
          // Get the value from session storage
          var sessionData = sessionStorage.getItem("voornaam");
          // Set the value as the innerHTML of the div element
          document.getElementById("voornaam").innerHTML = sessionData;
        </script>
        <a id="menu_profiel_knop" href="index.php?page=profiel" class="editbutton">Profiel</a>
      </div>
    </div>
    <div class="menu_Buttons">
      <a href="php/logout.php" class="editbutton">Uitloggen</a>
    </div>
  </div>
<?php } else { ?>

  <div class="menu" id="menu1">
    <div class="menu_login">
      <h2 id="menu_profiel_naam" style="font-weight:none;margin-left: 40px;" class="day-message">Hallo!</h2>
      <div class="menu_login_info">
        <h3 class="menu_login_info_txt"><b>Wat is beeway?</b> <br> blah blah blah</h3>
        <h3 class="menu_login_info_txt"><b>Waarvoor kan ik het gebruiken?</b> <br> blah blah blah <br> <a href="#"><u>bekijk voorbeeld</u></a> </h3>
        <h3 class="menu_login_info_txt"><b>nog een vraag?</b> <br> blah blah blah</h3>
      </div>
    </div>
  </div>

<?php } ?>

<script src="script/navbar.js"></script>
