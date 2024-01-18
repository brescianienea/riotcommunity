<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['logged'])) {
    $_SESSION['logged'] = 'false';
}
if ($_SESSION['logged'] === 'true') {
    header("Location: /home.php?section=friends");
}

if ($_SESSION['logged'] === 'false') {
    header("Location: /home.php?section=discover");
}
die(); ?>
