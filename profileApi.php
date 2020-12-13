<?php
@session_start();
$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
$doctorname = '';
$office = '';
$update=false;
$id  = 0;

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM user WHERE id=$id")or die($mysqli->error());
    
        $row = $result->fetch_array();
        $doctorname = $row['doctorname'];
        $office = $row['office'];
        
    
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $doctorname = $_POST['doctorname'];
    $office = $_POST['office'];

    $mysqli->query("UPDATE user SET doctorname='$doctorname',office='$office' WHERE id=$id") or 
    die($mysqli->error);

    $_SESSION['message'] = "แก้ไขข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "warning";

    header('location: profile.php');
}



