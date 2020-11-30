<?php 
session_start();

    if (isset($_POST['username'])) {

        include('connection.php');

        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordenc = md5($password);

        $query = "SELECT * FROM user WHERE username = '$username' AND password = '$passwordenc'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_array($result);

            $_SESSION['userid'] = $row['id'];
            $_SESSION['user'] = $row['doctorname'];
            $_SESSION['userlevel'] = $row['userlevel'];
           

            if ($_SESSION['userlevel'] == 'a') {
                header("Location: index1.php");
            }

            if ($_SESSION['userlevel'] == 'm') {
                header("Location: user_page.php");
            }
            } else {
                echo "<script>";
                echo "alert(\"User หรือ Password ไม่ถูกต้อง\");";
                echo "window.history.back()";
                echo "</script>";
                
            }

    } else {
        header("Location: index.php");
    } 
?>