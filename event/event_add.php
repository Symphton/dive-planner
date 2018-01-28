<?php
include "../function.php";
isAdminOrDiveleaderRedirect();
include "../html/partials/head.php";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $level = $_POST['level'];
    $time_carpool = $_POST['time_carpool'];
    $time_onsite = $_POST['time_onsite'];
    $time_water = $_POST['time_water'];
    $time_tide = $_POST['time_tide'];
    $id_diveclub = $_POST['id_diveclub'];
    $id_user = $_POST['id_user'];
    $id_carpool = $_POST['id_carpool'];
    $id_divesite = $_POST['id_divesite'];
    $stmt = $pdo->prepare("INSERT INTO event (name, date, level, time_carpool, time_onsite, time_water, time_tide, id_diveclub, id_user, id_carpool, id_divesite) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(array($name, $date, $level, $time_carpool, $time_onsite, $time_water, $time_tide, $id_diveclub, $id_user, $id_carpool, $id_divesite));
    $_SESSION['success'] = 'Het event ' . $name . ' is succesvol toegevoegd.';
    header("Location:index");
}
include "../html/partials/nav.php";
$diveclubs = $pdo->query("SELECT id, name FROM diveclub ORDER BY name ASC")->fetchAll();
$carpools = $pdo->query("SELECT id, name FROM carpool ORDER BY name ASC")->fetchAll();
$users = $pdo->query("SELECT id, firstname, name FROM user ORDER BY name ASC, firstname ASC")->fetchAll();
$divesites = $pdo->query("SELECT id, name FROM divesite ORDER BY name ASC")->fetchAll();
?>
    <div class="container">
        <?php include "../html/partials/error_success.php"; ?>
        <h2>Duik toevoegen</h2>
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
                <div class="col-md-3 mb-3">
                    <label for="date">Datum (YYYY-MM-DD)</label>
                    <input type="date" class="form-control" id="date" name="date"
                           value="<?php if (isset($date)) {
                               print $date;
                           } ?>"
                           min=<?php echo date('Y-m-d'); ?>
                           pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}"
                           required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="level">Minimaal niveau</label>
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
                        } ?>>Instructeur (I1 - I2 - I3)
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="time_carpool">Uur Carpool</label>
                    <input type="time" class="form-control" id="time_carpool" name="time_carpool"
                           value="<?php if (isset($time_carpool)) {
                               print $time_carpool;
                           } ?>"
                           step="60"
                           required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="time_onsite">Uur ter plaatse</label>
                    <input type="time" class="form-control" id="time_onsite" name="time_onsite"
                           value="<?php if (isset($time_onsite)) {
                               print $time_onsite;
                           } ?>"
                           step="60"
                           required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="time_water">Uur te water</label>
                    <input type="time" class="form-control" id="time_water" name="time_water"
                           value="<?php if (isset($time_water)) {
                               print $time_water;
                           } ?>"
                           step="60"
                           required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="time_tide">Uur getijde</label>
                    <input type="time" class="form-control" id="time_tide" name="time_tide"
                           value="<?php if (isset($time_tide)) {
                               print $time_tide;
                           } ?>"
                           step="60">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="id_diveclub">Organiserende duikclub</label>
                    <select class="form-control" id="id_diveclub" name="id_diveclub">
                        <?php foreach ($diveclubs as $diveclub) { ?>
                            <option <?php if (isset($id_diveclub) and $id_diveclub == $diveclub['id']) {
                                print 'selected="selected"';
                            } ?> value="<?php print $diveclub['id']; ?>"><?php print $diveclub['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="id_user">Duikverantwoordelijke</label>
                    <select class="form-control" id="id_user" name="id_user">
                        <?php foreach ($users as $user) { ?>
                            <option <?php if (isset($id_user) and $id_user == $user['id']) {
                                print 'selected="selected"';
                            } ?> value="<?php print $user['id']; ?>"><?php print $user['name'] . " " . $user['firstname']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="id_carpool">Carpool locatie</label>
                    <select class="form-control" id="id_carpool" name="id_carpool">
                        <?php foreach ($carpools as $carpool) { ?>
                            <option <?php if (isset($id_carpool) and $id_carpool == $carpool['id']) {
                                print 'selected="selected"';
                            } ?> value="<?php print $carpool['id']; ?>"><?php print $carpool['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="id_divesite">Duikplaats</label>
                    <select class="form-control" id="id_divesite" name="id_divesite">
                        <?php foreach ($divesites as $divesite) { ?>
                            <option <?php if (isset($id_divesite) and $id_divesite == $divesite['id']) {
                                print 'selected="selected"';
                            } ?> value="<?php print $divesite['id']; ?>"><?php print $divesite['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <button class="btn btn-outline-success" type="submit" name="submit">Duik toevoegen</button>
        </form>
    </div>
<?php
include "../html/partials/includes.php";