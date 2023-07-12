<?php
  $servername = "localhost";
  $username = "beeway";
  $password = "qwerty";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=beeway", $username, $password);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
  }
?>
