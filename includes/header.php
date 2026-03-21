<?php
// header.php — ΜΟΝΟ HTML + navbar
// session_start() ΠΡΕΠΕΙ να γίνει στο main αρχείο πριν το include
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dashboard/assets/css/header.css">
    <link rel="stylesheet" href="/dashboard/assets/css/style.css">
    <title>Dashboard</title>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="nav-left"></div>

    <div class="nav-center">
        <a href="/dashboard/index.php">Dashboard</a>
        <a href="/dashboard/tasks/create.php">Add Task</a>
        <a href="/dashboard/tasks/view.php">Tasks</a>
        <a href="/dashboard/tasks/about.php">About</a>
        <a href="/dashboard/tasks/contact.php">Contact</a>
    </div>

    <div class="nav-right">
        <?php if (isset($_SESSION['username'])): ?>
            <span>Welcome, <?php echo $_SESSION['username']; ?></span>
            <a href="/dashboard/logout.php">Logout</a>
        <?php else: ?>
            <a href="/dashboard/login.php">Login</a>
        <?php endif; ?>
    </div>
</div>