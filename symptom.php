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
    $name;



    if (isset($_POST['save'])) {
        $symptom_name = $_POST['symptom_name'];
        $group_id = $_POST['group_id'];
        $status = $_POST['r3'];
        //เช็คซ้ำ

        $result1 = $mysqli->query("SELECT symptom_name FROM symptom WHERE symptom_name = '$symptom_name'");
        $num = mysqli_num_rows($result1);
        if ($num > 0) {
    ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!", "ชื่ออาการซ้ำ", "error").then(function() {
                    window.location = 'index3.php';
                });
            </script>
            <?php
        } else {
            $maxxxxx = $mysqli->query("SELECT MAX(symptom_id)as MAX FROM symptom where symptom_id") or die($mysqli);
            foreach ($maxxxxx as $results)
                $maxxxxxxxxxxxx = $results['MAX']+1;
            //ตัวแปรหน้ารูป
            $name_img = "img";


            $img = (isset($_POST['img']) ? $_POST['img'] : '');
            $upload = $_FILES['img']['name'];

            if ($upload != '') {
                //โฟเดอร์เก็บไฟล์
                $path = "diseaseIMG";
                //ตัวแปรในการตัดชื่อภาพ
                $type = strrchr($_FILES['img']['name'], ".");
                //ตั้งชื่อไฟล์ใหม่
                $newname = $name_img . $maxxxxxxxxxxxx . $type;
                $path_copy = $path . $newname;
                $path_link = "http://student.crru.ac.th/601463046/diseaseIMG" . $newname;
                //คัดลอกไฟล์ไปยังโฟเดอ
                move_uploaded_file($_FILES['img']['tmp_name'], $path_copy);
            }
            $mysqli->query("INSERT INTO symptom (symptom_name,group_id,status,img) VALUES ('$symptom_name','$group_id',$status,'$path_link')") or
                die($mysqli->error);

            if ($mysqli) {
            ?>
                <script type='text/javascript'>
                    swal("สำเร็จ!", "เพิ่มข้อมูลสำเร็จ", "success").then(function() {
                        window.location = 'addSymDis.php';
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
    }
    ?>
    <?php

    if (isset($_GET['delete'])) {
        $symptom_id = $_GET['delete'];
        $de = $mysqli->query("SELECT * FROM `disease_symptoms` WHERE `symptom_id` = $symptom_id") or die($mysqli->error());
        foreach ($de as $results)
            $del = $results['disease_id'];

        $mysqli->query("DELETE FROM symptom WHERE symptom_id = $symptom_id") or die($mysqli->error());
        $mysqli->query("DELETE FROM disease_symptoms WHERE symptom_id = $symptom_id and disease_id = $del") or die($mysqli->error());

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
        $symptom_idd = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT *
        FROM symptom
        JOIN group_symptom
        USING ( group_id )
        WHERE symptom_id=$symptom_idd") or die($mysqli->error());

        $row = $result->fetch_array();
        $symptom_name = $row['symptom_name'];
        $group_name = $row['group_name'];
    }


    if (isset($_POST['update'])) {
        $symptom_idd = $_POST['symptom_id'];
        $symptom_name = $_POST['symptom_name'];

        $mysqli->query("UPDATE symptom SET symptom_name='$symptom_name' WHERE symptom_id=$symptom_idd") or
            die($mysqli->error);
        if ($mysqli) {
        ?>
            <script type='text/javascript'>
                swal("สำเร็จ!", "แก้ไขมูลสำเร็จ", "success").then(function() {
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
    if(isset($_POST['save3'])){
        $disease_id = $_POST['disease_id'];
        $maxdis = $mysqli->query("SELECT MAX(symptom_id)as MAX FROM symptom where symptom_id")or die($mysqli); 
        foreach( $maxdis as $results)
        $max= $results['MAX'];
     
        $mysqli->query("INSERT INTO disease_symptoms (symptom_id,disease_id) VALUES ('$max','$disease_id')")or die($mysqli->error);
    
    header("location: addSymDis.php");
    }

    ?>

</body>

</html>