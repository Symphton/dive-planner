<?php
include "../function.php";
$stmt = "DELETE FROM user_event WHERE id_event = ? AND id_user = ?";
$pdo->prepare($stmt)->execute([$_GET['id'], $_SESSION['id']]);
header("location: index");