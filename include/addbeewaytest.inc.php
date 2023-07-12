<?php
  $sql = 'SELECT schoolid
       FROM users
       WHERE schoolid<>0
       AND archive<>1
       AND userid=:userid';
  $sth = $conn->prepare($sql);
  $sth->bindValue(':userid', $_SESSION['userid']);
  $sth->execute();

  $result = $sth->fetch();

  if ($result !== false) {
      $schoolid = $result['schoolid'];
  } else {
      // Handle the case when no rows were found
      $_SESSION['error'] = "er ging iets mis met het ophalen van je school. <br> je kan deze beeway nu niet opslaan!";
  }
?>

  <div class="beewayedit">
    <form id="form0" action="php/addbeewaytest.php" method="post">
    <div><input type="text" placeholder="BeewayNaam" name="beewaynaam" required></div>
    <div><button id="opslaan" class="addbutton" type="submit" style="font-size: 16px;">Opslaan</button></div>
  </div>

  <hr>

  <div class="helebeeway">
    <div id="grid-line">
      <div class="cell BEEWAY">
        <h1>[naam]</h1>
        <h2>Iedere dag ’n beetje beter</h2>
        <div id="groepen">
          <label>Groepen</label>
          <select name="groepen" required>
            <option value="">-- selecteer een groep --</option>
            <?php
              $sql = 'SELECT DISTINCT g.groups, g.groupid
                      FROM groups AS g
                      INNER JOIN linkgroups AS lg ON g.groupid = lg.groupid
                      WHERE g.archive = 0
                      AND g.schoolid = :schoolid
                      AND lg.userid = :userid';
              $sth = $conn->prepare($sql);
              $sth->bindValue(':schoolid', $schoolid);
              $sth->bindValue(':userid', $_SESSION['userid']);
              $sth->execute();

              while ($group = $sth->fetch(PDO::FETCH_OBJ)) {
                $selected = isset($beeway->groupid) && $beeway->groupid == $group->groupid ? 'selected="selected"' : '';
                echo '<option value="'.$group->groupid.'" '.$selected.'>'.$group->groups.'</option>';
              }
            ?>
          </select>
        </div>
      </div>

      <div class="cell HOOFDTHEMA">
        <h2 id="orange">HOOFDTHEMA</h2>
        <input type="radio" name="hoofdthemaid" value="1" required>
        <label for="html">P1: EDI</label>
        <br>
        <input type="radio" name="hoofdthemaid" value="2">
        <label for="html">P2: BEGELEIDENDE INOEFENING</label>
        <br>
        <input type="radio" name="hoofdthemaid" value="3">
        <label for="html">P3: LEZEN</label>
        <br>
        <input type="radio" name="hoofdthemaid" value="4">
        <label for="html">P4: DIFFERENTIATIE EDI</label>
        <br>
        <input type="radio" name="hoofdthemaid" value="5">
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
                $selected = '';
                if (isset($_SESSION['disciplines']) && $disciplines->disciplineid == $_SESSION['disciplines']) {
                  $selected = 'selected="selected"';
                  unset($_SESSION['disciplines']);
                }
                echo '<option value="'.$disciplines->disciplineid.'" '.$selected.'>'.$disciplines->disciplinename.'</option>';
              }
            ?>
        </select>
    </div>
  </div>

  <table style="width:80%;">
    <tr style="background-color:#feae00;">
      <th>Planning</th>
      <th>Wat</th>
      <th>Wie</th>
      <th>Deadline</th>
      <th style="width:60px;">&#x2714;</th>
    </tr>

    <?php for($i = 1; $i <= 8; $i++): ?>
      <tr>
        <td><textarea class='editable-input textareaobservatie' name='planning[<?php echo $i; ?>][planning]' rows='3' maxlength='155'></textarea></td>
        <td><textarea class='editable-input textareaobservatie' name='planning[<?php echo $i; ?>][planningwhat]' rows='3' maxlength='155'></textarea></td>
        <td><textarea class='editable-input textareaobservatie' name='planning[<?php echo $i; ?>][planningwho]' rows='3' maxlength='155'></textarea></td>
        <td><textarea class='editable-input textareaobservatie' name='planning[<?php echo $i; ?>][planningdeadline]' rows='3' maxlength='155'></textarea></td>
        <td style='background-color:white;border-style:solid;border-width: 0.8px;padding: 1rem;'><input class='editable-input' type='checkbox' name='planning[<?php echo $i; ?>][planningdone]' value='1'></td>
      </tr>
    <?php endfor; ?>
  </table>

  <table style="width:80%;">
    <tr style="background-color:#feae00;">
      <th>Dataclass</th>
      <th>Leerdoel</th>
      <th>Evaluatie</th>
      <th>Werkdoel</th>
      <th>Actie</th>
    </tr>

    <?php for($i = 1; $i <= 5; $i++): ?>
      <tr>
        <td><textarea class='editable-input textareaobservatie' name='observation[<?php echo $i; ?>][dataclass]' rows='3' maxlength='155'></textarea></td>
        <td><textarea class='editable-input textareaobservatie' name='observation[<?php echo $i; ?>][learninggoal]' rows='3' maxlength='155'></textarea></td>
        <td><textarea class='editable-input textareaobservatie' name='observation[<?php echo $i; ?>][evaluation]' rows='3' maxlength='155'></textarea></td>
        <td><textarea class='editable-input textareaobservatie' name='observation[<?php echo $i; ?>][workgoal]' rows='3' maxlength='155'></textarea></td>
        <td><textarea class='editable-input textareaobservatie' name='observation[<?php echo $i; ?>][action]' rows='3' maxlength='155'></textarea></td>
      </tr>
    <?php endfor; ?>
  </table>
</form>
</div>
