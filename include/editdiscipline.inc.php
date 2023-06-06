<?php

$sql = "SELECT * FROM disciplines WHERE disciplineid = :disciplineid";
  $sth = $conn->prepare($sql);
  $sth->bindParam(':disciplineid', $_GET['disciplineid']);
  $sth->execute();

  if ($discipline = $sth->fetch(PDO::FETCH_OBJ)) {
  echo '
<div class="addedit">
  <form class="form" action="php/editdiscipline.php?disciplineid='.$_GET['disciplineid'].'" method="POST">
      <div id="name"><h1>vak bewerken</h1>
      <p>bestaande vak aanpassen in het systeem</p></div>
      <hr style="margin: 20px 0;">
      <div id="LP">
        <label for="NaamThemaP1"><b>vak</b></label>
        <input id="textaddedit" type="text" placeholder="vak" name="disciplinename" value="'.$discipline->disciplinename.'" required>
      </div>

      <hr style="margin: 20px 0;">
      <div class="form-wrapper">
      <button type="submit" class="addbutton" style="font-size:20px;font-weight: bold;">vak bewerken</button>
      <a id="disciplinedelete"style="font-size:20px;font-weight: bold; float:right;"'; ?> onclick='return confirm("Weet je zekker dat je deze vak wilt verwijderen!?")' <?php echo ' href="php/disciplineverwijderen.php?disciplineid='.$discipline->disciplineid.'" class="deletebutton" >Hoofdthema verwijderen</a>
      </div>
    </form>
  </div>';
}
?>
