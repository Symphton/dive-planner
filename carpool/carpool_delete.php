<?php
include "../function.php";
isAdminRedirect();
$stmt = $pdo->prepare("UPDATE carpool SET deleted = 1 WHERE id = ?");
$stmt->execute(array($_GET['id']));
$_SESSION['success'] = 'De carpool locatie werd met succes verwijderd.';
header("location: index.php");