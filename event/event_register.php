<?php
include "../function.php";
include "../html/partials/head.php";
$id = $_GET['id'];
if (isset($_POST['submit'])) {
    $exercise = $_POST['exercise'];
    $carpool = $_POST['carpool'];
    $stmt = $pdo->prepare("INSERT INTO user_event (carpool, exercise, id_user, id_event) VALUES (?, ?, ?, ?)");
    $stmt->execute(array($carpool, $exercise, $_SESSION['id'], $id));
    $_SESSION['success'] = "Je hebt je succesvol geregistreerd voor het event .";
    header("Location:index");
}
include "../html/partials/nav.php";
$stmt = $pdo->prepare("SELECT name, date FROM event WHERE id = ?");
$stmt->execute(array($id));
$event = $stmt->fetch();
?>
    <div class="container">
        <?php include "../html/partials/error_success.php"; ?>
        <h2>Inschrijven voor duik <?php print $event['name'] . ' op ' . $event['date'] ?></h2>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="exercise">Wens je een vaardigheid te doen op deze duik? Zoja, welke?</label>
                    <input type="text" class="form-control" id="exercise" name="exercise">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="carpool">Kom je naar de carpool parking?</label>
                    <select class="form-control" id="carpool" name="carpool">
                        <option value=0> Nee</option>
                        <option value=1> Ja</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-outline-success" type="submit" name="submit">Inschrijven</button>
        </form>
    </div>
<?php
include "../html/partials/includes.php";