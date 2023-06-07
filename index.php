<?php
  // Check if the 'page' parameter is set in the URL
  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  }

  // require_once the database connection file
  require_once 'private/dbconnect.php';
  // Start a new session
  session_start();

  // Store the user agent string in the session
  $_SESSION['useragent'] = $_SERVER['HTTP_USER_AGENT'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset = "UTF-8">
  <!-- Set the title of the page based on the 'page' parameter in the URL, or default to "Home" -->
  <title><?php if (isset($page)) { echo $page; } else {echo "Home";}?></title>
  <link rel="icon" type="image/x-icon" href="media/favicon.ico">
  <link href="style/style.css" rel="stylesheet">
  <link href="style/beheer.css" rel="stylesheet">
  <link href="style/beewaystyle.css" rel="stylesheet">
  <!-- require_once necessary scripts -->
  <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.0-beta.3/dist/iconify-icon.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</head>
<body>

  <?php
    // require_once the navigation bar
    require_once 'include/navbar.inc.php';

    // If the 'page' parameter is set and the user is logged in with a role, require_once the corresponding page
    if (isset($page) && isset($_SESSION['userid']) && isset($_SESSION['userrole'])) {
      require_once 'include/'.$page.'.inc.php';
    } else {
      // Otherwise, require_once the login page
      require_once 'include/login.inc.php';
    }

    // Debugging: display the contents of the session
    echo "<pre>", print_r($_SESSION),"</pre>";

    require_once 'include/error.inc.php';
    require_once 'include/info.inc.php';
  ?>

</body>
</html>
