<?php
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error = "Email of wachtwoord is niet ingevuld";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stmt = $pdo->prepare("SELECT id, password,firstname,admin FROM user WHERE email=?");
        $stmt->execute(array($email));
        $user = $stmt->fetch();
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['admin'] = $user['admin'];
            header("location: event/event.php");
        } else {
            $error = "Email of wachtwoord is ongeldig";
        }
    }
}