<?php
session_start();

include "../config/database.php";
include "../includes/header.php";
//include "../includes/auth.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: /dashboard/index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$id = (int) $_GET['id'];

$message = "";

$stmt = $conn->prepare("SELECT * FROM tasks WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$task = $result->fetch_assoc();
$stmt->close();

if (!$task) {
    echo "Task not found";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE tasks SET status = ? WHERE id = ? AND user_id = ?");
    $stmt->bind_param("iii", $status, $id, $user_id);

    if ($stmt->execute()) {
        header("Location: /dashboard/tasks/view.php?id=$id&updated=1");
        exit;
    } else {
        $message = "Error updating task";
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

    <h2><?php echo htmlspecialchars($task['title']); ?></h2>

    <p><?php echo htmlspecialchars($task['description']); ?></p>

    <p>
        Status: 
        <?php echo $task['status'] ? 'Completed' : 'Pending'; ?>
    </p>

    <?php if (isset($_GET['updated'])): ?>
        <p class="message success">Task updated successfully!</p>
    <?php endif; ?>

    <?php if (!empty($message)): ?>
        <p class="message error"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Change Status:</label>
        <select name="status">
            <option value="0" <?php if ($task['status'] == 0) echo 'selected'; ?>>Pending</option>
            <option value="1" <?php if ($task['status'] == 1) echo 'selected'; ?>>Completed</option>
        </select>

        <button type="submit">Update</button>
    </form>

</div>

</body>
</html>