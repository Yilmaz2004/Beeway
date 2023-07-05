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
      <!-- <optgroup label="Selecteer een vakgebied"> -->
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
      <!-- </optgroup> -->
    </select>
  <!-- </form> -->
</div>
</div>

<!-- <form method="POST" action=""> -->
    <!-- Table for Planning -->
    <table>
        <tr>
            <th>Planning</th>
            <th>Planning What</th>
            <th>Planning Who</th>
            <th>Planning Deadline</th>
            <th>Planning Done</th>
        </tr>

        <?php for($i = 1; $i <= 8; $i++): ?>
            <tr>
                <td><input type="text" name="planning[<?php echo $i; ?>][planning]" value=""></td>
                <td><input type="text" name="planning[<?php echo $i; ?>][planningwhat]" value=""></td>
                <td><input type="text" name="planning[<?php echo $i; ?>][planningwho]" value=""></td>
                <td><input type="text" name="planning[<?php echo $i; ?>][planningdeadline]" value=""></td>
                <td><input type="checkbox" name="planning[<?php echo $i; ?>][planningdone]"></td>
            </tr>
        <?php endfor; ?>
    </table>

    <!-- Table for Observation -->
    <table>
        <tr>
            <th>Data Class</th>
            <th>Learning Goal</th>
            <th>Evaluation</th>
            <th>Work Goal</th>
            <th>Action</th>
        </tr>

        <?php for($i = 1; $i <= 8; $i++): ?>
            <tr>
                <td><input type="text" name="observation[<?php echo $i; ?>][dataclass]" value=""></td>
                <td><input type="text" name="observation[<?php echo $i; ?>][learninggoal]" value=""></td>
                <td><input type="text" name="observation[<?php echo $i; ?>][evaluation]" value=""></td>
                <td><input type="text" name="observation[<?php echo $i; ?>][workgoal]" value=""></td>
                <td><input type="text" name="observation[<?php echo $i; ?>][action]" value=""></td>
            </tr>
        <?php endfor; ?>
    </table>
</form>
</div>
