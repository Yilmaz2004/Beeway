<?php
  if (isset($_SESSION['userid']) && isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'admin') { // check if user is logedin

    $sql = "SELECT * FROM maintheme WHERE themeid=:themeid";
    $sth = $conn->prepare($sql);
    $sth->bindParam(':themeid', $_GET['mainthemeid']);
    $sth->execute();

    while ($row = $sth->fetch(PDO::FETCH_OBJ)) {
      echo '
        <div class="addedit">
          <form class="form" action="php/editmaintheme.php?mainthemeid='.$_GET['mainthemeid'].'" method="POST">
            <div id="name">
              <h1>Hoofdthema bewerken</h1>
              <p>bestaande hoofdtema aanpassen in het systeem</p>
            </div>
            <hr style="margin: 20px 0;">
            <div id="LP">
              <label for="NaamThemaP1"><b>Hoofdthema naam Periode 1</b></label>
              <input id="textaddedit" type="text" placeholder="NaamThemaP1" name="namethemep1" value="'.$row->namethemep1.'" required>
              <label for="NaamThemaP2"><b>Hoofdthema naam Periode 2</b></label>
              <input id="textaddedit" type="text" placeholder="NaamThemaP2" name="namethemep2" value="'.$row->namethemep2.'" required>
              <label for="NaamThemaP3"><b>Hoofdthema naam Periode 3</b></label>
              <input id="textaddedit" type="text" placeholder="NaamThemaP3" name="namethemep3" value="'.$row->namethemep3.'" required>
            </div>
            <div id="RP">
              <label for="NaamThemaP4"><b>Hoofdthema naam Periode 4</b></label>
              <input id="textaddedit" type="text" placeholder="NaamThemaP4" name="namethemep4" value="'.$row->namethemep4.'" required>
              <label for="NaamThemaP5"><b>Hoofdthema naam Periode 5</b></label>
              <input id="textaddedit" type="text" placeholder="NaamThemaP5" name="namethemep5" value="'.$row->namethemep5.'" required>

              <label for="Schooljaar"><b>Schooljaar</b></label>
              <select id="selectaddedit" name="schoolyear">
                <optgroup label="Selecteer een Schooljaar">
                  <option type="dropdown" placeholder="Schooljaar" value="1" '. ($row->schoolyear == 1 ? 'selected' : '') .'>2021/2022</option>
                  <option type="dropdown" placeholder="Schooljaar" value="2" '. ($row->schoolyear == 2 ? 'selected' : '') .'>2022/2023</option>
                  <option type="dropdown" placeholder="Schooljaar" value="3" '. ($row->schoolyear == 3 ? 'selected' : '') .'>2023/2024</option>
                  <option type="dropdown" placeholder="Schooljaar" value="4" '. ($row->schoolyear == 4 ? 'selected' : '') .'>2024/2025</option>
                  <option type="dropdown" placeholder="Schooljaar" value="5" '. ($row->schoolyear == 5 ? 'selected' : '') .'>2025/2026</option>
                  <option type="dropdown" placeholder="Schooljaar" value="6" '. ($row->schoolyear == 6 ? 'selected' : '') .'>2026/2027</option>
                </optgroup>
              </select>
            </div>

            <hr style="margin: 20px 0;">
            <div class="form-wrapper">
              <button type="submit" class="addbutton" style="font-size:20px;font-weight: bold;">Hoofdthema bewerken</button>
              <a id="hoofdthemadelete" style="font-size:20px;font-weight: bold; float:right;" onclick="return confirm(\'Weet je zeker dat je deze beeway wilt verwijderen!?\')" href="php/deletemaintheme.php?themeid='.$row->themeid.'" class="deletebutton">Hoofdthema verwijderen</a>
            </div>
          </form>
        </div>
      ';
    }


  } else {
    $_SESSION['error'] = "er ging iets mis. Pech!";
    header("Location: index.php?page=dashboard");
    exit;
  }

  require_once 'include/info.inc.php';
  require_once 'include/error.inc.php';
?>
