<?php
include "../function.php";
isAdminRedirect();
$stmt = $pdo->prepare("UPDATE diveclub SET deleted = 1 WHERE id = ?");
$stmt->execute(array($_GET['id']));
$_SESSION['success'] = 'De duikclub werd met succes verwijderd.';
header("location: index.php");