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

    <?php
    error_reporting(0);
    $data = array();
    $data = $_SESSION['name'];
    if (isset($_GET["disease_id"])) {
      $data2 = $_GET["disease_id"];
      // $data3=$_GET["symptom_name"];

      // echo($data3);
      $_SESSION['name_test'][] = $data3;
      $_SESSION['name'][] = $data2;
      $data = $_SESSION['name'];
    }
    if (isset($_GET["deleteDis"])) {
      session_destroy();
      // unset($data[$_GET["deleteDis"]]);
      $_SESSION['name'] = $data;
    }
    if (isset($_GET['save'])) {
      foreach ($_SESSION['name'] as $key) {
        $mysqli->query("INSERT INTO disease_symptoms (symptom_id,disease_id) VALUES ('$key','$max')") or die($mysqli->error);
      }
    }

    ?>

    <div class="box-header with-border">
      <h3 class="box-title">อาการ</h3>
    </div>
    <!-- Main content -->
    <section class="content">
      <!-- <form>
        <div class="row">
          <div class="col-md-5 ml-2">
            <label>โรค</label>
            <select name="disease_id" class="form-control select2">
              <?php foreach ($dis as $diss) { ?>
                <option value="<?php echo $diss['disease_id']; ?> <?php echo $diss['disease_name']; ?>"><?php echo $diss['disease_name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-5 mt-2">
            <button type="submit" class="btn bg-maroon btn-flat mt-1">เพิ่ม</button>

          </div>
        </div>


      </form> -->

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
                <input type="radio" value=0 name="r3" class="flat-red">
              </label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 ml-2"> <br>
              <input type="hidden" name="symptom_id" value="<?php echo $symptom_id; ?>">
              <label for="exampleInputEmail1">เพิ่มอาการ</label>
              <input type="text" class="form-control " name="symptom_name" placeholder="อาการ" value="<?php echo $symptom_name; ?>">
            </div>
          </div>

          <!-- select -->
          <div class="col-md-5 ml-1"><br>
            <label>กลุ่มอาการ</label>
            <select name="group_id" class="form-control select2">
              <?php foreach ($result as $results) { ?>
                <option value="<?php echo $results['group_id']; ?>"><?php echo $results['group_name']; ?></option>
              <?php } ?>
            </select>
          </div>
          <!-- select -->

          <!-- รูป -->
          <p class="ml-1">
            <!-- <input type="file" name="coverimg" /> -->
          </p>
          <div class="row">
            <div class="col-md-4 ml-2 mt-1">
              <label>โรค</label>
              <select name="disease_id" class="form-control select2">
                <?php foreach ($dis as $diss) { ?>
                  <option value="<?php echo $diss['disease_id']; ?> <?php echo $diss['disease_name']; ?>"><?php echo $diss['disease_name']; ?></option>
                <?php } ?>
              </select>

            </div>
            <div class="mt-4">
              <a href="addDis.php">เพิ่มโรคใหม่ <i class="fa fa-fw fa-edit"></i></a>
            </div>
          </div>


          <div class="float-right mt-3 ml-2">
            <?php if ($update == true) : ?>
              <button type="submit" class="btn bg-orange btn-flat margin" name="update">แก้ไข</button>
            <?php else : ?>
              <button type="submit" class="btn bg-navy btn-flat margin" name="save">บันทึก</button>
            <?php endif; ?>
          </div>
        </div>
      </form>

      <!-- ตารางแสดงอาการของโรค   -->
      <!-- <div class="box-body mt-4">
        <div class="box">
          <div class="tc">
            <h4>ตารางแสดงอาการของโรค</h4>
          </div>
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width='3%'>ที่</th>
                <th width='40%'>โรค</th>
                <th width='5%'>ลบ</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 0 ?>
              <?php if ($_SESSION['name'] != '') {
                foreach ($data as $key) { ?>

                  <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $key ?></td>
                    <td class="wid20"><a href="index3.php?deleteDis=<?php echo $i ?>" class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-trash"></span></a></td>
                    <?php $i++ ?>
                  </tr>
              <?php }
              } ?>
            </tbody>
          </table>
        </div>
      </div> -->
      <!-- ตารางแสดงอาการของโรค   -->
    </section>

  </div>
</div>
<!-- /.content-wrapper -->

<?php include('includes/scripts.php');
include('includes/footer.php');
?>