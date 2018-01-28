<?php
include "../function.php";
isAdminRedirect();
include "../html/partials/head.php";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $level = $_POST['level'];
    $fed = $_POST['federation'];
    $stmt = $pdo->prepare("INSERT INTO certificate (name, level, id_federation) VALUES (?, ?, ?)");
    $stmt->execute(array($name, $level, $fed));
    header("Location:index");
}
include "../html/partials/nav.php";
$federations = $pdo->query("SELECT * FROM federation ORDER BY name ASC")->fetchAll();
?>
    <div class="container">
        <h2>Certificatie toevoegen</h2>
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
                <div class="col-md-3 mb-3">
                    <label for="level">Niveau</label>
                    <select class="form-control" id="level" name="level">
                        <option value=0 <?php if (isset($level) and $level == 0) {
                            print 'selected="selected"';
                        } ?>>Kandidaat (KD1)
                        </option>
                        <option value=1 <?php if (isset($level) and $level == 1) {
                            print 'selected="selected"';
                        } ?>>Beginner (D1)
                        </option>
                        <option value=2 <?php if (isset($level) and $level == 2) {
                            print 'selected="selected"';
                        } ?>>Gevorderd (D2)
                        </option>
                        <option value=3 <?php if (isset($level) and $level == 3) {
                            print 'selected="selected"';
                        } ?>>Expert (D3 - D4)
                        </option>
                        <option value=4 <?php if (isset($level) and $level == 4) {
                            print 'selected="selected"';
                        } ?>>Instructeur (AI - I1 - I2 - I3)
                        </option>
                    </select>
                </div>
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
            <button class="btn btn-outline-success" type="submit" name="submit">Certificatie toevoegen</button>
        </form>
    </div>
<?php
include "../html/partials/includes.php";