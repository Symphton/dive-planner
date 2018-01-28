<?php
if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $_SESSION['error'] = "Email of wachtwoord is niet ingevuld";
    } else {
        $email = $_POST['email'];
        $password = $_POST['password'];
        $stmt = $pdo->prepare("SELECT user.id, password, firstname, admin, level FROM user LEFT OUTER JOIN certificate ON user.id_certificate = certificate.id WHERE email=?");
        $stmt->execute(array($email));
        $user = $stmt->fetch();
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $email;
            $_SESSION['firstname'] = $user['firstname'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['admin'] = $user['admin'];
            $_SESSION['level'] = $user['level'];
            header("location: event/event");
        } else {
            $_SESSION['error'] = "Email of wachtwoord is ongeldig";
        }
    }
}