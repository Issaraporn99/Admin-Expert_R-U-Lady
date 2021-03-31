<html>

<head>
    <meta charset="UTF-8" />
    <script src="css_js/sweetalert.min.js"></script>
    <script src="css_js/sweetalert.js"></script>
    <link rel="stylesheet" type="text/css" href="css_js/sweetalert.css">
</head>

<body>
    <?php
    session_start();

    if (isset($_POST['username'])) {

        include('connection.php');

        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordenc = md5($password);

        $query = "SELECT *
        FROM user
        LEFT JOIN expertise
        USING ( expertise_id )
        WHERE user.username  = '$username' AND password = '$passwordenc'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_array($result);

            $_SESSION['userid'] = $row['id'];
            $_SESSION['user'] = $row['doctorname'];
            $_SESSION['office'] = $row['office'];
            $_SESSION['expertise_id'] = $row['expertise_id'];
            $_SESSION['expertise_name'] = $row['expertise_name'];
            $_SESSION['userlevel'] = $row['userlevel'];
            $_SESSION['img'] = $row['img'];


            if ($_SESSION['userlevel'] == 'a') {
                header("Location: index4.php");
            }

            if ($_SESSION['userlevel'] == 'm') {
                header("Location: user_page.php");
            }
            if ($_SESSION['userlevel'] == 'w') {?>
                <script type='text/javascript'>
                swal("แจ้งเตือน!", "ข้อมูลของท่านกำลังรอการยืนยันจากระบบ", "warning").then(function() {
                    window.history.back();
                });
            </script>
            <?php
            }
        } else {
    ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "User หรือ Password ไม่ถูกต้อง", "error").then(function() {
                    window.history.back();
                });
            </script>
    <?php
        }
    } else {
        header("Location: index.php");
    }
    ?>
</body>

</html>