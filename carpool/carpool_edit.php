<?php
include "../function.php";
isAdminOrDiveleaderRedirect();
include "../html/partials/head.php";
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM carpool WHERE id = ?");
$stmt->execute(array($id));
$carpool = $stmt->fetch();

$name = $carpool['name'];
$street = $carpool['street'];
$number = $carpool['number'];
$zip = $carpool['zip'];
$city = $carpool['city'];
$country = $carpool['country'];

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $street = $_POST['street'];
    $number = $_POST['number'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $stmt = $pdo->prepare("UPDATE carpool SET name = ?, street = ?, number = ?, zip = ?, city = ?, country = ? WHERE id = ?");
    $stmt->execute(array($name, $street, $number, $zip, $city, $country, $id));
    header("Location:index");
}
include "../html/partials/nav.php";
?>
    <div class="container">
        <h2>Carpool wijzigen</h2>
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
                           } ?>"
                           required>
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
                        <option <?php if (isset($country) and $country == "Nederland") {
                            print 'selected="selected"';
                        } ?>>Nederland
                        </option>
                    </select>
                </div>
            </div>
            <button class="btn btn-outline-warning" type="submit" name="submit">Carpool wijzigen</button>
        </form>
    </div>
<?php
include "../html/partials/includes.php";