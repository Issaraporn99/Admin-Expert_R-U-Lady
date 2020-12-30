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
                
            header("location: QA.php");        
}


if (isset($_GET['delete'])){
    $answer_id = $_GET['delete'];
    $mysqli->query("DELETE FROM answer WHERE answer_id=$answer_id")or die($mysqli->error());
    $_SESSION['message'] = "ลบข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "danger";

    header("location: QA.php");
}


// if (isset($_GET['edit'])){
//     $group_id = $_GET['edit'];
//     $update = true;
//     $result = $mysqli->query("SELECT * FROM group_symptom WHERE group_id=$group_id")or die($mysqli->error());

//     $row = $result->fetch_array();
//     $group_name = $row['group_name']; 
//     $organ_id = $row['organ_id'];   
    
// }

// if (isset($_POST['update'])){  
//     $group_id = $_POST['group_id'];
//     $group_name = $_POST['group_name'];
//     $organ_id = $_POST['organ_id'];
//     $mysqli->query("UPDATE group_symptom SET group_name='$group_name', organ_id='$organ_id' WHERE group_id=$group_id") or 
//     die($mysqli->error);

//     $_SESSION['message'] = "แก้ไขข้อมูลสำเร็จ";
//     $_SESSION['msg_type'] = "warning";

//     header('location: index2.php');
// }
