<?php
@session_start();
include('includes/header.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="box box-primary">
    <?php require_once 'symptom.php'; ?>
    <!-- <?php require_once 'disease.php'; ?> -->
    <!-- <?php
          if (isset($_SESSION['message'])) : ?>

        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?> -->

    <?php
    //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
    $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM group_symptom") or die($mysqli);

    $dis = $mysqli->query("SELECT * FROM disease") or die($mysqli);

    $dissymtable = $mysqli->query("SELECT * FROM `disease_symptoms` INNER JOIN disease USING(disease_id) INNER JOIN symptom USING(symptom_id)") or die($mysqli);

    $table = $mysqli->query("SELECT * FROM symptom JOIN group_symptom ON symptom.group_id= group_symptom.group_id") or die($mysqli);
    $i = 1;
    $a = 1;
    $maxdis = $mysqli->query("SELECT MAX(symptom_id)as MAX FROM symptom where symptom_id") or die($mysqli);
    foreach ($maxdis as $results)
      $max = $results['MAX'];
    ?>

    <div class="box-header with-border">
      <h3 class="box-title">อาการ</h3>
    </div>
    <!-- Main content -->
    <section class="content">

      <form action="symptom.php" method="POST" enctype="multipart/form-data">
        <div class="box-body">
          <div class="row">
            <div class="col-md-5"> <br>
              <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
              <label for="exampleInputEmail1">กลุ่มอาการ</label>
              <input type="text" disabled class="form-control " name="group_name" placeholder="กลุ่มอาการ" value="<?php echo $group_name; ?>">
            </div>
          </div>
          <div class="row">
            <div class="col-md-5"> <br>
              <input type="hidden" name="symptom_id" value="<?php echo $symptom_idd; ?>">
              <label for="exampleInputEmail1">อาการ</label>
              <input type="text" class="form-control " name="symptom_name" placeholder="อาการ" value="<?php echo $symptom_name; ?>">
            </div>
          </div>
          <!-- <p  class="ml-1"><input type="file" name="coverimg"/></p> -->

          <div class="mt-2">

            <button type="submit" class="btn bg-orange btn-flat margin" name="update">แก้ไข</button>

          </div>
      </form>


    </section>

  </div>
</div>
<!-- /.content-wrapper -->

<?php include('includes/scripts.php');
include('includes/footer.php');
?>