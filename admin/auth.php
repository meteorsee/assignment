<?php
$timeout_duration = 1800;

if (!isset($_SESSION["admin"]) || (time() - $_SESSION['last_timestamp']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: login.php?session_expired=1");
    exit();
} else {
    session_regenerate_id(true);
    $_SESSION['last_timestamp'] = time();
}
?>