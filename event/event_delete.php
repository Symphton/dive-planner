<?php
include "../function.php";
$stmt = "DELETE FROM event WHERE id = ?";
$pdo->prepare($stmt)->execute([$_GET['id']]);
$_SESSION['success'] = 'Het event werd met succes verwijderd.';
header("location: index");