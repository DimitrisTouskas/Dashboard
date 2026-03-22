<?php
session_start();
include "../includes/header.php";

// Έλεγχος login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="../assets/css/main.css">
</head>
<body>

<div class="container">
    <h2>About This Dashboard</h2>
    <p>
        Αυτό το dashboard είναι ένα προσωπικό project για διαχείριση tasks. 
        Μπορείς να προσθέτεις, να ενημερώνεις, να διαγράφεις και να βλέπεις τα tasks σου εύκολα.
    </p>
    <p>
        Δημιουργήθηκε για εκπαίδευση και βελτίωση των δεξιοτήτων σε PHP, MySQL και Frontend.
    </p>
</div>

</body>
</html>