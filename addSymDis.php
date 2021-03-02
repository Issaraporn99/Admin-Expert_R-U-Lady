<?php
@session_start();
include('includes/header.php');

?>
<?php require_once 'symptom.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="box box-primary">

    <div class="box-header with-border">
      <?php
      //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
      $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
      $maxdis = $mysqli->query("SELECT MAX(symptom_id)as MAX , `symptom_name` FROM symptom where symptom_id") or die($mysqli);
      foreach ($maxdis as $results)
        $max = $results['MAX'];
      $m = $mysqli->query("SELECT MAX(symptom_id)as MAX , `symptom_name` FROM symptom where symptom_id=$max") or die($mysqli);
      foreach ($m as $resultss)
        $nameD = $resultss['symptom_name'];

      ?>
     <a href="indexSymShow.php">กลับไปหน้าแสดงอาการ</a>
      <br>
      <br>   
      <h3 class="box-title">โรคที่เกี่ยวข้องกับอาการ <?php echo $nameD ?> </h3>
      
      
    </div>
    <!-- Main content -->
    <section class="box-body">
      <!-- -------------------------------------------- -->

      <?php
      $re = 1;
      $re2 = 1;
      // $mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
      $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM disease  order by CONVERT( disease_name USING tis620 ) ASC") or die($mysqli);
      $dissymtable = $mysqli->query("SELECT * FROM `disease_symptoms` INNER JOIN `disease` USING(`disease_id`) WHERE `symptom_id`=$max") or die($mysqli);

      ?>

      <form action="symptom.php" method="POST">
        <div class="row">
          <div class="row">
            <div class="col-md-4 ml-2 mt-2">
              <label>เลือกโรค</label>
              <select name="disease_id" class="form-control select2">
                <?php foreach ($result as $diss) { ?>
                  <option value="<?php echo $diss['disease_id']; ?>"><?php echo $diss['disease_name']; ?></option>
                <?php } ?>
              </select>
              <div class="mt-2">
                <a href="addDis.php">เพิ่มโรคใหม่ <i class="fa fa-fw fa-edit"></i></a>
              </div>
            </div>

            <div class="mt-45">
              <input type="hidden" name="symptom_id" value="<?php echo $symptom_id; ?>">
              <button type="submit" class="btn bg-olive btn-flat" name="save3"><i class="fa fa-save ml-1"></i> บันทึก</button>
            </div>

          </div>
          <!-- <div class="col-md-4 mt-4">
            <a href="index3.php">เพิ่มอาการใหม่ <i class="fa fa-fw fa-edit"></i></a>
          </div> -->
        </div>
      </form>


      <!-- -------------------------------------------- -->




      <!-- ตาราง -->
      <div class="box-body">
        <div class="box">
          <div class="tc">
            <h4>ตารางแสดงโรค</h4>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width='3%'>ที่</th>
                <th width='40%'>โรค</th>
                <th width='3%'>ลบ</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $a = 1;
              while ($row = $dissymtable->fetch_assoc()) : ?>
                <tr>
                  <td><?php echo $a; ?></td>
                  <td><?php echo $row['disease_name']; ?></td>
                  <td><a href="apiAD.php?delete22=<?php echo $row['disease_id']; ?>" class="btn btn-danger btn-flat fl">
                      <span class="glyphicon glyphicon-trash"></span></a></td>
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