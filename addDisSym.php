<?php
@session_start();
include('includes/header.php');

?>
<?php require_once 'disease.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="box box-primary">
    <!-- <?php
          if (isset($_SESSION['message'])) : ?>
  <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
      <?php echo $_SESSION['message'];
            unset($_SESSION['message']);
      ?>
  </div>
  <?php endif ?> -->
    <div class="box-header with-border">
      <?php
      //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
      $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
      $maxdis = $mysqli->query("SELECT MAX(disease_id)as MAX , `disease_name` FROM disease where disease_id") or die($mysqli);
      foreach ($maxdis as $results)
        $max = $results['MAX'];
      $m = $mysqli->query("SELECT MAX(disease_id)as MAX , `disease_name` FROM disease where disease_id=$max") or die($mysqli);
      foreach ($m as $resultss)
        $nameD = $resultss['disease_name'];

      ?>
      <h3 class="box-title">อาการของโรค<?php echo $nameD ?> </h3>
    </div>
    <!-- Main content -->
    <section class="box-body">
      <!-- -------------------------------------------- -->

      <?php
      // $mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
      $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM symptom order by CONVERT( symptom_name USING tis620 ) ASC") or die($mysqli);
      $dissymtable = $mysqli->query("SELECT * FROM `disease_symptoms` INNER JOIN `symptom` USING(`symptom_id`) WHERE `disease_id`=$max") or die($mysqli);

      ?>

      <form action="disease.php" method="POST">
        <div class="row">
          <div class="col-md-5 ml-2"><br>
            <label>เลือกอาการ</label>
            <select name="symptom_id" class="form-control select2">
              <?php foreach ($result as $results) { ?>
                <option value="<?php echo $results['symptom_id']; ?>"><?php echo $results['symptom_name']; ?></option>
              <?php } ?>
            </select>
            <div class="mt-4">
              <input type="hidden" name="disease_id" value="<?php echo $disease_id; ?>">
              <button type="submit" class="btn bg-navy btn-flat" name="save2">บันทึก</button>

            </div>
          </div>
          <div class="col-md-4 mt-4">
            <a href="index3.php">เพิ่มอาการใหม่ <i class="fa fa-fw fa-edit"></i></a>
          </div>
        </div>
      </form>


      <!-- -------------------------------------------- -->




      <!-- ตาราง -->
      <div class="box-body">
        <div class="box">
          <div class="tc">
            <h4>ตารางแสดงอาการ</h4>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width='3%'>ที่</th>
                <th width='40%'>อาการ</th>
                <th width='3%'><a href="apiAD.php?delete2=<?php echo $max; ?>" class="btn btn-danger btn-flat fl">ลบอาการทั้งหมด</a></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $a = 1;
              while ($row = $dissymtable->fetch_assoc()) : ?>
                <tr>
                  <td><?php echo $a; ?></td>
                  <td><?php echo $row['symptom_name']; ?></td>
                  <td></td>
                </tr>
                <?php $a++; ?>
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
include('includes/scriptsAddDis.php');
include('includes/footer.php');
?>