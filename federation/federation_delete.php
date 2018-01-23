<?php
include "../function.php";
$stmt = "DELETE FROM federation WHERE id = ?";
$pdo->prepare($stmt)->execute([$_GET['id']]);
header("location: index.php");