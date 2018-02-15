<?php
include "../function.php";
isAdminOrInstructorRedirect();
$id = $_POST['id'];
$stmt = $pdo->prepare("SELECT count(*) FROM diveclub_user WHERE id_user = ?");
$stmt->execute(array($id));
$currentClubs = $stmt->fetchColumn();
$_SESSION['userid'] = $id;

if ($currentClubs == 1) {
    $_SESSION['error'] = "Duikclub verwijderen is mislukt, je moet minimaal 1 duikclub overhouden.";
} else {
    $stmt = "DELETE FROM diveclub_user WHERE id_user = ? AND id_diveclub = ?";
    $pdo->prepare($stmt)->execute([$id, $_POST['diveclub']]);
    $_SESSION['success'] = "De duikclub werd succesvol verwijderd.";
}

header("location: user_diveclub");