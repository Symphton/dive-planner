<?php
include "../function.php";
include "../html/partials/head.php";
include "../html/partials/nav.php";
$federations = $pdo->query("SELECT * FROM federation ORDER BY name ASC")->fetchAll();
?>
    <div class="container">
        <h2>Federatie overzicht</h2> <a class="btn btn-outline-success" href="federation_add.php" role="button">Federatie
            toevoegen</a><br/>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Naam</th>
                <?php if (isAdmin()) {
                    print "<th></th>";
                } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($federations as $federation) { ?>
                <tr>
                    <td><?php print $federation['name']; ?></td>
                    <?php if (isAdmin()) { ?>
                        <td><a class="btn btn-outline-warning"
                               href="federation_edit.php?id=<?php print $federation['id']; ?>"
                               role="button">Wijzig</a> <a class="btn btn-outline-danger"
                                                           href="federation_delete.php?id=<?php print $federation['id']; ?>"
                                                           role="button">Delete</a></td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php
include "../html/partials/includes.php";