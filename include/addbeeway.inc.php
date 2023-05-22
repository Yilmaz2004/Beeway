<script src="script/beeway.js"></script>

<div class="beewayedit">
  <form id="form0" action="php/addbeeway.php" method="post">
    <div><input type="text" placeholder="BeewayNaam" name="beewaynaam" required></div>
    <div><button id="opslaan" class="addbutton" type="submit" style="font-size: 16px;">Opslaan</button></div>
    <!-- <div><a onclick='return confirm("Weet je zekker dat je deze beeway wilt verwijderen!?")' href="##" class="deletebutton" style="font-size: 16px;">Verwijderen</a></div> -->
    <div>
      <p>Aangemaakt door: <b>Robin</b></p>
      <p>Als laatst bewerkt door: <b>Robin</b></p>
    </div>
    <div>

      <label for="status" style="font-size:20px;"><b>beeway Markeren als afgerond</b></label>
      <input id="my-checkbox" type="checkbox" name="status" value="1">

    </div>
  </div>

  <hr>

  <div class="helebeeway">
    <div id="grid-line">
      <div class="cell BEEWAY">
        <h1>BEEWAY</h1>
        <h2>Iedere dag ’n beetje beter</h2>
        <div id="groepen">
          <label>Groepen</label>
          <input type="number" name="groepen" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;" min="1" max="8" required></input>
        </div>
      </div>

      <div class="cell HOOFDTHEMA">
        <h2 id="orange">HOOFDTHEMA</h2>
        <input type="radio" name="hoofdthemaid[]" value="1" required>
        <label for="html">P1: EDI</label>
        <br>
        <input type="radio" name="hoofdthemaid[]" value="2">
        <label for="html">P2: BEGELEIDENDE INOEFENING</label>
        <br>
        <input type="radio" name="hoofdthemaid[]" value="3">
        <label for="html">P3: LEZEN</label>
        <br>
        <input type="radio" name="hoofdthemaid[]" value="4">
        <label for="html">P4: DIFFERENTIATIE EDI</label>
        <br>
        <input type="radio" name="hoofdthemaid[]" value="5">
        <label for="html">P5: DOELENPLANNER</label>
        <br>
      </div>

      <div class="cell CONCREETDOEL">
        <h2 id="orange">CONCREET DOEL</h2>
        <textarea type="text" name="concreetdoel" id="doel" maxlength="2500"></textarea>
      </div>

      <div class="cell beoordeling">
        <div class="beoordeling-item beoordeling-item1"><iconify-icon icon="fa:smile-o" style='font-size:62px'></iconify-icon></div>
        <div class="beoordeling-item beoordeling-item2">
          <input type="number" name="begoed" id="beoordeling1" onKeyDown="if(this.value.length==3 && event.keyCode!=8) return false;"></input>
        </div>
        <div class="beoordeling-item beoordeling-item3"><iconify-icon icon="fa:meh-o" style='font-size:62px'></iconify-icon></div>
        <div class="beoordeling-item beoordeling-item4">
          <input type="number" name="bevoldoende" id="beoordeling2" onKeyDown="if(this.value.length==3 && event.keyCode!=8) return false;"></input>
        </div>
        <div class="beoordeling-item beoordeling-item5"><iconify-icon icon="fa:frown-o" style='font-size:62px'></iconify-icon></div>
        <div class="beoordeling-item beoordeling-item6">
          <input type="number" name="beonvoldoende" id="beoordeling3" onKeyDown="if(this.value.length==3 && event.keyCode!=8) return false;"></input>
        </div>
      </div>

      <div class="cell vakgebied">
        <h2 id="orange">VAKGEBIED</h2>
        <select name="vakgebiedid" id="vakgebied" required>
          <!-- <optgroup label="Selecteer een vakgebied"> -->
            <option value="">-- selecteer een vakgebied --</option>
            <option value="1">Rekenen</option>
            <option value="2">Lezen</option>
            <option value="3">taal</option>
            <option value="4">engels</option>
            <option value="5">gym</option>
          <!-- </optgroup> -->
        </select>
      </form>
    </div>


    <div class="cell PLANNING">
      <form id="form1" method="POST">
        <h2 id="orange3">PLANNING</h2>
        <div class="textareaplaning" id="planning">

        </div>
      </div>

      <div class="cell Acties">
        <h2>ACTIES</h2>
      </div>

      <div class="cell WAT">
        <h2 id="orange2">WAT</h2>
        <div class="textareaplaning" id="wat">

        </div>
      </div>

      <div class="cell WIE">
        <h2 id="orange2">WIE</h2>
        <div class="textareaplaning" id="wie">

        </div>
      </div>

      <div class="cell DEADLINE">
        <h2 id="orange2">DEADLINE</h2>
        <div class="textareaplaning" id="deadline">

        </div>
      </div>

      <div class="cell done">
          <h2 id="orange2">&#x2714;</h2>
          <div id="done">

          </div>
        </form>
      </div>


      <div class="cell observatie">
        <form id="form2" method="POST">
        <h2 id="orange">DATA LES/OBSERVATIE</h2>
        <div class="textareaobservatie" id="observatie">

        </div>
      </div>

      <div class="cell leerdoel">
        <h2 id="orange">LEERDOEL</h2>
        <div class="textareaobservatie" id="leerdoel">

        </div>
      </div>

      <div class="cell evaluatie">
        <h2 id="orange">EVALUATIE</h2>
        <div class="textareaobservatie" id="evaluatie">

        </div>
      </div>

      <div class="cell werkdoel">
        <h2 id="orange">Werkdoel</h2>
        <div class="textareaobservatie" id="werkdoel">

        </div>
      </div>

      <div class="cell actie">
        <h2 id="orange">ACTIE</h2>
        <div class="textareaobservatie" id="actie">

        </div>
      </div>

    </form>
  </div>
</div>

<hr>
