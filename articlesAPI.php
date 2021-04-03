<html>

<head>
    <meta charset="UTF-8" />
    <script src="css_js/sweetalert.min.js"></script>
    <script src="css_js/sweetalert.js"></script>
    <link rel="stylesheet" type="text/css" href="css_js/sweetalert.css">
</head>

<body>
<?php
//$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
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
    $result = $mysqli->query("SELECT count(`articles_id`) AS c FROM `articles_disease` WHERE `articles_id` = $articles_id")  or die($mysqli->error());;
    foreach ($result as $results)
    $del = $results['c'];
    if ($del == 0) {
    $mysqli->query("DELETE FROM articles WHERE articles_id=$articles_id")or die($mysqli->error());
    ?>
    <script type='text/javascript'>
        swal("สำเร็จ!", "ลบข้อมูลสำเร็จ", "success").then(function() {
            window.location = 'articlesShow.php';
        });
    </script>
<?php
} else {
    ?>
    <script type='text/javascript'>
        swal("แจ้งเตือน!", "ไม่สามารถลบข้อมูลได้เนื่องจากมีข้อมูลสัมพันธ์กัน", "warning").then(function() {
            window.location = 'articlesShow.php';
        });
    </script>
<?php
}
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
if (isset($_POST['saveAD'])){
 
    $maxdisss = $mysqli->query("SELECT MAX(articles_id)AS MAX from articles where articles_id")or die($mysqli); 
    foreach($maxdisss as $results)
        $maxxx= $results['MAX'];
    
    foreach ($_SESSION['nameArticles'] as $ad ) {
        $mysqli->query("INSERT INTO articles_disease (articles_id,disease_id) VALUES ('$maxxx','$ad')")or die($mysqli->error);
      }
   
   unset($_SESSION['nameArticles']);
   header("location: articlesShow.php");
   }
   ?>
   </body>

   </html>