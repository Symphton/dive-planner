<?php
include "../function.php";
$stmt = "DELETE FROM diveclub_user WHERE id_user = ?";
$pdo->prepare($stmt)->execute([$_GET['id']]);
$stmt = "DELETE FROM user WHERE id = ?";
$pdo->prepare($stmt)->execute([$_GET['id']]);
header("location: index");