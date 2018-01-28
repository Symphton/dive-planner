<?php
include "../function.php";
isAdminOrDiveleaderRedirect();
include "../html/partials/head.php";
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM divesite WHERE id = ?");
$stmt->execute(array($id));
$divesite = $stmt->fetch();

$name = $divesite['name'];
$street = $divesite['street'];
$number = $divesite['number'];
$zip = $divesite['zip'];
$city = $divesite['city'];
$country = $divesite['country'];
$depth = $divesite['depth'];
$ehbo = $divesite['ehbo'];
$o2 = $divesite['o2'];
$telephone = $divesite['telephone'];
$safety = $divesite['safety'];
$entrance = $divesite['entrance'];
$flag = $divesite['flag'];
$danger = $divesite['danger'];
$permission = $divesite['permission'];
$fee = $divesite['fee'];
$parking = $divesite['parking'];
$cafetaria = $divesite['cafetaria'];
$shower = $divesite['shower'];
$changingroom = $divesite['changingroom'];
$compressor = $divesite['compressor'];
$underground = $divesite['underground'];
$fish = $divesite['fish'];
$visibility = $divesite['visibility'];
$info = $divesite['info'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $street = $_POST['street'];
    $number = $_POST['number'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $depth = $_POST['depth'];
    $ehbo = $_POST['ehbo'];
    $o2 = $_POST['o2'];
    $telephone = $_POST['telephone'];
    $safety = $_POST['safety'];
    $entrance = $_POST['entrance'];
    $flag = $_POST['flag'];
    $danger = $_POST['danger'];
    $permission = $_POST['permission'];
    $fee = $_POST['fee'];
    $parking = $_POST['parking'];
    $cafetaria = $_POST['cafetaria'];
    $shower = $_POST['shower'];
    $changingroom = $_POST['changingroom'];
    $compressor = $_POST['compressor'];
    $underground = $_POST['underground'];
    $fish = $_POST['fish'];
    $visibility = $_POST['visibility'];
    $info = $_POST['info'];
    $stmt = $pdo->prepare("UPDATE divesite SET name = ?, street = ?, number = ?, zip = ?, city = ?, country = ?, depth = ?, ehbo = ?, o2 = ?, telephone = ?, safety = ?, entrance = ?, flag = ?, danger = ?, permission = ?, fee = ?, parking = ?, cafetaria = ?, shower = ?, changingroom = ?, compressor =?,  underground = ?, fish = ?, visibility = ?, info = ? WHERE id = ?");
    $stmt->execute(array($name, $street, $number, $zip, $city, $country, $depth, $ehbo, $o2, $telephone, $safety, $entrance, $flag, $danger, $permission, $fee, $parking, $cafetaria, $shower, $changingroom, $compressor, $underground, $fish, $visibility, $info, $id));
    header("Location:index");
}
include "../html/partials/nav.php";
$federations = $pdo->query("SELECT * FROM federation ORDER BY name ASC")->fetchAll();
?>
    <div class="container">
        <h2>Duikplaats wijzigen</h2>
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
                <div class="col-md-2 mb-3">
                    <label for="depth">Maximale diepte</label>
                    <input type="number" class="form-control" id="depth" name="depth"
                           value="<?php if (isset($depth)) {
                               print $depth;
                           } ?>"
                           required>
                </div>
                <div class="col-md-2 mb-3">
                    <label for="fee">Prijs</label>
                    <input type="number" class="form-control" id="fee" name="fee"
                           value="<?php if (isset($fee)) {
                               print $fee;
                           } ?>"
                           required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="street">Straat</label>
                    <input type="text" class="form-control" id="street" name="street"
                           value="<?php if (isset($street)) {
                               print $street;
                           } ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="number">Huisnummer / Bus</label>
                    <input type="text" class="form-control" id="number" name="number"
                           value="<?php if (isset($number)) {
                               print $number;
                           } ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="zip">Postcode</label>
                    <input type="text" class="form-control" id="zip" name="zip"
                           value="<?php if (isset($zip)) {
                               print $zip;
                           } ?>" required>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="city">Stad</label>
                    <input type="text" class="form-control" id="city" name="city"
                           value="<?php if (isset($city)) {
                               print $city;
                           } ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="country">Land</label>
                    <select class="form-control" id="country" name="country">
                        <option <?php if (isset($country) and $country == "Belgie") {
                            print 'selected="selected"';
                        } ?>>Belgie
                        </option>
                        <option <?php if (isset($country) and $country == "Duitsland") {
                            print 'selected="selected"';
                        } ?>>Duitsland
                        </option>
                        <option <?php if (isset($country) and $country == "Nederland") {
                            print 'selected="selected"';
                        } ?>>Nederland
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="ehbo">EHBO aanwezig?</label>
                    <select class="form-control" id="ehbo" name="ehbo">
                        <option value="0" <?php if (isset($ehbo) and $ehbo == 0) {
                            print 'selected="selected"';
                        } ?>>Nee
                        </option>
                        <option value="1" <?php if (isset($ehbo) and $ehbo == 1) {
                            print 'selected="selected"';
                        } ?>>Ja
                        </option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="o2">o2 aanwezig?</label>
                    <select class="form-control" id="o2" name="o2">
                        <option value="0" <?php if (isset($o2) and $o2 == 0) {
                            print 'selected="selected"';
                        } ?>>Nee
                        </option>
                        <option value="1" <?php if (isset($o2) and $o2 == 1) {
                            print 'selected="selected"';
                        } ?>>Ja
                        </option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="telephone">Telefoon beschikbaar?</label>
                    <select class="form-control" id="telephone" name="telephone">
                        <option value="0" <?php if (isset($telephone) and $telephone == 0) {
                            print 'selected="selected"';
                        } ?>>Nee
                        </option>
                        <option value="1" <?php if (isset($telephone) and $telephone == 1) {
                            print 'selected="selected"';
                        } ?>>Ja
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="safety">Safetyteam beschikbaar?</label>
                    <select class="form-control" id="safety" name="safety">
                        <option value="0" <?php if (isset($safety) and $safety == 0) {
                            print 'selected="selected"';
                        } ?>>Nee
                        </option>
                        <option value="1" <?php if (isset($safety) and $safety == 1) {
                            print 'selected="selected"';
                        } ?>>Ja
                        </option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="entrance">Trap beschikbaar?</label>
                    <select class="form-control" id="entrance" name="entrance">
                        <option value="0" <?php if (isset($entrance) and $entrance == 0) {
                            print 'selected="selected"';
                        } ?>>Nee
                        </option>
                        <option value="1" <?php if (isset($entrance) and $entrance == 1) {
                            print 'selected="selected"';
                        } ?>>Ja
                        </option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="flag">Duikvlag aanwezig?</label>
                    <select class="form-control" id="flag" name="flag">
                        <option value="0" <?php if (isset($flag) and $flag == 0) {
                            print 'selected="selected"';
                        } ?>>Nee
                        </option>
                        <option value="1" <?php if (isset($flag) and $flag == 1) {
                            print 'selected="selected"';
                        } ?>>Ja
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="permission">Toelating nodig?</label>
                    <select class="form-control" id="permission" name="permission">
                        <option value="0" <?php if (isset($permission) and $permission == 0) {
                            print 'selected="selected"';
                        } ?>>Nee
                        </option>
                        <option value="1" <?php if (isset($permission) and $permission == 1) {
                            print 'selected="selected"';
                        } ?>>Ja
                        </option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="parking">Parking beschikbaar?</label>
                    <select class="form-control" id="parking" name="parking">
                        <option value="0" <?php if (isset($parking) and $parking == 0) {
                            print 'selected="selected"';
                        } ?>>Nee
                        </option>
                        <option value="1" <?php if (isset($parking) and $parking == 1) {
                            print 'selected="selected"';
                        } ?>>Ja
                        </option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="compressor">Compressor beschikbaar?</label>
                    <select class="form-control" id="compressor" name="compressor">
                        <option value="0" <?php if (isset($compressor) and $compressor == 0) {
                            print 'selected="selected"';
                        } ?>>Nee
                        </option>
                        <option value="1" <?php if (isset($compressor) and $compressor == 1) {
                            print 'selected="selected"';
                        } ?>>Ja
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="cafetaria">Cafetaria beschikbaar?</label>
                    <select class="form-control" id="cafetaria" name="cafetaria">
                        <option value="0" <?php if (isset($cafetaria) and $cafetaria == 0) {
                            print 'selected="selected"';
                        } ?>>Nee
                        </option>
                        <option value="1" <?php if (isset($cafetaria) and $cafetaria == 1) {
                            print 'selected="selected"';
                        } ?>>Ja
                        </option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="changingroom">Kleedkamer beschikbaar?</label>
                    <select class="form-control" id="changingroom" name="changingroom">
                        <option value="0" <?php if (isset($changingroom) and $changingroom == 0) {
                            print 'selected="selected"';
                        } ?>>Nee
                        </option>
                        <option value="1" <?php if (isset($changingroom) and $changingroom == 1) {
                            print 'selected="selected"';
                        } ?>>Ja
                        </option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="shower">Douches beschikbaar?</label>
                    <select class="form-control" id="shower" name="shower">
                        <option value="0" <?php if (isset($shower) and $shower == 0) {
                            print 'selected="selected"';
                        } ?>>Nee
                        </option>
                        <option value="1" <?php if (isset($shower) and $shower == 1) {
                            print 'selected="selected"';
                        } ?>>Ja
                        </option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="underground">Bodem</label>
                    <input type="text" class="form-control" id="underground" name="underground"
                           value="<?php if (isset($underground)) {
                               print $underground;
                           } ?>">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="visibility">Gemiddelde zichtbaarheid</label>
                    <input type="number" class="form-control" id="visibility" name="visibility"
                           value="<?php if (isset($visibility)) {
                               print $visibility;
                           } ?>"
                           required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="fish">Vissen</label>
                    <input type="text" class="form-control" id="fish" name="fish"
                           value="<?php if (isset($fish)) {
                               print $fish;
                           } ?>">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="danger">Gevaren</label>
                    <textarea class="form-control" id="danger" name="danger"
                              rows="3"><?php if (isset($danger)) {
                            print $danger;
                        } ?></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="info">Info</label>
                    <textarea class="form-control" id="info" name="info"
                              rows="3"><?php if (isset($info)) {
                            print $info;
                        } ?></textarea>
                </div>
            </div>
            <button class="btn btn-outline-warning" type="submit" name="submit">Duikplaats wijzigen</button>
        </form>
    </div>
<?php
include "../html/partials/includes.php";