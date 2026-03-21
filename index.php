<?php
session_start();
include "config/database.php";

// Redirect αν δεν είναι logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Παίρνουμε tasks
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tasks WHERE user_id = $user_id ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

// Include header (navbar + CSS)
include "includes/header.php";
?>

<!-- Main Content -->
<div class="container">
    <h2>Dashboard</h2>
    <p>Welcome, <?php echo $_SESSION['username']; ?></p>

    <a href="tasks/create.php" class="btn-add">+ Add New Task</a>
    <br><br>

    <?php if (mysqli_num_rows($result) > 0): ?>
        <table border="1" cellpadding="10">
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['description']); ?></td>
                    <td><?php echo $row['status'] ? 'Completed' : 'Pending'; ?></td>
                    <td>
                        <a href="tasks/edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                        <a href="tasks/view.php?id=<?php echo $row['id']; ?>">View</a>
                        <a href="tasks/delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>

        </table>
    <?php else: ?>
        <p>No tasks found.</p>
    <?php endif; ?>
</div>

<?php
// Include footer (κλείσιμο body + html)
include "includes/footer.php";
?>