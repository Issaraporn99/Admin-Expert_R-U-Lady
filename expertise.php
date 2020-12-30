<?php
@session_start();
//$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
$mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
$expertise_name = '';
$update=false;
$expertise_id = 0;

if (isset($_POST['save'])){
    $expertise_name = $_POST['expertise_name'];
    //เช็คซ้ำ

    $result1 = $mysqli->query("SELECT expertise_name FROM expertise WHERE expertise_name = '$expertise_name'");
    $num=mysqli_num_rows($result1); 
    if($num > 0)
    {
        echo "<script>";
        echo "alert(\"ข้อมูลซ้ำ กรุณาเพิ่มใหม่\");";
        echo "window.location='index5.php';";
        echo "</script>";
    }else{
    $mysqli->query("INSERT INTO expertise (expertise_name) VALUES ('$expertise_name')")or
            die($mysqli->error);

            $_SESSION['message'] = "บันทึกข้อมูลสำเร็จ";
            $_SESSION['msg_type'] = "success";
                
            header("location: index5.php");
}}

if (isset($_GET['delete'])){
    $expertise_id = $_GET['delete'];
    $mysqli->query("DELETE FROM expertise WHERE expertise_id=$expertise_id")or die($mysqli->error());
    $_SESSION['message'] = "ลบข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "danger";

    header("location: index5.php");
}

if (isset($_GET['edit'])){
    $expertise_id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM expertise WHERE expertise_id=$expertise_id")or die($mysqli->error());

        $row = $result->fetch_array();
        $expertise_name = $row['expertise_name'];
    

}

if (isset($_POST['update'])){
    $expertise_id = $_POST['expertise_id'];
    $expertise_name = $_POST['expertise_name'];
    $mysqli->query("UPDATE expertise SET expertise_name='$expertise_name' WHERE expertise_id=$expertise_id")or 
    die($mysqli->error);

    $_SESSION['message'] = "แก้ไขข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "warning";

    header('location: index5.php');

}


