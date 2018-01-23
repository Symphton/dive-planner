<?php
include "../function.php";
include "../html/partials/head.php";
include "../html/partials/nav.php";
$certificates = $pdo->query("SELECT certificate.id, certificate.name, federation.name AS federation FROM certificate INNER JOIN federation ON certificate.id_federation = federation.id ORDER BY federation ASC, certificate.level ASC, certificate.name ASC")->fetchAll();
?>
    <div class="container">
        <h2>Certificaten overzicht</h2> <a class="btn btn-outline-success" href="certificate_add.php" role="button">Certificaat
            toevoegen</a><br/>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Naam</th>
                <th>Federatie</th>
                <?php if (isAdmin()) {
                    print "<th></th>";
                } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($certificates as $certificate) { ?>
                <tr>
                    <td><?php print $certificate['name']; ?></td>
                    <td><?php print $certificate['federation']; ?></td>
                    <?php if (isAdmin()) { ?>
                        <td><a class="btn btn-outline-warning"
                               href="certificate_edit.php?id=<?php print $certificate['id']; ?>"
                               role="button">Wijzig</a> <a class="btn btn-outline-danger"
                                                           href="certificate_delete.php?id=<?php print $certificate['id']; ?>"
                                                           role="button">Delete</a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php
include "../html/partials/includes.php";