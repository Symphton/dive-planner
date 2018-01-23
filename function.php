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

function isAdminOrInstructor()
{
    if ((isset($_SESSION['admin']) and $_SESSION['admin']) or (isset($_SESSION['instructor']) and $_SESSION['instructor'])) {
        return true;
    } else {
        return false;
    }
}

function isInstructor()
{
    if (isset($_SESSION['instructor']) and $_SESSION['instructor']) {
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