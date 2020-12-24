<?php
@session_start();
$mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
$organ_name = '';
$update=false;
$organ_id = 0;

if (isset($_POST['save'])){
    $organ_name = $_POST['organ_name'];
//เช็คซ้ำ

$result1 = $mysqli->query("SELECT organ_name FROM organ WHERE organ_name = '$organ_name'");
$num=mysqli_num_rows($result1); 
if($num > 0)
{
    echo "<script>";
    echo "alert(\"ข้อมูลซ้ำ กรุณาเพิ่มใหม่\");";
    echo "window.location='index1.php';";
    echo "</script>";
}else{
    $mysqli->query("INSERT INTO organ (organ_name) VALUES ('$organ_name')")or
            die($mysqli->error);
    
    $_SESSION['message'] = "บันทึกข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "success";

    header("location: index1.php");
}}

if (isset($_GET['delete'])){
    $organ_id = $_GET['delete'];
    $mysqli->query("DELETE FROM organ WHERE organ_id=$organ_id")or die($mysqli->error());
    
    $_SESSION['message'] = "ลบข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "danger";

    header("location: index1.php");

}

if (isset($_GET['edit'])){
    $organ_id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM organ WHERE organ_id=$organ_id")or die($mysqli->error());
    
        $row = $result->fetch_array();
        $organ_name = $row['organ_name'];
    
}

if (isset($_POST['update'])){
    $organ_id = $_POST['organ_id'];
    $organ_name = $_POST['organ_name'];

    $mysqli->query("UPDATE organ SET organ_name='$organ_name' WHERE organ_id=$organ_id") or 
    die($mysqli->error);

    $_SESSION['message'] = "แก้ไขข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "warning";

    header('location: index1.php');
}



