<?php
include "../function.php";
isAdminRedirect();
$stmt = $pdo->prepare("UPDATE certificate SET deleted = 1 WHERE id = ?");
$stmt->execute(array($_GET['id']));
$_SESSION['success'] = 'Het certificaat werd met succes verwijderd.';
header("location: index.php");