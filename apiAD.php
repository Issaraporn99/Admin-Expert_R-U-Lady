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
//$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
$mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
$update = false;
$symptom_id = 0;
$disease_id=0;

if(isset($_POST['saveAD'])){
    $disease_id = $_POST['disease_id'];
    $maxdis = $mysqli->query("SELECT MAX(articles_id)as MAX FROM articles where articles_id")or die($mysqli); 
    foreach( $maxdis as $results)
    $max= $results['MAX'];
 
    $mysqli->query("INSERT INTO articles_disease (articles_id,disease_id) VALUES ('$max','$disease_id')")or die($mysqli->error);


    echo "<script>";
    echo "window.history.back()";
    echo "</script>";
}
// -----------------------------------------------------------------------------------------------------//

?>


<?php 
if (isset($_POST['save2'])){
    $symptom_id = $_POST['symptom_id'];
    $disease_id = $_POST['disease_id'];
    $mysqli->query("INSERT INTO disease_symptoms (symptom_id,disease_id) 
                    VALUES ('$symptom_id','$disease_id')")or die($mysqli->error);
//    header("location: editSymDis.php");
echo "<script>";
echo "window.history.back()";
echo "</script>";
   }
if (isset($_GET['edit2'])){
    $symptom_id = $_GET['edit2'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM disease_symptoms WHERE symptom_id=$symptom_id")or die($mysqli->error());

    $row = $result->fetch_array();
    $symptom_id = $row['symptom_id']; 
    $disease_id = $row['disease_id'];  
    
}
if (isset($_POST['update2'])){
    $symptom_id = $_POST['symptom_id'];
    $disease_id = $_POST['disease_id'];

    $mysqli->query("UPDATE disease_symptoms SET symptom_id='$symptom_id', disease_id='$disease_id' 
                    WHERE symptom_id=$symptom_id && disease_id=$disease_id") or die($mysqli->error);

    $_SESSION['message'] = "แก้ไขข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "warning";

    header('location: editSymDis.php');
}
if (isset($_GET['delete2'])){
        $symptom_id = $_GET['delete2'];
        $de = $mysqli->query("SELECT * FROM `disease_symptoms` WHERE `symptom_id` = $symptom_id") or die($mysqli->error());
        foreach ($de as $results)
            $del = $results['disease_id'];

        $mysqli->query("DELETE FROM disease_symptoms WHERE symptom_id = $symptom_id and disease_id = $del") or die($mysqli->error());
        echo "<script>";
        echo "window.history.back()";
        echo "</script>";
    }

    if (isset($_GET['delete22'])){
        $disease_id = $_GET['delete22'];
        $de = $mysqli->query("SELECT * FROM `disease_symptoms` WHERE `disease_id` = $disease_id") or die($mysqli->error());
        foreach ($de as $results)
            $del = $results['symptom_id'];

        $mysqli->query("DELETE FROM disease_symptoms WHERE symptom_id = $del and disease_id = $disease_id") or die($mysqli->error());
        echo "<script>";
        echo "window.history.back()";
        echo "</script>";
    }

if (isset($_GET['deleteAD'])){
    $disease_id = $_GET['deleteAD'];
    $de = $mysqli->query("SELECT * FROM `articles_disease` WHERE `disease_id` = $disease_id") or die($mysqli->error());
        foreach ($de as $results)
            $deldis = $results['articles_id'];
    $mysqli->query("DELETE FROM articles_disease WHERE articles_id=$deldis and disease_id=$disease_id")or die($mysqli->error());

    $_SESSION['message'] = "ลบข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "danger";

    echo "<script>";
    echo "window.history.back()";
    echo "</script>";

}
?>
</body>

</html>
