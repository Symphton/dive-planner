<?php
include "../function.php";
isAdminOrInstructorRedirect();
$stmt = $pdo->prepare("SELECT count(*) FROM diveclub_user WHERE id_user = ?");
$stmt->execute(array($_GET['id']));
$currentClubs = $stmt->fetchColumn();

if ($currentClubs == 1) {
    $_SESSION['error'] = "Duikclub verwijderen is mislukt, je moet minimaal 1 duikclub overhouden.";
} else {
    $stmt = "DELETE FROM diveclub_user WHERE id_user = ? AND id_diveclub = ?";
    $pdo->prepare($stmt)->execute([$_GET['id'], $_GET['diveclub']]);
    $_SESSION['success'] = "De duikclub werd succesvol verwijderd.";
}

header("location: user_diveclub.php?id=" . $_GET['id']);