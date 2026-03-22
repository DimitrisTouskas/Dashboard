<?php
session_start();
include 'config/database.php';

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $message = "Συμπλήρωσε όλα τα πεδία.";
        $message_type = "error";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            $message = "Επιτυχής εγγραφή! Μπορείς να κάνεις login.";
            $message_type = "success";
        } else {
            $message = "Σφάλμα: Username μπορεί να υπάρχει ήδη.";
            $message_type = "error";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="/dashboard/assets/css/main.css">
</head>
<body>

<div class="container">

    <h2>Register</h2>

    <?php if (!empty($message)): ?>
        <p class="message <?php echo $message_type; ?>">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" placeholder="Choose username" required>

        <label>Email:</label>
        <input type="email" name="email" placeholder="Insert email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Choose password" required>

        <button class="btn" type="submit">Register</button>
    </form>

    <p style="margin-top:15px;">
        Έχεις ήδη λογαριασμό? 
        <a href="login.php">Login εδώ</a>
    </p>

</div>

</body>
</html>