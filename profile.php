<?php 
session_start();

    if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {
        include('includes/header2.php'); 
?>

  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-danger">
  <form role="form">
              <div class="box-body">            
              <div class="box-header with-border">
                  <h3 class="tc">ข้อมูลส่วนตัว</h3>
              </div>               
              </div>
          
                     
 <?php 
    $user=$_SESSION['userid'];
    $mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM `user` LEFT JOIN expertise USING(expertise_id) WHERE `id`= $user")or die($mysqli);
    $i=1;
  
 ?>

 <div class="box box-danger">

      <div class="box-body ml-5"> 
        <?php
            while ($row = $result->fetch_assoc()):?>   
            <p>ชื่อ-นามสกุล : <?php echo $row['doctorname']; ?></p>       
            <p>สถานที่ทำงาน : <?php echo $row['office']; ?></p>
            <p>สาขาความเชี่ยวชาญ : <?php echo $row['expertise_name']; ?></p>
            
      
        <?php endwhile; ?>  
    </div>
  </div>
  </form>   
  </div>
  </div>
  <!-- /.content-wrapper -->
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <?php include('includes/scripts.php'); 
 include('includes/footer.php'); 
 ?>
  
  <?php } ?>