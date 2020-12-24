<?php
$mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
$topic = '';
$detail = '';
$update=false;
$articles_id = 0;

if (isset($_POST['saves'])){
    $topic = $_POST['topic'];
    $detail = $_POST['detail'];
    $id = $_POST['id'];

    $mysqli->query("INSERT INTO articles (topic,detail,id) VALUES ('$topic','$detail','$id')")or die($mysqli->error);   

$_SESSION['message'] = "บันทึกข้อมูลสำเร็จ";
$_SESSION['msg_type'] = "success";
header("location: articlesDis.php");
}
if (isset($_GET['delete'])){
    $articles_id = $_GET['delete'];
    $mysqli->query("DELETE FROM articles WHERE articles_id=$articles_id")or die($mysqli->error());

    $_SESSION['message'] = "ลบข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "danger";

    header("location: articlesShow.php");
}

if (isset($_GET['edit'])){
    $articles_id = $_GET['edit'];
    $update = true;
    $result=$mysqli->query("SELECT * FROM articles WHERE articles_id=$articles_id")or die($mysqli->error());
    
        $row=$result->fetch_array();
        $topic=$row['topic'];
        $detail = $row['detail'];
        $issue_date = $row['issue_date'];
        $id = $row['id'];
}

if (isset($_POST['update'])){
    $articles_id=$_POST['articles_id'];
    $topic=$_POST['topic'];
    $detail = $_POST['detail'];
    $issue_date = $_POST['issue_date'];
    $id = $_POST['id'];
    $disease_id = $_POST['disease_id'];
    $mysqli->query("UPDATE articles SET topic='$topic',
                                        detail='$detail',
                                        issue_date='$issue_date',
                                        id='$id'
                    WHERE articles_id=$articles_id")or die($mysqli->error);

    $_SESSION['message'] = "แก้ไขข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "warning";
                  
    header("location: articlesShow.php");

}

