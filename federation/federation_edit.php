<?php
include "../function.php";
isAdminRedirect();
include "../html/partials/head.php";
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM federation WHERE id = ?");
$stmt->execute(array($id));
$federation = $stmt->fetch();

$name = $federation['name'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $stmt = $pdo->prepare("UPDATE federation SET name = ? WHERE id = ?");
    $stmt->execute(array($name, $id));
    header("Location:index");
}
include "../html/partials/nav.php";
?>
    <div class="container">
        <h2>Federatie toevoegen</h2>
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
            <button class="btn btn-outline-warning" type="submit" name="submit">Federatie toevoegen</button>
        </form>
    </div>
<?php
include "../html/partials/includes.php";