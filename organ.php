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
    $organ_name = '';
    $update = false;
    $organ_id = 0;

    if (isset($_POST['save'])) {
        $organ_name = $_POST['organ_name'];
        //เช็คซ้ำ

        $result1 = $mysqli->query("SELECT organ_name FROM organ WHERE organ_name = '$organ_name'");
        $num = mysqli_num_rows($result1);
        if ($num > 0) {
    ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "ชื่ออวัยวะซ้ำ", "error").then(function() {
                    window.location = 'index1.php';
                });
            </script>
        <?php
        } else {
            $mysqli->query("INSERT INTO organ (organ_name) VALUES ('$organ_name')") or
                die($mysqli->error);

        ?>
            <script type='text/javascript'>
                swal("สำเร็จ!", "เพิ่มข้อมูลสำเร็จ", "success").then(function() {
                    window.location = 'index1.php';
                });
            </script>
        <?php
        }
    }

    if (isset($_GET['delete'])) {
        $organ_id = $_GET['delete'];
        $result = $mysqli->query("SELECT COUNT( `organ_id` ) AS c FROM `group_symptom` WHERE `organ_id` = $organ_id")  or die($mysqli->error());;
        foreach ($result as $results)
            $del = $results['c'];
        if ($del == 0) {
            $mysqli->query("DELETE FROM organ WHERE organ_id=$organ_id") or die($mysqli->error());
        ?>
            <script type='text/javascript'>
                swal("สำเร็จ!", "ลบข้อมูลสำเร็จ", "success").then(function() {
                    window.location = 'index1.php';
                });
            </script>
        <?php
        } else {
        ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "ไม่สามารถลบข้อมูลได้เนื่องจากมีข้อมูลสัมพันธ์กัน", "warning").then(function() {
                    window.location = 'index1.php';
                });
            </script>
        <?php
        }
    }

    if (isset($_GET['edit'])) {
        $organ_id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM organ WHERE organ_id=$organ_id") or die($mysqli->error());

        $row = $result->fetch_array();
        $organ_name = $row['organ_name'];
    }

    if (isset($_POST['update'])) {
        $organ_id = $_POST['organ_id'];
        $organ_name = $_POST['organ_name'];

        $mysqli->query("UPDATE organ SET organ_name='$organ_name' WHERE organ_id=$organ_id") or
            die($mysqli->error);

        ?>
        <script type='text/javascript'>
            swal("สำเร็จ!", "แก้ไขข้อมูลสำเร็จ", "success").then(function() {
                window.location = 'index1.php';
            });
        </script>
    <?php


    }
    ?>
</body>

</html>