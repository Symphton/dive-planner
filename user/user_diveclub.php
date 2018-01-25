<?php
include "../function.php";
include "../html/partials/head.php";
$id = $_GET['id'];

if (isset($_POST['submit'])) {
    $stmt = "INSERT INTO diveclub_user (id_user, id_diveclub) VALUES (?, ?)";
    $pdo->prepare($stmt)->execute([$id, $_POST['diveclub']]);
    $_SESSION['success'] = "Duikclub " . $_POST['diveclub'] . " werd succesvol toegevoegd.";
    header("location: user_diveclub.php?id=" . $id);
}

$stmt = $pdo->prepare("SELECT user.firstname, user.name, diveclub.id, diveclub.name AS diveclub FROM user INNER JOIN diveclub_user ON user.id = diveclub_user.id_user INNER JOIN diveclub ON diveclub_user.id_diveclub = diveclub.id WHERE user.id = ? ORDER BY diveclub_user.id ASC");
$stmt->execute(array($id));
$currentClubs = $stmt->fetchAll();

$diveclubs = $pdo->query("SELECT diveclub.id, diveclub.name FROM diveclub ORDER BY diveclub.name ASC;")->fetchAll();

include "../html/partials/nav.php";
?>
    <div class="container">
        <?php include "../html/partials/error_success.php"; ?>
        <h2>Duikclub overzicht voor <?php print $currentClubs[0]['firstname'] . " " . $currentClubs[0]['name']; ?></h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Duikclub</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($currentClubs as $currentClub) { ?>
                <tr>
                    <td><?php print $currentClub['diveclub']; ?></td>
                    <?php if (isAdmin()) { ?>
                        <td><a class="btn btn-outline-danger"
                               href="user_diveclub_delete.php?id=<?php print $id; ?>&diveclub=<?php print $currentClub['id']; ?>"
                               role="button">Duikclub deleten</a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <select class="form-control" id="diveclub" name="diveclub">
                        <?php foreach ($diveclubs as $diveclub) { ?>
                            <option <?php if (isset($club) and $club == $diveclub['id']) {
                                print 'selected="selected"';
                            } ?> value="<?php print $diveclub['id']; ?>"><?php print $diveclub['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <button class="btn btn-outline-success" type="submit" name="submit">Duikclub toevoegen</button>
                </div>
            </div>
        </form>
    </div>
<?php
include "../html/partials/includes.php";