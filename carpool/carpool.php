<?php
include "../function.php";
include "../html/partials/head.php";
include "../html/partials/nav.php";
$carpools = $pdo->query("SELECT id, name, city, country FROM carpool ORDER BY name ASC")->fetchAll();
?>
    <div class="container">
        <h2>Carpool overzicht</h2> <a class="btn btn-outline-success" href="carpool_add.php" role="button">Carpool
            toevoegen</a><br/>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Naam</th>
                <th>Stad</th>
                <th>Land</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($carpools as $carpool) { ?>
                <tr>
                    <td><?php print $carpool['name']; ?></td>
                    <td><?php print $carpool['city']; ?></td>
                    <td><?php print $carpool['country']; ?></td>
                    <td><a class="btn btn-outline-warning"
                           href="carpool_edit.php?id=<?php print $carpool['id']; ?>"
                           role="button">Wijzig</a>
                        <?php if (isAdmin()) { ?>
                            <a class="btn btn-outline-danger"
                               href="carpool_delete.php?id=<?php print $carpool['id']; ?>"
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