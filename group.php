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
    $group_name = '';
    $update = false;
    $group_id = 0;

    if (isset($_POST['save'])) {
        $group_name = $_POST['group_name'];
        $organ_id = $_POST['organ_id'];

        //เช็คซ้ำ

        $result1 = $mysqli->query("SELECT group_name FROM group_symptom WHERE group_name = '$group_name'");
        $num = mysqli_num_rows($result1);
        if ($num > 0) {
    ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "ชื่อกลุ่มอาการซ้ำ", "error").then(function() {
                    window.location = 'index2.php';
                });
            </script>
        <?php
        } else {
            $mysqli->query("INSERT INTO group_symptom (group_name,organ_id) VALUES ('$group_name','$organ_id')") or
                die($mysqli->error);
        ?>
            <script type='text/javascript'>
                swal("สำเร็จ!", "เพิ่มข้อมูลสำเร็จ", "success").then(function() {
                    window.location = 'index2.php';
                });
            </script>
        <?php
        }
    }

    if (isset($_GET['delete'])) {
        $group_id = $_GET['delete'];
        $result = $mysqli->query("SELECT COUNT( `group_id` ) AS c FROM `symptom` WHERE `group_id` = $group_id")  or die($mysqli->error());;
        foreach ($result as $results)
        $del = $results['c'];

        echo $del;
        if ($del==0) {          
            $mysqli->query("DELETE FROM group_symptom WHERE group_id=$group_id") or die($mysqli->error());
        ?>
            <script type='text/javascript'>
                swal("สำเร็จ!", "ลบข้อมูลสำเร็จ", "success").then(function() {
                    window.location = 'index2.php';
                });
            </script>
        <?php
        } else {
        ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "ไม่สามารถลบข้อมูลได้เนื่องจากมีข้อมูลสัมพันธ์กัน", "warning").then(function() {
                    window.location = 'index2.php';
                });
            </script>
        <?php
        }
    }



    if (isset($_GET['edit'])) {
        $group_id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM group_symptom WHERE group_id=$group_id") or die($mysqli->error());

        $row = $result->fetch_array();
        $group_name = $row['group_name'];
        $organ_id = $row['organ_id'];
    }

    if (isset($_POST['update'])) {
        $group_id = $_POST['group_id'];
        $group_name = $_POST['group_name'];
        $organ_id = $_POST['organ_id'];
        $mysqli->query("UPDATE group_symptom SET group_name='$group_name', organ_id='$organ_id' WHERE group_id=$group_id") or
            die($mysqli->error);
        ?>
        <script type='text/javascript'>
            swal("สำเร็จ!", "แก้ไขข้อมูลสำเร็จ", "success").then(function() {
                window.location = 'index2.php';
            });
        </script>
    <?php
    }
    ?>
</body>

</html>