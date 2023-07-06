<script src="script/beeway.js"></script>

<?php
  if (isset($_SESSION['userid']) && isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'admin' || $_SESSION['userrole'] == 'docent') { // check if user is logedin
    if (isset($_GET['beewayid']) && $_GET['beewayid'] > 0) {

      $sql = 'SELECT schoolid
           FROM users
           WHERE schoolid<>0
           AND archive<>1
           AND userid=:userid';

      $sth = $conn->prepare($sql);
      $sth->bindValue(':userid', $_SESSION['userid']);
      $sth->execute();

      $result = $sth->fetch(); // Fetch the result from the executed query
      $schoolid = $result['schoolid']; // Access the schoolid value from the result array

          $sql = 'SELECT * FROM beeway
                  WHERE beewayid=:beewayid';
          $sth = $conn->prepare($sql);
          $sth->bindParam(':beewayid', $_GET['beewayid']);
          $sth->execute();

          if ($beeway = $sth->fetch(PDO::FETCH_OBJ)) {

            echo'
            <div class="beewayedit">
              <form id="form0" action="php/editbeeway.php?beewayid='.$_GET['beewayid'].'" method="post">
                <div><input type="text" placeholder="BeewayNaam" name="beewaynaam" value="'.$beeway->beewayname.'" required></div>
                <div><button id="opslaan" class="addbutton" type="submit" style="font-size: 16px;">Opslaan</button></div>
                <div><button '; ?> onclick='return confirm("Weet je zekker dat je deze beeway wilt verwijderen!?")' <?php echo ' href="##" class="deletebutton" style="font-size: 16px;">Verwijderen</button></div>
                <div>
            ';

            $sql1 = 'SELECT firstname, lastname FROM users WHERE userid = :userid1
                    UNION ALL
                    SELECT firstname, lastname FROM users WHERE userid = :userid2';
            $sth1 = $conn->prepare($sql1);
            $sth1->bindParam(':userid1', $beeway->createdby);
            $sth1->bindParam(':userid2', $beeway->updatedby);
            $sth1->execute();

            $y = 1;

            while ($editedby = $sth1->fetch(PDO::FETCH_OBJ)) {
              if ($y == 1) {
                echo'<p>Aangemaakt door: <b>'.$editedby->firstname.' '.$editedby->lastname.'</b></p>';
              } else {
                echo'<p>Als laast bewerkt door: <b>'.$editedby->firstname.' '.$editedby->lastname.'</b></p>';
              }

              $y++;
            }
          }
        ?>
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
          <h1>[naam]</h1>
          <h2>Iedere dag ’n beetje beter</h2>
          <div id="groepen">
            <label>Groepen</label>
            <input type="number" name="groepen" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;" min="1" max="8" <?php echo isset($beeway->groupid) ? 'value="'.$beeway->groupid.'"' : ''; ?> required></input>
          </div>
        </div>

        <div class="cell HOOFDTHEMA">
          <h2 id="orange">HOOFDTHEMA</h2>
          <input type="radio" name="hoofdthemaid" value="1" <?php echo isset($beeway->themeperiodid) && $beeway->themeperiodid == 1 ? 'checked' : ''; ?> required>
          <label for="html">P1: EDI</label>
          <br>
          <input type="radio" name="hoofdthemaid" value="2" <?php echo isset($beeway->themeperiodid) && $beeway->themeperiodid == 2 ? 'checked' : ''; ?>>
          <label for="html">P2: BEGELEIDENDE INOEFENING</label>
          <br>
          <input type="radio" name="hoofdthemaid" value="3" <?php echo isset($beeway->themeperiodid) && $beeway->themeperiodid == 3 ? 'checked' : ''; ?>>
          <label for="html">P3: LEZEN</label>
          <br>
          <input type="radio" name="hoofdthemaid" value="4" <?php echo isset($beeway->themeperiodid) && $beeway->themeperiodid == 4 ? 'checked' : ''; ?>>
          <label for="html">P4: DIFFERENTIATIE EDI</label>
          <br>
          <input type="radio" name="hoofdthemaid" value="5" <?php echo isset($beeway->themeperiodid) && $beeway->themeperiodid == 5 ? 'checked' : ''; ?>>
          <label for="html">P5: DOELENPLANNER</label>
          <br>
        </div>


        <div class="cell CONCREETDOEL">
          <h2 id="orange">CONCREET DOEL</h2>
          <textarea type="text" name="concreetdoel" id="doel" maxlength="2500"><?php echo isset($beeway->concretegoal) ? $beeway->concretegoal : ''; ?></textarea>
        </div>

        <div class="cell beoordeling">
          <div class="beoordeling-item beoordeling-item1"><iconify-icon icon="fa:smile-o" style='font-size:62px'></iconify-icon></div>
          <div class="beoordeling-item beoordeling-item2">
            <input type="number" name="begoed" id="beoordeling1" onKeyDown="if(this.value.length==3 && event.keyCode!=8) return false;" <?php echo isset($beeway->begood) ? 'value="'.$beeway->begood.'"' : ''; ?> ></input>
          </div>
          <div class="beoordeling-item beoordeling-item3"><iconify-icon icon="fa:meh-o" style='font-size:62px'></iconify-icon></div>
          <div class="beoordeling-item beoordeling-item4">
            <input type="number" name="bevoldoende" id="beoordeling2" onKeyDown="if(this.value.length==3 && event.keyCode!=8) return false;" <?php echo isset($beeway->beenough) ? 'value="'.$beeway->beenough.'"' : ''; ?> ></input>
          </div>
          <div class="beoordeling-item beoordeling-item5"><iconify-icon icon="fa:frown-o" style='font-size:62px'></iconify-icon></div>
          <div class="beoordeling-item beoordeling-item6">
            <input type="number" name="beonvoldoende" id="beoordeling3" onKeyDown="if(this.value.length==3 && event.keyCode!=8) return false;" <?php echo isset($beeway->benotgood) ? 'value="'.$beeway->benotgood.'"' : ''; ?> ></input>
          </div>
        </div>


        <div class="cell vakgebied">
          <h2 id="orange">VAKGEBIED</h2>
          <select name="vakgebiedid" id="vakgebied" required>
            <option value="">-- selecteer een vakgebied --</option>
            <?php
              $sql = 'SELECT disciplinename, disciplineid
                      FROM disciplines
                      WHERE archive=0
                      AND schoolid=:schoolid';
              $sth = $conn->prepare($sql);
              $sth->bindValue(':schoolid', $schoolid);
              $sth->execute();

              while ($disciplines = $sth->fetch(PDO::FETCH_OBJ)) {
                $selected = isset($beeway->disciplineid) && $beeway->disciplineid == $disciplines->disciplineid ? 'selected="selected"' : '';
                echo '<option value="'.$disciplines->disciplineid.'" '.$selected.'>'.$disciplines->disciplinename.'</option>';
              }
            ?>
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

<?php

    } else {
      $_SESSION['error'] = 'Failed to get beeway';
      header('Location: index.php?page=beewaylijst');
      exit;
    }
  } else {
    $_SESSION['error'] = "er ging iets mis. Pech!";
    header("Location: index.php?page=dashboard");
    exit;
  }

  require_once 'include/info.inc.php';
  require_once 'include/error.inc.php';
?>
