<?php
include "../function.php";
isAdminRedirect();
$stmt = $pdo->prepare("UPDATE federation SET deleted = 1 WHERE id = ?");
$stmt->execute(array($_GET['id']));
$_SESSION['success'] = 'De federatie werd met succes verwijderd.';
header("location: index.php");