<?php 
session_start();
include '../config/database.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}


$user_id = $_SESSION['user_id'];
$id = (int) $_GET['id'];

$stmt = $conn->prepare('DELETE FROM tasks WHERE id = ? and user_id = ?');
$stmt -> bind_param ('ii' , $id , $user_id);

if ($stmt->execute() && $stmt->affected_rows > 0){
    header("Location: /dashboard/index.php");
    exit;
}else{
    echo "Προβλημα με την διαγραφη του task";
}
$stmt -> close();
?>