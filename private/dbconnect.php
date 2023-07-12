<?php
  $servername = "localhost";
  $username = "Beeway";
  $password = "Welkom1";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=beeway", $username, $password);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
  }
?>
