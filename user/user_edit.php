<?php
include "../function.php";
include "../html/partials/head.php";
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM user WHERE id = ?");
$stmt->execute(array($id));
$user = $stmt->fetch();

$firstname = $user['firstname'];
$name = $user['name'];
$birthday = $user['birthday'];
$street = $user['street'];
$number = $user['number'];
$zip = $user['zip'];
$city = $user['city'];
$country = $user['country'];
$dives = $user['dives'];
$email = $user['email'];
$telephone = $user['telephone'];
$date_medical = $user['date_medical'];
$medical_issue = $user['medical_issue'];
$cert = $user['id_certificate'];

if (isset($_POST['submit'])) {
    $firstname = $_POST['firstname'];
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $street = $_POST['street'];
    $number = $_POST['number'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $country = $_POST['country'];
    $dives = $_POST['dives'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $date_medical = $_POST['date_medical'];
    $medical_issue = $_POST['medical_issue'];
    $cert = $_POST['certificate'];

    $stmt = $pdo->prepare("SELECT firstname, name FROM user WHERE email = ?");
    $stmt->execute(array($email));
    $user = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT email FROM user WHERE id = ?");
    $stmt->execute(array($id));
    $myMail = $stmt->fetchColumn();

    if ($user['firstname'] != '' and $user['name'] != '' and $myMail != $email) {
        $_SESSION['error'] = 'Het gekozen emailadres word reeds gebruikt door ' . $user['firstname'] . ' ' . $user['name'] . '.';
    } else {
        $stmt = $pdo->prepare("UPDATE user SET name = ?, firstname = ?, birthday = ?, street = ?, number = ?, zip = ?, city = ?, country = ?, dives = ?, email = ?, telephone = ?, date_medical = ?, medical_issue = ?, id_certificate = ? WHERE id = ?");
        $stmt->execute(array($name, $firstname, $birthday, $street, $number, $zip, $city, $country, $dives, $email, $telephone, $date_medical, $medical_issue, $cert, $id));
        $_SESSION['success'] = "De gebruiker " . $firstname . " " . $name . " werd succesvol gewijzigd.";
        header("Location:index");
    }
}
include "../html/partials/nav.php";
$certificates = $pdo->query("SELECT certificate.id, concat(certificate.name, \" - \", federation.name) AS name FROM certificate INNER JOIN federation ON certificate.id_federation = federation.id ORDER BY certificate.id ASC;")->fetchAll();
$diveclubs = $pdo->query("SELECT diveclub.id, diveclub.name FROM diveclub ORDER BY diveclub.name ASC;")->fetchAll();
?>
    <div class="container">
        <?php include "../html/partials/error_success.php"; ?>
        <h2>Gebruiker wijzigen</h2>
        <form action="" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstname">Voornaam</label>
                    <input type="text" class="form-control" id="firstname" name="firstname"
                           value="<?php if (isset($firstname)) {
                               print $firstname;
                           } ?>"
                           required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="name">Naam</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="<?php if (isset($name)) {
                               print $name;
                           } ?>" required>
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
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="<?php if (isset($email)) {
                               print $email;
                           } ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="telephone">Telefoon nummer</label>
                    <input type="text" class="form-control" id="telephone" name="telephone"
                           value="<?php if (isset($telephone)) {
                               print $telephone;
                           } ?>" required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="birthday">Geboortedatum (YYYY-MM-DD)</label>
                    <input type="date" class="form-control" id="birthday" name="birthday"
                           value="<?php if (isset($birthday)) {
                               print $birthday;
                           } ?>"
                           required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="certificate">Brevet</label>
                    <select class="form-control" id="certificate" name="certificate">
                        <?php foreach ($certificates as $certificate) { ?>
                            <option <?php if (isset($cert) and $cert == $certificate['id']) {
                                print 'selected="selected"';
                            } ?> value="<?php print $certificate['id']; ?>"><?php print $certificate['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="dives">Aantal duiken</label>
                    <input type="text" class="form-control" id="dives" name="dives"
                           value="<?php if (isset($dives)) {
                               print $dives;
                           } ?>"
                           required>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="date_medical">Medischekeuring (YYYY-MM-DD)</label>
                    <input type="date" class="form-control" id="date_medical" name="date_medical"
                           value="<?php if (isset($date_medical)) {
                               print $date_medical;
                           } ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="medical_issue">Medische problemen</label>
                    <textarea class="form-control" id="medical_issue" name="medical_issue"
                              rows="3"><?php if (isset($medical_issue)) {
                            print $medical_issue;
                        } ?></textarea>
                </div>
            </div>
            <button class="btn btn-outline-warning" type="submit" name="submit">Gegevens wijzigen</button>
        </form>
    </div>
<?php
include "../html/partials/includes.php";