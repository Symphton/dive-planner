<?php
include "../function.php";
include "../html/partials/head.php";
if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    if ($password == $password_confirm) {
        $_SESSION['success'] = "Uw wachtwoord werd succesvol gewijzigd.";
        $stmt = $pdo->prepare("UPDATE user SET password = ? WHERE id = ?");
        $stmt->execute(array(password_hash($password, 1), $_SESSION['id']));
        header("Location:index");
    } else {
        $_SESSION['error'] = "De ingegeven wachtwoorden komen niet overeen.";
    }
}
include "../html/partials/nav.php";
?>
    <div class="container">
        <?php include "../html/partials/error_success.php"; ?>
        <h2>Wachtwoord wijzigen</h2>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password">Wachtwoord</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password_confirm">Wachtwoord bevestigen</label>
                    <input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
                </div>
            </div>
            <button class="btn btn-outline-warning" type="submit" name="submit">Wachtwoord wijzigen</button>
        </form>
    </div>
<?php include "../html/partials/includes.php";