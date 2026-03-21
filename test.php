<?php

include 'config/database.php'; 

if (!$conn) {
    die("Η σύνδεση απέτυχε: " . mysqli_connect_error());
}


$sql = "SELECT * FROM users LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Σύνδεση επιτυχής! Βρέθηκε " . mysqli_num_rows($result) . " εγγραφή/ες στον πίνακα users.";
} else {
    echo "Σφάλμα στο query: " . mysqli_error($conn);
}
mysqli_close($conn);
?>