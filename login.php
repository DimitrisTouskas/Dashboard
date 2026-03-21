<?php
session_start();

include 'config/database.php';
include './includes/auth.php';


$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);


    $sql = "SELECT * FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/login.css">
    <title>Login</title>
</head>
<body>
    
    <form action="login.php" method="POST">

        <label>Username</label>
        <input type="text" name= "username" placeholder="Username" required  >

        <label>Password</label>
        <input type="password" name= "password" placeholder="Password" required>

        <button type="submit" > Login</button>
        <p>Δεν έχεις λογαριασμό? <a href="register.php"> Κάνε click εδώ</a></p>
    </form>
    <?php if (!empty($message)): ?>
    <p class="message <?php echo $message_type; ?>">
        <?php echo $message; ?>
    </p>
<?php endif; ?>
    
</body>
</html>