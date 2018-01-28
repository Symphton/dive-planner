<?php
include "../function.php";
isAdminRedirect();
$stmt = $pdo->prepare("UPDATE event SET deleted = 1 WHERE id = ?");
$stmt->execute(array($_GET['id']));
$_SESSION['success'] = 'Het event werd met succes verwijderd.';
header("location: index");