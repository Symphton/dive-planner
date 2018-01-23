<?php
include "../function.php";
include "../html/partials/head.php";
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM diveclub WHERE id = ?");
$stmt->execute(array($id));
$diveclub = $stmt->fetch();

$name = $diveclub['name'];
$city = $diveclub['city'];
$fed = $diveclub['id_federation'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $city = $_POST['city'];
    $fed = $_POST['federation'];
    $stmt = $pdo->prepare("UPDATE diveclub SET name = ?, city = ?, id_federation = ? WHERE id = ?");
    $stmt->execute(array($name, $city, $fed, $id));
    header("Location:index.php");
}
include "../html/partials/nav.php";
$federations = $pdo->query("SELECT * FROM federation ORDER BY name ASC")->fetchAll();
?>
    <div class="container">
        <h2>Duikclub wijzigen</h2>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Naam</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="<?php if (isset($name)) {
                               print $name;
                           } ?>"
                           required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name">Stad</label>
                    <input type="text" class="form-control" id="city" name="city"
                           value="<?php if (isset($city)) {
                               print $city;
                           } ?>"
                           required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="federation">Federatie</label>
                    <select class="form-control" id="federation" name="federation">
                        <?php foreach ($federations as $federation) { ?>
                            <option <?php if (isset($fed) and $fed == $federation['id']) {
                                print 'selected="selected"';
                            } ?> value="<?php print $federation['id']; ?>"><?php print $federation['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <button class="btn btn-outline-warning" type="submit" name="submit">Duikclub wijzigen</button>
        </form>
    </div>
<?php
include "../html/partials/includes.php";