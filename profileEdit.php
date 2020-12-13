<?php 
session_start();

    if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {
        include('includes/header2.php'); 
?>
<?php require_once 'profileApi.php'; ?>
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-danger">
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
      <form action="profileApi.php" method="POST">
          <div class="box-body">
              <div class="row ">             
                    <div class="col-md-6">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <label for="exampleInputEmail1" class="ml-5">ชื่อ-นามสกุล</label>
                      <input type="text" class="form-control ml-5" name="doctorname" 
                            placeholder="ชื่อ-นามสกุล" value="<?php echo $doctorname; ?>">
                    </div> 
              </div>
              <div class="row mt-2">             
                    <div class="col-md-6">
                      <input type="hidden" name="id" value="<?php echo $id; ?>">
                      <label for="exampleInputEmail1" class="ml-5">สถานที่ทำงาน</label>
                      <input type="text" class="form-control ml-5" name="office" 
                            placeholder="สถานที่ทำงาน" value="<?php echo $office; ?>">
                    </div>  
                    <div class="col-md-4">
                      <?php if ($update == true):?>
                        <button type="submit" class="btn bg-orange btn-flat ml-5 mt-10" name="update">แก้ไข</button>
                      <?php else: ?>
                        <button type="submit" class="btn bg-navy btn-flat ml-5 mt-10" name="save">บันทึก</button>
                      <?php endif; ?>
                  </div>                        
              </div>
            </div>
          </form>     
    </div>
  </div>  
  </div>
  </div>
  <!-- /.content-wrapper -->
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <?php include('includes/scripts.php'); 
 include('includes/footer.php'); 
 ?>
  
  <?php } ?>