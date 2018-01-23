<?php
include "html/partials/connect.php";
session_start();
isMember();
$error = '';

function isAdmin()
{
    if (isset($_SESSION['admin']) and $_SESSION['admin']) {
        return true;
    } else {
        return false;
    }
}

function isMember()
{
    if (!isset($_SESSION['email'])) {
        header("Location:../");
        $error = 'U moet eerst inloggen om deze pagina te bekijken.';
    }
}

function yesNo($number)
{
    if ($number == 1) {
        return 'Ja';
    } else {
        return 'Nee';
    }
}