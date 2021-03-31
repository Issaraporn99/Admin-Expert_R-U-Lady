<?php 
 include('includes/header.php'); 
 include('includes/navbar.php'); 
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-primary">
    <?php require_once 'before.php'; ?>
    <!-- <?php 
        if(isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
                  unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?> -->
      <div class="box-header with-border">
        <h3 class="box-title">คำถามนำ</h3>
      </div>
    <!-- Main content -->
    <section class="content">
    <form action="before.php" method="POST">
    <input type="hidden" name="before_id" value="<?php echo $before_id; ?>">
              <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <label for="exampleInputEmail1">เพิ่มคำถามนำ</label>
                  <input type="text" class="form-control " name="before_ques" 
                         placeholder="คำถามนำ" value="<?php echo $before_ques; ?>">
                </div> 
                <div class=" ml-1 mt-3">
                  <?php if ($update == true):?>
                    <button type="submit" class="btn bg-orange btn-flat " name="update">แก้ไข</button>
                  <?php else: ?>
                    <button type="submit" class="btn bg-navy btn-flat" name="save"><i class="fa fa-save ml-1"></i> บันทึก</button>
                  <?php endif; ?>
                </div>
              </div>
              </div>
              <!-- /.box-body -->

              
            </form>       
    </section>

    <?php 
    //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
      $mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT *FROM `before`")or die($mysqli);
      $i=1;
    ?>

    <div class="box">
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>ที่</th>
        <th>ชื่อคำถาม</th>
        <th>จัดการข้อมูล</th>
      </tr>
      </thead>
      <tbody>
      <?php
            while ($row = $result->fetch_assoc()):?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['before_ques']; ?></td>
        <td>
            <a href="beforeSym.php?edit=<?php echo $row['before_id']; ?>"
               class="btn bg-orange btn-flat "><i class="fa fa-fw fa-edit"></i></a>
            <a href="before.php?delete=<?php echo $row['before_id']; ?>"
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