<?php
session_start();
include 'config/database.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];

            header("Location: index.php");
            exit;
        } else {
            $message = "Wrong credentials";
        }
    } else {
        $message = "User not found";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- 🔥 ΣΩΣΤΟ PATH -->
    <link rel="stylesheet" href="/dashboard/assets/css/main.css">
</head>
<body>

<div class="container">

    <h2>Login</h2>

    <?php if (!empty($message)): ?>
        <p class="message error"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" placeholder="Username" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password" required>

        <button class="btn" type="submit">Login</button>
    </form>

    <p style="margin-top:15px;">
        Δεν έχεις λογαριασμό? 
        <a href="register.php">Register εδώ</a>
    </p>

</div>

</body>
</html>