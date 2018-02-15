<?php
include "../function.php";
isAdminOrInstructorRedirect();
include "../html/partials/head.php";
include "../html/partials/nav.php";
$users = $pdo->query("SELECT user.id, user.firstname, user.name, user.email, certificate.name AS certificate, diveclub.name AS diveclub FROM user LEFT JOIN diveclub_user ON user.id=diveclub_user.id_user INNER JOIN diveclub ON diveclub_user.id_diveclub = diveclub.id INNER JOIN certificate ON user.id_certificate = certificate.id WHERE user.deleted = 0 GROUP BY user.email ORDER BY user.name ASC, user.firstname ASC")->fetchAll();
unset($_SESSION['userid']);
?>
    <div class="container">
        <?php include "../html/partials/error_success.php"; ?>
        <h2>Gebruikers overzicht</h2> <a class="btn btn-outline-success" href="user_add" role="button">Gebruiker
            toevoegen</a><br/>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Naam</th>
                <th>Voornaam</th>
                <th>Email</th>
                <th>Certificaat</th>
                <th>Duikclub</th>
                <th></th>
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
                    <td>
                        <div class="btn-group">
                            <form action="user_diveclub" method="post">
                                <input type="hidden" id="id" name="id" value="<?php print $user['id']; ?>">
                                <button class="btn btn-outline-primary" type="submit" name="redirect">Duikclub</button>
                            </form>
                            <form action="user_edit" method="post">
                                <input type="hidden" id="id" name="id" value="<?php print $user['id']; ?>">
                                <button class="btn btn-outline-warning" type="submit" name="redirect">Wijzig</button>
                            </form>
                            <form action="user_reset_password" method="post">
                                <input type="hidden" id="id" name="id" value="<?php print $user['id']; ?>">
                                <button class="btn btn-outline-warning" type="submit" name="redirect">Reset wachtwoord
                                </button>
                            </form>
                            <form action="user_delete" method="post">
                                <input type="hidden" id="id" name="id" value="<?php print $user['id']; ?>">
                                <button class="btn btn-outline-danger" type="submit" name="redirect">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php
include "../html/partials/includes.php";