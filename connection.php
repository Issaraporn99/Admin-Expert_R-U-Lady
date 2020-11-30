<?php 

    $conn = mysqli_connect("localhost", "root", "", "doctor");

    if (!$conn) {
        die("Failed to connec to databse " . mysqli_error($conn));
    }

?>