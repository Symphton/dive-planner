<?php
include "../function.php";
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT firstname, email FROM user WHERE id = ?");
$stmt->execute(array($id));
$user = $stmt->fetch();
$email = $user['email'];
$firstname = $user['firstname'];

$password = str_shuffle(bin2hex(openssl_random_pseudo_bytes(4)));

$to = $email;
$subject = 'Diveplanner Password Reset';
include "../mail/reset_password.php";
$headers = 'From: noreply@hoylaerts.be' . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

if (mail($to, $subject, $message, $headers)) {
    $_SESSION['success'] = "Het nieuwe wachtwoord is succesvol verstuurd.";
    $stmt = $pdo->prepare("UPDATE user SET password = ? WHERE id = ?");
    $stmt->execute(array(password_hash($password, 1), $id));
} else {
    $_SESSION['error'] = "Het verzenden van het nieuwe wachtwoord was helaas niet mogelijk.";
}
header("Location:index");