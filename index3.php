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
    $resultBf = $mysqli->query("SELECT *FROM `before`") or die($mysqli);

    $dis = $mysqli->query("SELECT * FROM disease") or die($mysqli);

    $dissymtable = $mysqli->query("SELECT * FROM `disease_symptoms` INNER JOIN disease USING(disease_id) INNER JOIN symptom USING(symptom_id)") or die($mysqli);

    $table = $mysqli->query("SELECT * FROM symptom JOIN group_symptom ON symptom.group_id= group_symptom.group_id") or die($mysqli);
    $i = 1;
    $a = 1;
    $maxdis = $mysqli->query("SELECT MAX(symptom_id)as MAX FROM symptom where symptom_id") or die($mysqli);
    foreach ($maxdis as $results)
      $max = $results['MAX'];

    $dissymm = $mysqli->query("SELECT * FROM `disease_symptoms` INNER JOIN `symptom` USING(`symptom_id`) WHERE `symptom_id`=$max") or die($mysqli);

    ?>

    <div class="box-header with-border">
      <h3 class="box-title">อาการ</h3>
    </div>
    <!-- Main content -->
    <section class="content">

      <form action="symptom.php" method="POST" enctype="multipart/form-data">
        <div class="box-body">
          <div class="row">
            <!-- radio -->
            <div class="col-md-3 ml-2">
              <label>
                อาการหลัก
                <input type="radio" value=1 name="r3" class="flat-red" checked>
              </label>
              <label>
                อาการอื่น ๆ
                <input type="radio" value=2 name="r3" class="flat-red">
              </label>
            </div>
          </div>
          <div class="row">
            <!-- select -->
            <div class="col-md-5 ml-2"><br>
              <label>กลุ่มอาการ</label>
              <select name="group_id" class="form-control select2">
                <?php foreach ($result as $results) { ?>
                  <option value="<?php echo $results['group_id']; ?>"><?php echo $results['group_name']; ?></option>
                <?php } ?>
              </select>
            </div>
            <!-- select -->
            <!-- select -->

            <div class="col-md-5 ml-2"><br>
              <label>คำถามนำ</label>
              <select name="before_id" class="form-control select2">
                <option value="0"><?php echo "ไม่มี"; ?></option>
                <?php foreach ($resultBf as $results) { ?>
                  <option value="<?php echo $results['before_id']; ?>"><?php echo $results['before_ques']; ?></option>
                <?php } ?>
              </select>
            </div>

            <!-- select -->
            <div class="col-md-6 ml-2"> <br>
              <input type="hidden" name="symptom_id" value="<?php echo $symptom_id; ?>">
              <label for="exampleInputEmail1">อาการ</label>
              <input type="text" class="form-control " name="symptom_name" placeholder="รายการ" value="<?php echo $symptom_name; ?>">
            </div>

          </div>

          <!-- รูป -->
          <div class="ml-2 mt-2"><input type="file" name="img" /></div>
          <!-- รูป -->

          <div class="float-right mt-3 ml-2">
            <?php if ($update == true) : ?>
              <button type="submit" class="btn bg-orange btn-flat margin" name="update">แก้ไข</button>
            <?php else : ?>
              <button type="submit" class="btn btn-info btn-flat" name="save"><i class="fa fa-save ml-1"></i> บันทึก</button>
            <?php endif; ?>
          </div>

        </div>
      </form>


    </section>

  </div>
</div>
<!-- /.content-wrapper -->

<?php include('includes/scripts.php');
include('includes/footer.php');
?>