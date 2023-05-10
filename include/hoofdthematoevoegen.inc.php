<?php  ?>

<div class="addedit">
    <form class="form" action="php/hoofdthematoevoegen.php" method="POST">
      <div id="name"><h1>Hoofdthema toevoegen</h1>
      <p>Voeg een nieuwe Hoofdthema toe aan het systeem</p></div>
      <hr style="margin: 20px 0;">
      <div id="LP">
        <label for="NaamThemaP1"><b>Hoofdthema naam Periode 1</b></label>
        <input id="textaddedit" type="text" placeholder="NaamThemaP1" name="namethemep1" required>
        <label for="NaamThemaP2"><b>Hoofdthema naam Periode 2</b></label>
        <input id="textaddedit" type="text" placeholder="NaamThemaP2" name="namethemep2" required>
        <label for="NaamThemaP3"><b>Hoofdthema naam Periode 3</b></label>
        <input id="textaddedit" type="text" placeholder="NaamThemaP3" name="namethemep3" required>
      </div>
      <div id="RP">
        <label for="NaamThemaP4"><b>Hoofdthema naam Periode 4</b></label>
        <input id="textaddedit" type="text" placeholder="NaamThemaP4" name="namethemep4" required>
        <label for="NaamThemaP5"><b>Hoofdthema naam Periode 5</b></label>
        <input id="textaddedit" type="text" placeholder="NaamThemaP5" name="namethemep5" required>

        <label for="Schooljaar"><b>Schooljaar</b></label>
        <select id="selectaddedit" name="schoolyear" >
          <optgroup label="Selecteer een Schooljaar">
            <option type="dropdown" placeholder="Schooljaar" value="1">2021/2022</option>
            <option type="dropdown" placeholder="Schooljaar" value="2" selected>2022/2023</option>
            <option type="dropdown" placeholder="Schooljaar" value="3">2023/2024</option>
            <option type="dropdown" placeholder="Schooljaar" value="4">2024/2025</option>
            <option type="dropdown" placeholder="Schooljaar" value="5">2025/2026</option>
            <option type="dropdown" placeholder="Schooljaar" value="6">2026/2027</option>
          </optgroup>
        </select>
      </div>

      <div id="errormsg"></div>

      <hr style="margin: 20px 0;">
      <button type="submit" class="addbutton" style="font-size:20px;font-weight: bold;">Hoofdthema toevoegen</button>
    </form>
  </div>
