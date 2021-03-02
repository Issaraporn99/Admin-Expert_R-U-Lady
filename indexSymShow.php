<?php 
@session_start();
 include('includes/header.php'); 
 include('includes/navbar.php'); 
 ?>

 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-primary">
    <?php require_once 'symptom.php'; ?>
    <!-- <?php 
        if(isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
                  unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?> -->

      <div class="box-header with-border">
      <a href="index3.php" class="btn bg-maroon btn-flat mt-1">เพิ่มอาการ</a>
      </div>
      <div class="box-header with-border">
      <h3 class="tc">อาการทั้งหมด</h3>
      </div>
    <!-- Main content -->
    <section class="content">
              <div class="box-body">
 <?php 
 //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
    $mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM group_symptom")or die($mysqli);

    $dis = $mysqli->query("SELECT * FROM disease")or die($mysqli);

    $dissymtable = $mysqli->query("SELECT * FROM `disease_symptoms` INNER JOIN disease USING(disease_id) INNER JOIN symptom USING(symptom_id)")or die($mysqli);
   
    $table = $mysqli->query("SELECT * FROM symptom 
                              JOIN group_symptom using(group_id) order by group_id")or die($mysqli);
    $i=1;
    $a=1;
 ?>
               

          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th width='3%'>ที่</th>       
            <th width='15%'>อาการ</th>
            <th width='15%'>กลุ่มอาการ</th>
            <th width='15%'>รูป</th>
            <th width='8%'>จัดการข้อมูล</th>
          </tr>
          </thead>     
          <tbody>
          <?php
                while ($row = $table->fetch_assoc()):
                  $image_name=$row['symptom_id']
                  
                  ?>
          <tr>  
            <td><?php echo $i; ?></td>
            <td><?php echo $row['symptom_name']; ?></td>                  
            <td><?php echo $row['group_name']; ?></td>
            <td><img src = "<?php echo $row['img']; ?>"style="width: 30%;"></td>
            <td>
                <a href="editSym.php?edit=<?php echo $row['symptom_id']; ?>"
                  class="btn bg-orange btn-flat"><i class="fa fa-fw fa-edit"></i></a>
                <a href="symptom.php?delete=<?php echo $row['symptom_id']; ?>"
                  class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-trash"></span></a>
            </td>
          </tr>
          <?php $i++; ?>
          <?php endwhile; ?> 
          </tbody>   
        </table>
        </div>
  </div>
    </section>
  
  </div>
  </div>
  <!-- /.content-wrapper -->

  <?php include('includes/scripts.php'); 
 include('includes/footer.php'); 
 ?>