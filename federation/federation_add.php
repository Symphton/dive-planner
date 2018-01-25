<?php
include "../function.php";
include "../html/partials/head.php";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $stmt = $pdo->prepare("INSERT INTO federation (name) VALUES (?)");
    $stmt->execute(array($name));
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
            <button class="btn btn-outline-success" type="submit" name="submit">Federatie toevoegen</button>
        </form>
    </div>
<?php
include "../html/partials/includes.php";