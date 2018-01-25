<?php
include "../function.php";
$stmt = "DELETE FROM diveclub_user WHERE id_user = ? AND id_diveclub = ?";
$pdo->prepare($stmt)->execute([$_GET['id'], $_GET['diveclub']]);
$_SESSION['success'] = "Duikclub " . $_GET['diveclub'] . " werd succesvol verwijderd.";
header("location: user_diveclub.php?id=" . $_GET['id']);