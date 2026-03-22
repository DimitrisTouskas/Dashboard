<?php
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/dashboard/assets/css/header.css">
    <link rel="stylesheet" href="/dashboard/assets/css/style.css">
    <link rel="stylesheet" href="/dashboard/assets/css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Dashboard</title>
</head>
<body>

<div class="navbar">

    <div class="nav-left">
        <span class="nav-logo">TaskApp</span>
    </div>

    <div class="nav-center">
        <a href="/dashboard/index.php">Dashboard</a>
        <a href="/dashboard/tasks/create.php">Add Task</a>
        <a href="/dashboard/index.php">Tasks</a>
        <a href="/dashboard/tasks/about.php">About</a>
        <a href="/dashboard/tasks/contact.php">Contact</a>
    </div>

    <div class="nav-right">
        <span> <?php echo $_SESSION['username']; ?></span>
        <a href="/dashboard/logout.php">Logout</a>
    </div>

</div>
