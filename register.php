<?php

session_start();
include 'config/database.php';
include './includes/auth.php';

$message = ""; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($email) || empty($password)) {
        $message = "Παρακαλώ συμπλήρωσε όλα τα πεδία.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password, created_at) 
                VALUES ('$username', '$email', '$hashedPassword', NOW())";

        if (mysqli_query($conn, $sql)) {
            $message = "Επιτυχής εγγραφή! Τώρα μπορείς να κάνεις login.";
        } else {
            $message = "Σφάλμα: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
<h2>Register</h2>

<?php if (!empty($message)) { echo "<p>$message</p>"; } ?>

<form action="register.php" method="POST">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>
</form>

<p>Έχεις ήδη λογαριασμό; <a href="login.php">Κάνε login εδώ</a></p>
</body>
</html>