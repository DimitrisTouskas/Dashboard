<?php
session_start();
include "../includes/header.php";

// Έλεγχος login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/forms.css">
</head>
<body>

<div class="container">
    <h2>Contact</h2>
    <p>Για οποιαδήποτε απορία ή feedback μπορείς να επικοινωνήσεις μαζί μας:</p>

    <form action="contact.php" method="POST">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Your Name" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Your Email" required>

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5" placeholder="Type your message..." required></textarea>

        <button type="submit" class="btn-add">Send Message</button>
    </form>
</div>

</body>
</html>