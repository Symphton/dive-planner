<?php
include "../function.php";
include "../html/partials/head.php";
include "../html/partials/nav.php";
if (isAdmin()) {
    $events = $pdo->query("SELECT event.id, event.name, event.date, event.time_onsite, divesite.name AS divesite, concat(user.firstname, ' ', user.name) AS diveleader, diveclub.name AS diveclub FROM event INNER JOIN divesite ON event.id_divesite = divesite.id INNER JOIN user ON event.id_user = user.id INNER JOIN diveclub ON event.id_diveclub = diveclub.id WHERE event.date >= curdate() AND  event.deleted = 0 ORDER BY event.date ASC")->fetchAll();
} else {
    $stmt = $pdo->prepare("SELECT event.id, event.name, event.date, event.time_onsite, divesite.name AS divesite, concat(user.firstname, ' ', user.name) AS diveleader, diveclub.name AS diveclub FROM event INNER JOIN divesite ON event.id_divesite = divesite.id INNER JOIN user ON event.id_user = user.id INNER JOIN diveclub ON event.id_diveclub = diveclub.id INNER JOIN diveclub_user ON event.id_diveclub = diveclub_user.id_diveclub WHERE diveclub_user.id_user = ? AND event.date >= curdate() AND event.deleted = 0 ORDER BY event.date ASC");
    $stmt->execute(array($_SESSION['id']));
    $events = $stmt->fetchAll();
}
$stmt = $pdo->prepare("SELECT user_event.id_event AS id FROM user_event WHERE id_user = ?");
$stmt->execute(array($_SESSION['id']));
$registrations = $stmt->fetchAll();
$registrations = array_reduce($registrations, 'array_merge', array());
?>
    <div class="container">
        <?php include "../html/partials/error_success.php"; ?>
        <h2>Duik overzicht</h2> <?php if (isAdminOrDiveleader()) { ?><a class="btn btn-outline-success"
                                                                        href="event_add.php" role="button">Duik
            toevoegen</a><br/> <?php } ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Naam</th>
                <th>Datum</th>
                <th>Vertrek uur</th>
                <th>Duikplaats</th>
                <th>Duikverantwoordelijke</th>
                <th>Duikclub</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($events as $event) { ?>
                <tr>
                    <td><?php print $event['name']; ?></td>
                    <td><?php print date("D j/n/Y", strtotime($event['date'])); ?></td>
                    <td><?php print date("G:i", strtotime($event['time_onsite'])); ?></td>
                    <td><?php print $event['divesite']; ?></td>
                    <td><?php print $event['diveleader']; ?></td>
                    <td><?php print $event['diveclub']; ?></td>
                    <td><a class="btn btn-outline-primary"
                           href="event_info?id=<?php print $event['id']; ?>"
                           role="button">Info</a>
                        <?php if (!in_array($event['id'], $registrations)) { ?>
                            <a class="btn btn-outline-success"
                               href="event_register?id=<?php print $event['id']; ?>"
                               role="button">Inschijven</a>
                        <?php } else { ?>
                            <a class="btn btn-outline-danger"
                               href="event_unregister?id=<?php print $event['id']; ?>"
                               role="button">Uitschijven</a>
                        <?php }
                        if (isAdminOrDiveleader()) { ?>
                            <a class="btn btn-outline-warning"
                               href="event_edit?id=<?php print $event['id']; ?>"
                               role="button">Wijzig</a>
                        <?php }
                        if (isAdmin()) { ?> <a class="btn btn-outline-danger"
                                               href="event_delete?id=<?php print $event['id']; ?>"
                                               role="button">Delete</a>
                        <?php } ?>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php
include "../html/partials/includes.php";