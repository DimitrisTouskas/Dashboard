<?php
session_start();
include "config/database.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM tasks WHERE user_id = $user_id ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

include "includes/header.php";
?>

<div class="container">
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
                    <td class="actions">
                    <a class="edit" href="tasks/edit.php?id=<?php echo $row['id']; ?>" title="Edit">
                    <i class="fa-solid fa-pen"></i>
                    </a>

    <a class="view" href="tasks/view.php?id=<?php echo $row['id']; ?>" title="View">
        <i class="fa-solid fa-eye"></i>
    </a>

    <a class="delete" href="tasks/delete.php?id=<?php echo $row['id']; ?>"
       onclick="return confirm('Delete this task?');" title="Delete">
        <i class="fa-solid fa-trash"></i>
    </a>
</td>
                </tr>
            <?php endwhile; ?>

        </table>
    <?php else: ?>
        <p>No tasks found.</p>
    <?php endif; ?>
</div>

<?php
include "includes/footer.php";
?>