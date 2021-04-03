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
    $before_ques = '';
    $update = false;
    $before_id = 0;

    if (isset($_POST['save'])) {
        $before_ques = $_POST['before_ques'];
        //เช็คซ้ำ

        $result1 = $mysqli->query("SELECT before_ques FROM `before` WHERE before_ques = '$before_ques'");
        $num = mysqli_num_rows($result1);
        if ($num > 0) {
    ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "ชื่อซ้ำ", "error").then(function() {
                    window.location = 'beforeSym.php';
                });
            </script>
        <?php
        } else {
            $mysqli->query("INSERT INTO `before` (before_ques,status) VALUES ('$before_ques',0)") or
                die($mysqli->error);

        ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "เพิ่มข้อมูลสำเร็จ", "success").then(function() {
                    window.location = 'index3.php';
                });
            </script>
        <?php


        }
    }

    if (isset($_GET['delete'])) {
        $before_id = $_GET['delete'];
        $result = $mysqli->query("SELECT count(`before_id`) AS c FROM `symptom` WHERE `before_id` = $before_id")  or die($mysqli->error());;
        foreach ($result as $results)
            $del = $results['c'];
        if ($del == 0) {
            $mysqli->query("DELETE FROM `before` WHERE before_id=$before_id") or die($mysqli->error());
        ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "ลบข้อมูลสำเร็จ", "success").then(function() {
                    window.location = 'beforeSym.php';
                });
            </script>
        <?php
        } else {
        ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "ไม่สามารถลบข้อมูลได้เนื่องจากมีข้อมูลสัมพันธ์กัน", "warning").then(function() {
                    window.location = 'beforeSym.php';
                });
            </script>
        <?php
        }
    }

    if (isset($_GET['edit'])) {
        $before_id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM `before` WHERE before_id=$before_id") or die($mysqli->error());

        $row = $result->fetch_array();
        $before_ques = $row['before_ques'];
    }

    if (isset($_POST['update'])) {
        $before_id = $_POST['before_id'];
        $before_ques = $_POST['before_ques'];
        $mysqli->query("UPDATE `before` SET before_ques='$before_ques' WHERE before_id=$before_id") or
            die($mysqli->error);

        ?>
        <script type='text/javascript'>
            swal("แจ้งเตือน!", "แก้ไขข้อมูลสำเร็จ", "success").then(function() {
                window.location = 'beforeSym.php';
            });
        </script>
    <?php
    }
    ?>
</body>

</html>