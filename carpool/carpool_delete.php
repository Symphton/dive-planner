<?php
include "../function.php";
$stmt = "DELETE FROM carpool WHERE id = ?";
$pdo->prepare($stmt)->execute([$_GET['id']]);
header("location: index.php");