<?php 
 include('includes/header.php'); 
 include('includes/navbar.php'); 
 ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-primary">
    <?php require_once 'organ.php'; ?>
 <?php 
  if(isset($_SESSION['message'])): ?>

  <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
      <?php echo $_SESSION['message'];
            unset($_SESSION['message']);
      ?>
  </div>
  <?php endif ?>
      <div class="box-header with-border">
        <h3 class="box-title">อวัยวะ</h3>
      </div>
    <!-- Main content -->

          <form action="organ.php" method="POST">
          <div class="box-body">
              <div class="row ">             
                    <div class="col-md-6">
                      <input type="hidden" name="organ_id" value="<?php echo $organ_id; ?>">
                      <label for="exampleInputEmail1" class="ml-5">เพิ่มอวัยวะ</label>
                      <input type="text" class="form-control ml-5" name="organ_name" 
                            placeholder="อวัยวะ" value="<?php echo $organ_name; ?>">
                    </div> 
                
              <!-- /.box-body -->
                  <div class="col-md-4">
                      <?php if ($update == true):?>
                        <button type="submit" class="btn bg-orange btn-flat ml-5 mt-10" name="update">แก้ไข</button>
                      <?php else: ?>
                        <button type="submit" class="btn bg-navy btn-flat ml-5 mt-10" name="save"><i class="fa fa-save ml-1"></i> บันทึก</button>
                      <?php endif; ?>
                  </div>
              </div>
            </div>
          </form>       


<?php 
//$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
    $mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM organ")or die($mysqli);
    $i=1;
 ?>

<div class="box">
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>    
        <th width='3%'>ที่</th>
        <th width='40%'>อวัยวะ</th>
        <th width='10%'>จัดการข้อมูล</th>
      </tr>
      </thead>   
      <tbody>
      <?php
            while ($row = $result->fetch_assoc()):?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['organ_name']; ?></td>
        <td>
            <a href="index1.php?edit=<?php echo $row['organ_id']; ?>"
               class="btn bg-orange btn-flat"><i class="fa fa-fw fa-edit"></i></a>
            <a href="organ.php?delete=<?php echo $row['organ_id']; ?>"
               class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-trash"></span></a>
        </td>
      </tr>
      <?php $i++; ?>
      <?php endwhile; ?>   
      </tbody>      
    </table>
</div>
</div>
  </div>
  </div>
  <!-- /.content-wrapper -->
 
  <?php include('includes/scripts.php'); 
 include('includes/footer.php'); 
 ?>
      

