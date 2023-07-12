<?php
  if (isset($_SESSION['userid']) && isset($_SESSION['userrole']) && $_SESSION['userrole'] == 'admin') { // check if user is logedin

    $sql = "SELECT * FROM disciplines WHERE disciplineid = :disciplineid";
    $sth = $conn->prepare($sql);
    $sth->bindParam(':disciplineid', $_GET['disciplineid']);
    $sth->execute();

    if ($discipline = $sth->fetch(PDO::FETCH_OBJ)) {
    echo '
      <div class="addeditdiscipline">
        <form class="form" action="php/editdiscipline.php?disciplineid='.$_GET['disciplineid'].'" method="POST">
          <div id="name"><h1>vakken aanpassen</h1>
          <p>pas het vak aan</p></div>
          <hr style="margin: 20px 0;">

          <label for="vak"><b>vak</b></label>
          <br>
            <input id="textaddedit" type="text" placeholder="vak" name="disciplinename" value="'.$discipline->disciplinename.'" required>
            <hr style="margin: 20px 0;">
            <button type="submit" class="adddisciplinerbtn" style="font-size:20px;font-weight: bold;">vak opslaan</button>
            <a id="disciplinedelete"style="font-size:20px;font-weight: bold; float:right;"'; ?> onclick='return confirm("Weet je zekker dat je deze vak wilt verwijderen!?")' <?php echo ' href="php/deletediscipline.php?disciplineid='.$discipline->disciplineid.'" class="deletebutton" >vak verwijderen</a>
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
