<?php

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    echo("You are already logged in");
    exit;
}

?>