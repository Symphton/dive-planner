<?php
include "../function.php";
include "../html/partials/head.php";
include "../html/partials/nav.php";
$stmt = $pdo->prepare("SELECT user.name, firstname, birthday, street, number, zip, city, country, dives, email, telephone, date_medical, medical_issue, certificate.name AS certificate FROM user LEFT OUTER JOIN certificate ON user.id_certificate = certificate.id WHERE user.id = ?");
$stmt->execute(array($_SESSION['id']));
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
$cert = $user['certificate'];
?>
    <div class="container">
        <?php include "../html/partials/error_success.php"; ?>
        <h2>Profiel</h2>
        <br/>
        <div class="row justify-content-md-center">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Naam</th>
                            <td><?php print $firstname . ' ' . $name; ?></td>
                        </tr>
                        <tr>
                            <th>Geboortedatum</th>
                            <td><?php print $birthday; ?></td>
                        </tr>
                        <tr>
                            <th>Adres</th>
                            <td><?php print $street . ' ' . $number; ?></td>
                        </tr>
                        <tr>
                            <th>Postcode</th>
                            <td><?php print $zip; ?></td>
                        </tr>
                        <tr>
                            <th>Gemeente</th>
                            <td><?php print $city; ?></td>
                        </tr>
                        <tr>
                            <th>Land</th>
                            <td><?php print $country; ?></td>
                        </tr>
                        <tr>
                            <th>Aantal duiken</th>
                            <td><?php print $dives; ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php print $email; ?></td>
                        </tr>
                        <tr>
                            <th>Telefoonnummer</th>
                            <td><?php print $telephone; ?></td>
                        </tr>
                        <tr>
                            <th>Datum medische keuring</th>
                            <td><?php print $date_medical; ?></td>
                        </tr>
                        <tr>
                            <th>Medische problemen</th>
                            <td><?php print $medical_issue; ?></td>
                        </tr>
                        <tr>
                            <th>Certificaat</th>
                            <td><?php print $cert; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
include "../html/partials/includes.php";