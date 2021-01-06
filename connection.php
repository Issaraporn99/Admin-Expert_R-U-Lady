<?php 

    $conn = mysqli_connect('student.crru.ac.th','601463046','issaraporn@5075','601463046');
    //$conn = mysqli_connect('localhost','root','','doctor');
    if (!$conn) {
        die("Failed to connec to databse " . mysqli_error($conn));
    }

?>