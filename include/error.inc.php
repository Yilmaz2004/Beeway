<?php

  if (isset($_SESSION['error'])) {
    echo '<div id="error-message" class="alert warning"><strong>error,</strong> '.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);

    // some JavaScript to remove the error message after 10 seconds
    echo '<script>
      setTimeout(function() {
        var errorMessage = document.getElementById("error-message");
        if (errorMessage != null) {
          errorMessage.remove();
        }
      }, 8000);
    </script>';
  }

?>
