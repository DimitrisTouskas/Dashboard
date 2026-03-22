<?php
 session_start();
include "../config/database.php";
include "../includes/header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $status = isset($_POST['status']) ? 1 : 0;
    $user_id = $_SESSION['user_id'];

    if (empty($title) || empty($description)) {
        $message = "Παρακαλώ συμπλήρωσε όλα τα πεδία.";
    } else {
        $sql = $conn->prepare("INSERT INTO tasks (title, description, status, user_id) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssii", $title, $description, $status, $user_id);

        if ($sql->execute()) {
            $message = "Επιτυχής εγγραφή!";
            $message_type = "success";
        } else {
            $message = "Σφάλμα: " . $sql->error;
            $message_type = "error";
        }

        $sql->close();
        }
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a New Task</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/create.css">
</head>
<body>

<div class="container">
    <h2>Add a New Task</h2>

    <?php if (!empty($message)): ?>
        <p class="message <?php echo $message_type; ?>"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="create.php" method="POST">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Enter task title">

        <label for="description">Description</label>
        <input type="text" name="description" id="description" placeholder="Enter task description">

        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="0">Pending</option>
            <option value="1">Completed</option>
        </select>

        <button type="submit">Add Task</button>
    </form>
</div>
</body>
<?php include "../includes/footer.php"; ?>