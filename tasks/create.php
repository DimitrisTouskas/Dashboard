<?php
 session_start();
include "../config/database.php";
//include "../includes/auth.php";
include "../includes/header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $status = isset($_POST['status']) ? 1 : 0;
    $user_id = $_SESSION['user_id'];

    if (empty($title) || empty($description)) {
        $message = "Παρακαλώ συμπλήρωσε όλα τα πεδία.";
    } else {
        // SQL insert
        $sql = "INSERT INTO tasks (title, description, status, user_id) 
                VALUES ('$title', '$description', '$status', '$user_id')";

        if (mysqli_query($conn, $sql)) {
            $message = "Επιτυχής εγγραφή!";
        } else {
            $message = "Σφάλμα: " . mysqli_error($conn);
        }
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/create.css">
    <title>Add a new task</title>
</head>
<body>
    <form action="create.php" method="POST">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">

        <label for="description">Description</label>
        <input type="text" name="description" id="description">

        <label for="status">Status</label>
        <select name="status">
            <option value="0">Pending</option>
            <option value="1">Completed</option>
        </select>

        <button type="submit">Add</button>

    </form>
    
</body>
</html>