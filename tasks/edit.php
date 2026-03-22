<?php
session_start();
include "../config/database.php";
include "../includes/header.php";

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
$message_type = "";

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
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $status = $_POST['status'];

    if (empty($title) || empty($description)) {
        $message = "Συμπλήρωσε όλα τα πεδία.";
        $message_type = "error";
    } else {
        $stmt = $conn->prepare("UPDATE tasks SET title = ?, description = ?, status = ? WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ssiii", $title, $description, $status, $id, $user_id);

        if ($stmt->execute()) {
            $message = "Το task ενημερώθηκε!";
            $message_type = "success";

            $task['title'] = $title;
            $task['description'] = $description;
            $task['status'] = $status;

        } else {
            $message = "Σφάλμα: " . $stmt->error;
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
    <title>Edit Task</title>

    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/create.css">
</head>
<body>

<div class="container">
    <h2>Edit Task</h2>

    <?php if (!empty($message)): ?>
        <p class="message <?php echo $message_type; ?>">
            <?php echo $message; ?>
        </p>
    <?php endif; ?>

    <form method="POST">
        <label>Title</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($task['title']); ?>">

        <label>Description</label>
        <input type="text" name="description" value="<?php echo htmlspecialchars($task['description']); ?>">

        <label>Status</label>
        <select name="status">
            <option value="0" <?php if ($task['status'] == 0) echo 'selected'; ?>>Pending</option>
            <option value="1" <?php if ($task['status'] == 1) echo 'selected'; ?>>Completed</option>
        </select>

        <button type="submit">Update Task</button>
    </form>
</div>

</body>
</html>