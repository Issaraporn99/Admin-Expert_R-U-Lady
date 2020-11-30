<?php
@session_start();
$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
$group_name = '';
$update=false;
$group_id = 0;

if (isset($_POST['save'])){
    $group_name = $_POST['group_name'];
    $organ_id = $_POST['organ_id'];

    //เช็คซ้ำ

$result1 = $mysqli->query("SELECT group_name FROM group_symptom WHERE group_name = '$group_name'");
$num=mysqli_num_rows($result1); 
if($num > 0)
{
    echo "<script>";
    echo "alert(\"ข้อมูลซ้ำ กรุณาเพิ่มใหม่\");";
    echo "window.location='index2.php';";
    echo "</script>";
}else{
    $mysqli->query("INSERT INTO group_symptom (group_name,organ_id) VALUES ('$group_name','$organ_id')")or
            die($mysqli->error);
            $_SESSION['message'] = "บันทึกข้อมูลสำเร็จ";
            $_SESSION['msg_type'] = "success";
                
            header("location: index2.php");        
}
}

if (isset($_GET['delete'])){
    $group_id = $_GET['delete'];
    $mysqli->query("DELETE FROM group_symptom WHERE group_id=$group_id")or die($mysqli->error());
    $_SESSION['message'] = "ลบข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "danger";

    header("location: index2.php");
}


if (isset($_GET['edit'])){
    $group_id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM group_symptom WHERE group_id=$group_id")or die($mysqli->error());

    $row = $result->fetch_array();
    $group_name = $row['group_name']; 
    $organ_id = $row['organ_id'];   
    
}

if (isset($_POST['update'])){  
    $group_id = $_POST['group_id'];
    $group_name = $_POST['group_name'];
    $organ_id = $_POST['organ_id'];
    $mysqli->query("UPDATE group_symptom SET group_name='$group_name', organ_id='$organ_id' WHERE group_id=$group_id") or 
    die($mysqli->error);

    $_SESSION['message'] = "แก้ไขข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "warning";

    header('location: index2.php');
}
