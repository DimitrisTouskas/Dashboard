<?php
include "../includes/header.php";
include "../config/database.php";
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM tasks WHERE id = $id AND user_id = $user_id";
$result = mysqli_query($conn, $sql);

$task = mysqli_fetch_assoc($result);

if (!$task) {
    echo "Task not found";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $status = $_POST['status'];

    $sql = "UPDATE tasks SET status = $status WHERE id = $id AND user_id = $user_id";

    mysqli_query($conn, $sql);

    header("Location: /dashboard/index.php?id=$id");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<div class="container">

    <h2><?php echo $task['title']; ?></h2>

    <p><?php echo $task['description']; ?></p>

    <p>
        Status: 
        <?php echo $task['status'] ? 'Completed' : 'Pending'; ?>
    </p>

    <form method="POST">
        <label>Change Status:</label>
        <select name="status">
            <option value="0" <?php if ($task['status'] == 0) echo 'selected'; ?>>Pending</option>
            <option value="1" <?php if ($task['status'] == 1) echo 'selected'; ?>>Completed</option>
        </select>

        <button type="submit">Update</button>
    </form>

</div>