<?php
@session_start();
//$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
$mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
$disease_name = '';
$disease_detail = '';
$disease_cause = '';
$disease_risk = '';
$disease_chance = '';
$disease_treatment = '';
$disease_defence = '';
$disease_about = '';
$update=false;
$disease_id = 0;
$symptom_id = 0;

if (isset($_POST['save'])){
    $disease_name = $_POST['disease_name'];
    $disease_detail = $_POST['disease_detail'];
    $disease_cause = $_POST['disease_cause'];
    $disease_risk = $_POST['disease_risk'];
    $disease_chance = $_POST['disease_chance'];
    $disease_treatment = $_POST['disease_treatment'];
    $disease_defence = $_POST['disease_defence'];
    $disease_about = $_POST['disease_about'];
    $expertise_id = $_POST['expertise_id'];
    $no = $_POST['no'];

//เช็คซ้ำ

$result1 = $mysqli->query("SELECT disease_name FROM disease WHERE disease_name = '$disease_name'");
$num=mysqli_num_rows($result1); 
if($num > 0)
{
    echo "<script>";
    echo "alert(\"ข้อมูลซ้ำ กรุณาเพิ่มใหม่\");";
    echo "window.location='addDis.php';";
    echo "</script>";
    session_destroy(); 
}else{
    $mysqli->query("INSERT INTO disease 
            (disease_name,disease_detail,disease_cause,disease_risk,disease_chance,
             disease_treatment,disease_defence,disease_about,expertise_id,no) 
             VALUES ('$disease_name','$disease_detail','$disease_cause',
                    '$disease_risk','$disease_chance','$disease_treatment',
                    '$disease_defence','$disease_about','$expertise_id','$no')")or die($mysqli->error);

$_SESSION['message'] = "บันทึกข้อมูลสำเร็จ";
$_SESSION['msg_type'] = "success";

header("location: addDisSym.php");
}
}
if(isset($_POST['save2'])){
    $symptom_id = $_POST['symptom_id'];
    $status = $_POST['r3'];
    $maxdis = $mysqli->query("SELECT MAX(disease_id)as MAX FROM disease where disease_id")or die($mysqli); 
    foreach( $maxdis as $results)
    $max= $results['MAX'];
 
    $mysqli->query("INSERT INTO disease_symptoms (symptom_id,disease_id) VALUES ('$symptom_id','$max')")or die($mysqli->error);
  
  session_destroy();
  $_SESSION['message'] = "บันทึกข้อมูลสำเร็จ";
$_SESSION['msg_type'] = "success";

header("location: addDisSym.php");
}

if (isset($_GET['delete'])){
    $disease_id = $_GET['delete'];
    $mysqli->query("DELETE FROM disease WHERE disease_id=$disease_id")or die($mysqli->error());

    $_SESSION['message'] = "ลบข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "danger";
    header("location: index4.php");
}

if (isset($_GET['edit'])){
    $disease_id = $_GET['edit'];
    $update = true;
    $result=$mysqli->query("SELECT * FROM disease WHERE disease_id=$disease_id")or die($mysqli->error());
 
        $row=$result->fetch_array();
        $disease_name=$row['disease_name'];
        $disease_detail = $row['disease_detail'];
        $disease_cause = $row['disease_cause'];
        $disease_risk = $row['disease_risk'];
        $disease_chance = $row['disease_chance'];
        $disease_treatment = $row['disease_treatment'];
        $disease_defence = $row['disease_defence'];
        $disease_about = $row['disease_about'];
        $expertise_id = $row['expertise_id'];
        $no = $row['no'];
    

}

if (isset($_POST['update'])){
    $disease_id= $_POST['disease_id'];
    $disease_name= $_POST['disease_name'];
    $disease_detail = $_POST['disease_detail'];
    $disease_cause = $_POST['disease_cause'];
    $disease_risk = $_POST['disease_risk'];
    $disease_chance = $_POST['disease_chance'];
    $disease_treatment = $_POST['disease_treatment'];
    $disease_defence = $_POST['disease_defence'];
    $disease_about = $_POST['disease_about'];
    $expertise_id = $_POST['expertise_id'];
    $no = $_POST['no'];
    $mysqli->query("UPDATE disease SET disease_name='$disease_name',
                                       disease_detail='$disease_detail',
                                       disease_cause='$disease_cause',
                                       disease_risk='$disease_risk',
                                       disease_chance='$disease_chance',
                                       disease_treatment='$disease_treatment',
                                       disease_defence='$disease_defence',
                                       disease_about='$disease_about',
                                       expertise_id='$expertise_id',
                                       no='$no'
                    WHERE disease_id=$disease_id")or die($mysqli->error);
        $_SESSION['message'] = "แก้ไขข้อมูลสำเร็จ";
        $_SESSION['msg_type'] = "warning";
    
        header('location: index4.php');                

}
