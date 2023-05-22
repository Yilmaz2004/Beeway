<?php
  if (isset($_SESSION['info'])) {
    echo '<div id="error-message" class="alert info"><strong>info,</strong> '.$_SESSION['info'].'</div>';
    unset($_SESSION['info']);

    // some JavaScript to remove the info message after 10 seconds
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
