<?php

// echo print_r($_SESSION['error']);
if (isset($_SESSION['error'])) {
      $errors = $_SESSION['error'];
      unset($_SESSION['error']);
      foreach ($errors as $error) {
?>
            <div class="container">
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><?= $error ?></strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
            </div>
<?php
      }
} ?>
<?php
if (isset($_SESSION['success'])) {
      $success = $_SESSION['success'];
      unset($_SESSION['success']); ?>
      <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong><?= $success ?></strong>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
      </div>

<?php } ?>