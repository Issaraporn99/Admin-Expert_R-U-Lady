<?php
@session_start();
//$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
$mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
$answer_id = 0;
$answer_name = '';

if (isset($_POST['save'])){
    $answer_name = $_POST['answer_name'];
    $id = $_POST['id'];
    $question_id = $_POST['question_id'];

    $mysqli->query("INSERT INTO answer (answer_name,id,question_id) VALUES 
                    ('$answer_name','$id','$question_id')")or die($mysqli->error);

            $_SESSION['message'] = "บันทึกข้อมูลสำเร็จ";
            $_SESSION['msg_type'] = "success";
                
            header("location: qaShow.php");        
}


if (isset($_GET['del'])){
    $answer_id = $_GET['del'];
    $mysqli->query("DELETE FROM answer WHERE answer_id=$answer_id")or die($mysqli->error());
    $_SESSION['message'] = "ลบข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "danger";

    header("location: qaShow.php");
}


if (isset($_GET['edit'])){
    $answer_id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT *
    FROM `answer`
    JOIN `question`
    USING ( `question_id` )
    WHERE answer.`answer_id` =$answer_id")or die($mysqli->error());

    $row = $result->fetch_array();
    $answer_name = $row['answer_name'];  
    
}

if (isset($_POST['update'])){  
    $answer_id = $_POST['answer_id'];
    $answer_name = $_POST['answer_name'];
    $mysqli->query("UPDATE answer SET answer_name='$answer_name' WHERE answer_id=$answer_id") or 
    die($mysqli->error);

    $_SESSION['message'] = "แก้ไขข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "warning";

    header('location: qaShow.php');
}
