<?php
include "../function.php";
isAdminOrInstructorRedirect();
$id = $_POST['id'];
if (isset($_POST['submit'])) {
    $stmt = $pdo->prepare("UPDATE user SET deleted = 1 WHERE id = ?");
    $stmt->execute(array($id));
    $_SESSION['success'] = 'De user werd met succes verwijderd.';
    header("location: index");
} else {
    $stmt = $pdo->prepare("SELECT firstname FROM user WHERE id = ?");
    $stmt->execute(array($id));
    $firstname = $stmt->fetchColumn();
    include "../html/partials/head.php";
    include "../html/partials/nav.php";
    ?>
    <div class="container">
    <div class="row justify-content-md-center">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h3>Wil je <?php print $firstname; ?> verwijderen?</h3>
                    <div class="btn-group">
                        <form class="form-signin" action="" method="post">
                            <input type="hidden" id="id" name="id" value="<?php print $id; ?>">
                            <input class="btn btn-outline-success" type="submit" value="Ja" name="submit">
                        </form>
                        <form class="form-signin" action="user" method="post">
                            <input class="btn btn-outline-danger" type="submit" value="Nee" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}