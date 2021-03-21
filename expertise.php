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
    $expertise_name = '';
    $update = false;
    $expertise_id = 0;

    if (isset($_POST['save'])) {
        $expertise_name = $_POST['expertise_name'];
        //เช็คซ้ำ

        $result1 = $mysqli->query("SELECT expertise_name FROM expertise WHERE expertise_name = '$expertise_name'");
        $num = mysqli_num_rows($result1);
        if ($num > 0) {
    ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "ชื่อซ้ำ", "error").then(function() {
                    window.location = 'index5.php';
                });
            </script>
        <?php
        } else {
            $mysqli->query("INSERT INTO expertise (expertise_name) VALUES ('$expertise_name')") or
                die($mysqli->error);

        ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "เพิ่มข้อมูลสำเร็จ", "success").then(function() {
                    window.location = 'index5.php';
                });
            </script>
        <?php


        }
    }

    if (isset($_GET['delete'])) {
        $expertise_id = $_GET['delete'];
        $mysqli->query("DELETE FROM expertise WHERE expertise_id=$expertise_id") or die($mysqli->error());

        ?>
        <script type='text/javascript'>
            swal("แจ้งเตือน!", "ลบข้อมูลสำเร็จ", "success").then(function() {
                window.location = 'index5.php';
            });
        </script>
    <?php
    }

    if (isset($_GET['edit'])) {
        $expertise_id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM expertise WHERE expertise_id=$expertise_id") or die($mysqli->error());

        $row = $result->fetch_array();
        $expertise_name = $row['expertise_name'];
    }

    if (isset($_POST['update'])) {
        $expertise_id = $_POST['expertise_id'];
        $expertise_name = $_POST['expertise_name'];
        $mysqli->query("UPDATE expertise SET expertise_name='$expertise_name' WHERE expertise_id=$expertise_id") or
            die($mysqli->error);

    ?>
        <script type='text/javascript'>
            swal("แจ้งเตือน!", "แก้ไขข้อมูลสำเร็จ", "success").then(function() {
                window.location = 'index5.php';
            });
        </script>
    <?php
    }
    ?>
</body>

</html>