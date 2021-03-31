<html>

<head>
    <meta charset="UTF-8" />
    <script src="css_js/sweetalert.min.js"></script>
    <script src="css_js/sweetalert.js"></script>
    <link rel="stylesheet" type="text/css" href="css_js/sweetalert.css">
</head>

<body>
    <?php
    @session_start();
    //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
    $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM user WHERE id=$id") or die($mysqli->error());

    ?>
        <script type='text/javascript'>
            swal("สำเร็จ!", "ลบข้อมูลสำเร็จ", "success").then(function() {
                window.location = 'index6.php';
            });
        </script>
    <?php

    }

    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM user LEFT JOIN `expertise` USING ( `expertise_id` ) WHERE id=$id") or die($mysqli->error());

        $row = $result->fetch_array();
        $userlevel = $row['userlevel'];
        $doctorname = $row['doctorname'];
        $office = $row['office'];
        $expertise_name = $row['expertise_name'];
        $expertise_id = $row['expertise_id'];
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $userlevel = $_POST['userlevel'];
        $doctorname = $_POST['doctorname'];
        $office = $_POST['office'];
        $expertise_name = $_POST['expertise_name'];
        $expertise_id = $_POST['expertise_id'];
        
        $mysqli->query("UPDATE user SET userlevel = 'm' WHERE id=$id") or die($mysqli->error);
    ?>
        <script type='text/javascript'>
            swal("สำเร็จ!", "ยืนยันการสมัครสมาชิกสำเร็จ", "success").then(function() {
                window.location = 'index6.php';
            });
        </script>
    <?php
    }
    ?>
</body>

</html>