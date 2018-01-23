<?php
include "../function.php";
include "../html/partials/head.php";
include "../html/partials/nav.php";
$users = $pdo->query("SELECT user.id, user.firstname, user.name, user.email, certificate.name AS certificate, diveclub.name AS diveclub FROM user LEFT JOIN diveclub_user ON user.id=diveclub_user.id_user INNER JOIN diveclub ON diveclub_user.id_diveclub = diveclub.id INNER JOIN certificate ON user.id_certificate = certificate.id GROUP BY user.email ORDER BY user.name ASC, user.firstname ASC")->fetchAll();
?>
    <div class="container">
        <h2>Gebruikers overzicht</h2> <a class="btn btn-outline-success" href="user_add.php" role="button">Gebruiker
            toevoegen</a><br/>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Naam</th>
                <th>Voornaam</th>
                <th>Email</th>
                <th>Certificaat</th>
                <th>Duikclub</th>
                <?php if (isAdminOrInstructor()) {
                    print "<th></th>";
                } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?php print $user['name']; ?></td>
                    <td><?php print $user['firstname']; ?></td>
                    <td><?php print $user['email']; ?></td>
                    <td><?php print $user['certificate']; ?></td>
                    <td><?php print $user['diveclub']; ?></td>
                    <?php if (isAdminOrInstructor()) { ?>
                    <td><a class="btn btn-outline-primary" href="user_diveclub.php?id=<?php print $user['id']; ?>"
                           role="button">Duikclub</a> <a class="btn btn-outline-warning"
                                                         href="user_edit.php?id=<?php print $user['id']; ?>"
                                                         role="button">Wijzig</a>
                        <?php }
                        if (isAdmin()) { ?> <a class="btn btn-outline-danger"
                                               href="user_delete.php?id=<?php print $user['id']; ?>"
                                               role="button">Delete</a></td>
                <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php
include "../html/partials/includes.php";