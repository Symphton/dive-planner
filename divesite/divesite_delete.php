<?php
include "../function.php";
isAdminRedirect();
$stmt = $pdo->prepare("UPDATE divesite SET deleted = 1 WHERE id = ?");
$stmt->execute(array($_GET['id']));
$_SESSION['success'] = 'De duikplaats werd met succes verwijderd.';
header("location: index.php");