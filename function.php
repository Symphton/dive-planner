<?php
include "html/partials/connect.php";
session_start();
isMember();

function isMember()
{
    if (!isset($_SESSION['email'])) {
        header("Location:../");
        $_SESSION['error'] = 'U moet eerst inloggen om deze pagina te bekijken.';
    }
}

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
    if ((isset($_SESSION['admin']) and $_SESSION['admin']) or (isset($_SESSION['level']) and $_SESSION['level'] >= 4)) {
        return true;
    } else {
        return false;
    }
}

function isAdminOrDiveleader()
{
    if ((isset($_SESSION['admin']) and $_SESSION['admin']) or (isset($_SESSION['level']) and $_SESSION['level'] > 2)) {
        return true;
    } else {
        return false;
    }
}

function isAdminRedirect()
{
    if (!$_SESSION['admin']) {
        header("Location:../");
        $_SESSION['error'] = 'U moet admin zijn om deze functie te kunnen gebruiken.';
    }
}

function isAdminOrInstructorRedirect()
{
    if ((!$_SESSION['admin']) and ($_SESSION['level'] < 4)) {
        header("Location:../");
        $_SESSION['error'] = 'U moet admin of instructeur zijn om deze functie te kunnen gebruiken.';
    }
}

function isAdminOrDiveleaderRedirect()
{
    if (!isset($_SESSION['admin']) and (!isset($_SESSION['level']) or $_SESSION['level'] <= 2)) {
        header("Location:../");
        $_SESSION['error'] = 'Uw moet admin zijn of een hoger brevet hebben om de gevraagde pagina te gebruiken.';
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