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
    $symptom_name = '';
    $update = false;
    $symptom_id = 0;
    $name;

    if (isset($_POST['save'])) {
        $symptom_name = $_POST['symptom_name'];
        $group_id = $_POST['group_id'];
        $disease_id = $_POST['disease_id'];
        $des_name = $_POST['des_name'];

        $mysqli->query("INSERT INTO symptom (symptom_name,group_id) VALUES ('$symptom_name','$group_id')") or
            die($mysqli->error);

        $maxsym = $mysqli->query("SELECT MAX(symptom_id)as MAX FROM symptom where symptom_id") or die($mysqli);
        foreach ($maxsym as $results)
            $max1 = $results['MAX'];

        $mysqli->query("INSERT INTO description (des_name,symptom_id) VALUES ('$des_name','$max1')") or die($mysqli->error);

        $maxdes = $mysqli->query("SELECT MAX( `symptom_id` ) AS MAX2, MAX( des_id ) AS MAX
    FROM description
    WHERE `des_id`") or die($mysqli);
        foreach ($maxdes as $re)
            $a1 = $re['MAX'];
        $a2 = $re['MAX2'];

        $mysqli->query("INSERT INTO disease_symptoms (symptom_id,disease_id,des_id) VALUES ('$a2','$disease_id','$a1')") or die($mysqli->error);

        if ($mysqli) {
    ?>
            <script type='text/javascript'>
                swal("สำเร็จ!", "เพิ่มข้อมูลสำเร็จ", "success").then(function() {
                    window.location = 'indexSymShow.php';
                });
            </script>
        <?php

        } else {
        ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "เกิดข้อผิดพลาด!", "error").then(function() {
                    window.location = 'index3.php';
                });
            </script>
    <?php

        }
    }
    ?>
    <?php

    if (isset($_GET['delete'])) {
        $des_id = $_GET['delete'];
        $mysqli->query("DELETE FROM description WHERE des_id = $des_id") or die($mysqli->error());
        if ($mysqli) {
    ?>
            <script type='text/javascript'>
                swal("สำเร็จ!", "ลบข้อมูลสำเร็จ", "success").then(function() {
                    window.location = 'indexSymShow.php';
                });
            </script>
        <?php

        } else {
        ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "เกิดข้อผิดพลาด!", "error").then(function() {
                    window.location = 'index3.php';
                });
            </script>
    <?php

        }
    }

    if (isset($_GET['edit'])) {
        $symptom_id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM symptom WHERE symptom_id=$symptom_id") or die($mysqli->error());

        $row = $result->fetch_array();
        $symptom_name = $row['symptom_name'];
    }


    if (isset($_POST['update'])) {
        $symptom_id = $_POST['symptom_id'];
        $symptom_name = $_POST['symptom_name'];
        $group_id = $_POST['group_id'];
        $disease_id = $_POST['disease_id'];

        $mysqli->query("UPDATE symptom SET symptom_name='$symptom_name', group_id='$group_id' WHERE symptom_id=$symptom_id") or
            die($mysqli->error);

        $mysqli->query("UPDATE disease_symptoms SET symptom_id='$symptom_id', disease_id='$disease_id' WHERE symptom_id=$symptom_id") or
            die($mysqli->error);


        $_SESSION['message'] = "แก้ไขข้อมูลสำเร็จ";
        $_SESSION['msg_type'] = "warning";

        header('location: indexSymShow.php');
    }
    ?>

</body>

</html>