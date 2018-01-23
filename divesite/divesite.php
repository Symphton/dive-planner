<?php
include "../function.php";
include "../html/partials/head.php";
include "../html/partials/nav.php";
$diveclubs = $pdo->query("SELECT id, name, city, country FROM divesite ORDER BY name ASC")->fetchAll();
?>
    <div class="container">
        <h2>Duikplaatsen overzicht</h2> <a class="btn btn-outline-success" href="divesite_add.php" role="button">Duikplaats
            toevoegen</a><br/>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Naam</th>
                <th>Stad</th>
                <th>Land</th>
                <?php if (isAdminOrInstructor()) {
                    print "<th></th>";
                } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($diveclubs as $diveclub) { ?>
                <tr>
                    <td><?php print $diveclub['name']; ?></td>
                    <td><?php print $diveclub['city']; ?></td>
                    <td><?php print $diveclub['country']; ?></td>
                    <td><?php if (isAdminOrInstructor()) { ?>
                            <a class="btn btn-outline-warning"
                               href="divesite_edit.php?id=<?php print $diveclub['id']; ?>"
                               role="button">Wijzig</a>
                        <?php }
                        if (isAdmin()) { ?>
                            <a class="btn btn-outline-danger"
                               href="divesite_delete.php?id=<?php print $diveclub['id']; ?>"
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