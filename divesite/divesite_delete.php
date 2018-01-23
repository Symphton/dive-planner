<?php
include "../function.php";
$stmt = "DELETE FROM divesite WHERE id = ?";
$pdo->prepare($stmt)->execute([$_GET['id']]);
header("location: index.php");