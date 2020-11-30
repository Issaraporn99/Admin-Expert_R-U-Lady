<?php
@session_start();
$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
$symptom_name = '';
$update=false;
$symptom_id = 0;
$name;

if (isset($_POST['save'])){
    $symptom_name = $_POST['symptom_name'];
    $group_id = $_POST['group_id'];
    $disease_id = $_POST['disease_id'];

     	//เช็คซ้ำ

    $result1 = $mysqli->query("SELECT symptom_name FROM symptom WHERE symptom_name = '$symptom_name'");
    $num=mysqli_num_rows($result1); 
    if($num > 0)
    {
        echo "<script>";
        echo "alert(\"ข้อมูลซ้ำ กรุณาเพิ่มใหม่\");";
        echo "window.location='indexSymShow.php';";
        echo "</script>";
        session_destroy(); 
    }else{
    $mysqli->query("INSERT INTO symptom (symptom_name,group_id) VALUES ('$symptom_name','$group_id')")or
            die($mysqli->error);
    
            $maxsym = $mysqli->query("SELECT MAX(symptom_id)as MAX FROM symptom where symptom_id")or die($mysqli); 
            foreach( $maxsym as $results)
            $max1= $results['MAX'];
            foreach ($_SESSION['name'] as $key ) {
            $mysqli->query("INSERT INTO disease_symptoms (symptom_id,disease_id) VALUES ('$max1','$key')")or die($mysqli->error);
          }
          session_destroy();  

    $getlastid=$mysqli->query("SELECT MAX(symptom_id)AS MAX from symptom where symptom_id")or
            die($mysqli->error);
    foreach( $getlastid as $results)
    $max= $results['MAX'];
    $mysqli->query("INSERT INTO disease_symptoms (symptom_id,disease_id) VALUES ('$max','$disease_id')")or die($mysqli->error);
foreach($getlastid as $results)
$name= $results['MAX'];
$imgFile = $_FILES['coverimg']['name'];
$tmp_dir = $_FILES['coverimg']['tmp_name'];
$imgSize = $_FILES['coverimg']['size'];

if(!empty($imgFile))
{

$upload_dir = 'image/'; // upload directory

$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

// valid image extensions
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

// rename uploading image
$coverpic = $name.".".$imgExt;

// allow valid image file formats
if(in_array($imgExt, $valid_extensions))
{
// Check file size '5MB'
if($imgSize < 5000000)
{
move_uploaded_file($tmp_dir,$upload_dir.$coverpic);
echo "uploading Done";
}
else{
$errMSG = "Sorry, your file is too large.";
}
}
else{
$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}
}

    $_SESSION['message'] = "บันทึกข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "success";
       
    header("location: indexSymShow.php");
}
}


if (isset($_GET['delete'])){
    $symptom_id = $_GET['delete'];
    $mysqli->query("DELETE FROM symptom WHERE symptom_id=$symptom_id")or die($mysqli->error());

        echo "<script>";
        echo "alert(\"ลบข้อมูลเรียบร้อย\");";
        echo "window.location='indexSymShow.php';";
        echo "</script>";


}

if (isset($_GET['edit'])){
    $symptom_id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM symptom WHERE symptom_id=$symptom_id")or die($mysqli->error());
    
        $row = $result->fetch_array();
        $symptom_name = $row['symptom_name'];
    
}


if (isset($_POST['update'])){
    $symptom_id = $_POST['symptom_id'];
    $symptom_name = $_POST['symptom_name'];
    $group_id = $_POST['group_id'];
    $disease_id = $_POST['disease_id'];

    $mysqli->query("UPDATE symptom SET symptom_name='$symptom_name', group_id='$group_id' WHERE symptom_id=$symptom_id") or 
    die($mysqli->error);

    $mysqli->query("UPDATE disease_symptoms SET symptom_id='$symptom_id', disease_id='$disease_id' WHERE symptom_id=$symptom_id") or 
    die($mysqli->error);


    $_SESSION['message'] = "แก้ไขข้อมูลสำเร็จ";
    $_SESSION['msg_type'] = "warning";

    header('location: indexSymShow.php');
}


//Upload Image

if(isset($_POST['cover_up']))
{

$imgFile = $_FILES['coverimg']['name'];
$tmp_dir = $_FILES['coverimg']['tmp_name'];
$imgSize = $_FILES['coverimg']['size'];

if(!empty($imgFile))
{

$upload_dir = 'image/'; // upload directory

$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension

// valid image extensions
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions

// rename uploading image
$coverpic = rand(1000,1000000).".".$imgExt;

// allow valid image file formats
if(in_array($imgExt, $valid_extensions))
{
// Check file size '5MB'
if($imgSize < 5000000)
{
move_uploaded_file($tmp_dir,$upload_dir.$coverpic);
echo "uploading Done";
}
else{
$errMSG = "Sorry, your file is too large.";
}
}
else{
$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
}
}
}

