
<?php 
 include('includes/header.php'); 
 include('includes/navbar.php'); 
 ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-primary">
    <?php require_once 'expertise.php'; ?>
    <!-- <?php 
        if(isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
                  unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?> -->
      <div class="box-header with-border">
        <h3 class="box-title">สาขาความเชี่ยวชาญ</h3>
      </div>
    <!-- Main content -->
    <section class="content">
    <form action="expertise.php" method="POST">
    <input type="hidden" name="expertise_id" value="<?php echo $expertise_id; ?>">
              <div class="box-body">
                <div class="col-md-6">
                  <label for="exampleInputEmail1">เพิ่มสาขาความเชี่ยวชาญ</label>
                  <input type="text" class="form-control " name="expertise_name" 
                         placeholder="สาขาความเชี่ยวชาญ" value="<?php echo $expertise_name; ?>">
                </div> 
              </div>
              <!-- /.box-body -->

              <div class="box-footer ml-1">
                  <?php if ($update == true):?>
                    <button type="submit" class="btn bg-orange btn-flat " name="update">แก้ไข</button>
                  <?php else: ?>
                    <button type="submit" class="btn bg-navy btn-flat" name="save">บันทึก</button>
                  <?php endif; ?>
                </div>
            </form>       
    </section>

    <?php 
    //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
      $mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM expertise")or die($mysqli);
      $i=1;
    ?>

    <div class="box">
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>ที่</th>
        <th>สาขาความเชี่ยวชาญ</th>
        <th>จัดการข้อมูล</th>
      </tr>
      </thead>
      <tbody>
      <?php
            while ($row = $result->fetch_assoc()):?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['expertise_name']; ?></td>
        <td>
            <a href="index5.php?edit=<?php echo $row['expertise_id']; ?>"
               class="btn bg-orange btn-flat "><i class="fa fa-fw fa-edit"></i></a>
            <a href="expertise.php?delete=<?php echo $row['expertise_id']; ?>"
            onclick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่?')" class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-trash"></span></a>
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