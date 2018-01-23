<?php
include "../function.php";
$stmt = "DELETE FROM certificate WHERE id = ?";
$pdo->prepare($stmt)->execute([$_GET['id']]);
header("location: index.php");