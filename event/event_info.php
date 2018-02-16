<?php
include "../function.php";
include "../html/partials/head.php";
include "../html/partials/nav.php";
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT event.*, divesite.name AS divesite, carpool.name AS carpool, concat(user.name, ' ', user.firstname) AS diveleader, user.telephone, diveclub.name AS diveclub FROM event INNER JOIN divesite ON event.id_divesite = divesite.id INNER JOIN carpool ON event.id_carpool = carpool.id INNER JOIN diveclub ON event.id_diveclub = diveclub.id INNER JOIN user ON event.id_user = user.id WHERE event.id = ?");
$stmt->execute(array($id));
$event = $stmt->fetch();
$stmt = $pdo->prepare("SELECT * FROM carpool WHERE id = ?");
$stmt->execute(array($event['id_carpool']));
$carpool = $stmt->fetch();
$stmt = $pdo->prepare("SELECT * FROM divesite WHERE id = ?");
$stmt->execute(array($event['id_divesite']));
$divesite = $stmt->fetch();
$stmt = $pdo->prepare("SELECT user_event.id, user.name, user.firstname, certificate.name AS certificate, certificate.level AS level, exercise, carpool FROM user INNER JOIN user_event ON user.id = user_event.id_user INNER JOIN certificate ON user.id_certificate = certificate.id WHERE user_event.id_event = ? ORDER BY certificate.level DESC, certificate.name DESC, user.name ASC, user.firstname ASC ");
$stmt->execute(array($id));
$users = $stmt->fetchAll();
?>
    <div class="container">
        <?php include "../html/partials/error_success.php"; ?>
        <h2>Duik info</h2>
        <br/>
        <h3>Algemene info</h3>
        <div class="row justify-content-md-center">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Naam</th>
                            <td><?php print $event['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Duikverantwoordelijke</th>
                            <td><?php print $event['diveleader']; ?></td>
                        </tr>
                        <tr>
                            <th>Telefoonnummer duikverantwoordelijke</th>
                            <td><?php print $event['telephone']; ?></td>
                        </tr>
                        <tr>
                            <th>Datum</th>
                            <td><?php print date("D j/n/Y", strtotime($event['date'])); ?></td>
                        </tr>
                        <tr>
                            <th>Tijd carpool</th>
                            <td><?php print date("G:i", strtotime($event['time_carpool'])); ?></td>
                        </tr>
                        <tr>
                            <th>Tijd ter plaatse</th>
                            <td><?php print date("G:i", strtotime($event['time_onsite'])); ?></td>
                        </tr>
                        <tr>
                            <th>Tijd te water</th>
                            <td><?php print date("G:i", strtotime($event['time_water'])); ?></td>
                        </tr>
                        <?php if (date("G:i", strtotime($event['time_tide'])) != '0:00') { ?>
                            <tr>
                                <th>Tijd getijde</th>
                                <td><?php print date("G:i", strtotime($event['time_tide'])); ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br/>
        <h3>Carpool info</h3>
        <div class="row justify-content-md-center">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Naam</th>
                            <td><?php print $carpool['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Straat</th>
                            <td><?php print $carpool['street'] . ' ' . $carpool['number']; ?></td>
                        </tr>
                        <tr>
                            <th>Stad</th>
                            <td><?php print $carpool['city']; ?></td>
                        </tr>
                        <tr>
                            <th>Land</th>
                            <td><?php print $carpool['country']; ?></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <br/>
        <h3>Duikplaats info</h3>
        <div class="row justify-content-md-center">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>Naam</th>
                            <td><?php print $divesite['name']; ?></td>
                        </tr>
                        <tr>
                            <th>Straat</th>
                            <td><?php print $divesite['street'] . ' ' . $divesite['number']; ?></td>
                        </tr>
                        <tr>
                            <th>Stad</th>
                            <td><?php print $divesite['city']; ?></td>
                        </tr>
                        <tr>
                            <th>Land</th>
                            <td><?php print $divesite['country']; ?></td>
                        </tr>
                        <tr>
                            <th>Maximale diepte</th>
                            <td><?php print $divesite['depth'] . 'm'; ?></td>
                        </tr>
                        <th>Gemiddelde zichtbaarheid</th>
                        <td><?php print $divesite['visibility'] . 'm'; ?></td>
                        </tr>
                        <tr>
                            <th>Inkom prijs</th>
                            <td><?php print $divesite['fee'] . '€'; ?></td>
                        </tr>
                        <tr>
                            <th>Parking</th>
                            <td><?php print yesNo($divesite['parking']); ?></td>
                        </tr>
                        <tr>
                            <th>Cafetaria</th>
                            <td><?php print yesNo($divesite['cafetaria']); ?></td>
                        </tr>
                        <tr>
                            <th>Kleedkamers</th>
                            <td><?php print yesNo($divesite['changingroom']); ?></td>
                        </tr>
                        <tr>
                            <th>Douches</th>
                            <td><?php print yesNo($divesite['shower']); ?></td>
                        </tr>
                        <tr>
                            <th>Compressor</th>
                            <td><?php print yesNo($divesite['compressor']); ?></td>
                        </tr>
                        <tr>
                            <th>Bodem</th>
                            <td><?php print $divesite['underground']; ?></td>
                        </tr>
                        <tr>
                            <th>Vissen</th>
                            <td><?php print $divesite['fish']; ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <?php if ($divesite['info'] != '') {
                        print "<b>Extra info:</b><br />" . $divesite['info'];

                    } ?>
                </div>
            </div>
        </div>
        <br/>
        <h3>Duikplaats veiligheid</h3>
        <div class="row justify-content-md-center">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>EHBO</th>
                            <td><?php print yesNo($divesite['ehbo']); ?></td>
                        </tr>
                        <tr>
                            <th>o2</th>
                            <td><?php print yesNo($divesite['o2']); ?></td>
                        </tr>
                        <tr>
                            <th>Telefoon</th>
                            <td><?php print yesNo($divesite['telephone']); ?></td>
                        </tr>
                        <tr>
                            <th>Veiligheidsteam</th>
                            <td><?php print yesNo($divesite['safety']); ?></td>
                        </tr>
                        <tr>
                            <th>Makkelijke instap</th>
                            <td><?php print yesNo($divesite['entrance']); ?></td>
                        </tr>
                        <tr>
                            <th>Duikvlag</th>
                            <td><?php print yesNo($divesite['flag']); ?></td>
                        </tr>
                        </tbody>
                    </table>
                    <?php if ($divesite['danger'] != '') {
                        print "<b>Extra gevaren:</b><br />" . $divesite['danger'];

                    } ?>
                </div>
            </div>
        </div>
        <br/>
        <h3>Inschrijvingen</h3>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Voornaam</th>
                <th>Naam</th>
                <th>Brevet</th>
                <th>Vordering</th>
                <th>Carpool</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php print $user['firstname']; ?></td>
                    <td><?php print $user['name']; ?></td>
                    <td><?php print $user['certificate']; ?></td>
                    <td><?php print $user['exercise']; ?></td>
                    <td><?php print yesNo($user['carpool']); ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php
include "../html/partials/includes.php";