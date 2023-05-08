<style>
  body{ background: linear-gradient(to bottom right, #c18ac1, #da9f71, #71d3f4, #c4de87); }
</style>
<div class="header">
  <div class="title">
    <h1 id="title" data-value="BEEWAY">BEEWAY</h1>
  </div>
  <script src="script/login.js"></script>
</div>

<form class="form" method="POST" action="php/login.php">
  <div class="login">

    <div id="logintittle"><h1>Login <iconify-icon icon="akar-icons:person"></iconify-icon></h1></div>
    <hr>
    <br>

    <label for="rol"><b>Je school</b></label>
    <br>
    <select id="schoolselect" name="school">
      <option value="0" selected="selected">-- selecteer je school --</option>
      <?php
        $sql = 'SELECT schoolname
                FROM schools
                WHERE schoolid<>"0"
                AND archive<>"1"';
        $sth = $conn->prepare($sql);
        $sth->execute();

        while ($schools = $sth->fetch(PDO::FETCH_OBJ)) {
          echo'
          <option value="1">'.$schools->schoolname.'</option>
          ';
        }
      ?>
    </select>

    <label for="email"><b>Email</b></label>
    <br>
    <input type="email" placeholder="Enter Email" name="email" id="email" required>

    <label for="psw"><b>Password</b></label>
    <br>
    <input type="password" placeholder="Enter Password" name="password" id="psw" required>


    <hr>

    <div class="tooltip">Nog geen account?
      <span class="tooltiptext">Vraag de admin van je school om een account voor je aan te maken</span>
    </div>

    <!-- <input type="checkbox" id="rememberme"></input>
    <label for="rememberme">Remember Me</label> -->

    <button type="submit" class="registerbtn" id="loginbtn">Login</button>

  </div>
</form>

<?php include 'include/error.inc.php'; ?>
