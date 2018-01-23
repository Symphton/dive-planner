<?php
include "../function.php";
$stmt = "DELETE FROM diveclub WHERE id = ?";
$pdo->prepare($stmt)->execute([$_GET['id']]);
header("location: index.php");