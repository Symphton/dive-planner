<?php
include "../function.php";
isAdminOrInstructorRedirect();
$stmt = $pdo->prepare("UPDATE user SET deleted = 1 WHERE id = ?");
$stmt->execute(array($_GET['id']));
$_SESSION['success'] = 'De user werd met succes verwijderd.';
header("location: index");