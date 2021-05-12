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
        $result = $mysqli->query("SELECT count(`id`) AS c FROM `articles` WHERE `id` = $id")  or die($mysqli->error());;
        $result2 = $mysqli->query("SELECT count(`id`) AS cc FROM `answer` WHERE `id` = $id")  or die($mysqli->error());;
        foreach ($result as $results)
            $del = $results['c'];

        foreach ($result2 as $resultss)
            $del2 = $resultss['cc'];
        if ($del == 0 && $del2 == 0) {
            $mysqli->query("DELETE FROM user WHERE id=$id") or die($mysqli->error());
    ?>
            <script type='text/javascript'>
                swal("สำเร็จ!", "ลบข้อมูลสำเร็จ", "success").then(function() {
                    window.location = 'index6.php';
                });
            </script>
        <?php
        } else {
        ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "ไม่สามารถลบข้อมูลได้เนื่องจากมีข้อมูลสัมพันธ์กัน", "warning").then(function() {
                    window.location = 'index6.php';
                });
            </script>
        <?php
        }
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
    if (isset($_GET['delete2'])) {
        $question_id = $_GET['delete2'];
        $result = $mysqli->query("SELECT * FROM `answer` WHERE `question_id` = $question_id")  or die($mysqli->error());
        foreach ($result as $results)
            $del = $results['question_id'];

            $mysqli->query("DELETE FROM question WHERE question_id=$question_id") or die($mysqli->error());
        ?>
            <script type='text/javascript'>
                swal("สำเร็จ!", "ลบข้อมูลสำเร็จ", "success").then(function() {
                    window.location = 'question.php';
                });
            </script>
        <?php
         $mysqli->query("DELETE FROM answer WHERE question_id=$del") or die($mysqli->error());
        
    }
    ?>
</body>

</html>