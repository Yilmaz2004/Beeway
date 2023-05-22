<?php  ?>
<div class="addedit">
    <form class="form" action="php/groupstoevoegen.php" method="POST">
      <div id="name"><h1>groepen toevoegen</h1>
      <p>Voeg een nieuwe groep toe aan het systeem</p></div>
      <hr style="margin: 20px 0;">
      <div id="LP">
        <label for="vak"><b>groep</b></label>
        <input id="textaddedit" type="text" placeholder="groep" name="groups" required>
      </div>
      <div id="errormsg"></div>
      <hr style="margin: 20px 0;">
      <button type="submit" class="addbutton" style="font-size:20px;font-weight: bold;">groep toevoegen</button>
    </form>
  </div>
