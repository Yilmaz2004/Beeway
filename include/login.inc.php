<?php
  if (isset($_SESSION['userid']) && isset($_SESSION['userrole'])) {
    header("Location: index.php?page=dashboard");
    exit;
  }
?>

<style>
  body {
    background: linear-gradient(to bottom right, #c18ac1, #da9f71, #71d3f4, #c4de87);
  }
</style>

<div class="header">
  <div class="title">
    <h1 id="title" data-value="BEEWAY">BEEWAY</h1>
  </div>
  <script src="script/login.js"></script>
</div>

<form class="form" method="POST" action="php/login.php">
  <div class="login">
    <div id="logintittle">
      <h1>Login <iconify-icon icon="akar-icons:person"></iconify-icon></h1>
    </div>
    <hr>
    <br>

    <label for="schoolselect"><b>Je school</b></label>
    <br>
    <select id="schoolselect" name="schoolselect">
      <option value="0" selected>-- selecteer je school --</option>
      <?php
        $sql = 'SELECT schoolname, schoolid
                FROM schools
                WHERE schoolid <> 0
                AND archive = 0';
        $sth = $conn->prepare($sql);
        $sth->execute();

        while ($schools = $sth->fetch(PDO::FETCH_OBJ)) {
          $selected = ($_SESSION['school'] ?? null) == $schools->schoolid ? 'selected' : '';
          echo '<option value="' . $schools->schoolid . '" ' . $selected . '>' . $schools->schoolname . '</option>';
        }
      ?>
    </select>

    <label for="email"><b>Email</b></label>
    <br>
    <input type="text" placeholder="Enter Email" name="email" id="email"
      value="<?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" required>
    <?php
      unset($_SESSION['email']);
      unset($_SESSION['school']);
    ?>

    <label for="password"><b>Password</b></label>
    <br>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>

    <hr>

    <div class="tooltip">Nog geen account?
      <span class="tooltiptext">Vraag de admin van je school om een account voor je aan te maken</span>
    </div>

    <!-- <input type="checkbox" id="rememberme"></input>
    <label for="rememberme">Remember Me</label> -->

    <button type="submit" class="registerbtn" id="loginbtn">Login</button>
  </div>
</form>

<?php
  require_once 'include/error.inc.php';
  require_once 'include/info.inc.php';
?>
