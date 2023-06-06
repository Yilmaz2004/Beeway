<?php  ?>

<div class="addedit">
  <form class="form" action="php/adddiscipline.php" method="POST">
    <div id="name"><h1>vakken toevoegen</h1>
    <p>Voeg een nieuwe vak toe aan het systeem</p></div>
    <hr style="margin: 20px 0;">
    <div id="LP">
      <label for="vak"><b>vak</b></label>
      <input id="textaddedit" type="text" placeholder="vak" name="disciplinename" required>
    </div>

    <hr style="margin: 20px 0;">
    <button type="submit" class="addbutton" style="font-size:20px;font-weight: bold;">vakken toevoegen</button>
  </form>
</div>
