<link href="/css/signin.css" rel="stylesheet">
<?php
include "html/partials/connect.php";
session_start();
$error = '';
include "html/partials/head.php";
if (isset($_SESSION['email'])) {
    header("location: event/event.php");
}
include "login.php";
include "html/partials/nav.php";
?>
<div class="container">
    <?php if ($error != '') { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php } ?>
    <form class="form-signin" action="" method="post">
        <h2 class="form-signin-heading"> Login </h2>
        <label for="email" class="sr-only"> Emailadres </label>
        <input type="email" id="email" class="form-control" placeholder="Emailadres" name="email" required
               autofocus>
        <label for="password" class="sr-only"> Wachtwoord</label>
        <input type="password" id="password" class="form-control" placeholder="Wachtwoord" name="password" required>
        <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="submit">
    </form>
</div>
<?php
include "html/partials/includes.php";