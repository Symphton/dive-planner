<?php
if (!empty($_SESSION['error'])) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['error']; ?>
    </div>
<?php }
if (!empty($_SESSION['success'])) { ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['success']; ?>
    </div>
<?php }
unset($_SESSION['error']);
unset($_SESSION['success']);