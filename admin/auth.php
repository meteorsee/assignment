<?php
$timeout_duration = 30;

if (!isset($_SESSION["user"]) || (time() - $_SESSION['last_timestamp']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
} else {
    session_regenerate_id(true);
    $_SESSION['last_timestamp'] = time();
}
?>