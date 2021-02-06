<?php
@session_start();
include('includes/header.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="box box-warning">
    <?php require_once 'symptom.php'; ?>
    <?php require_once 'disease.php'; ?>
    <!-- <?php
          if (isset($_SESSION['message'])) : ?>

        <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?> -->

    <div class="box-header with-border">
      <h3 class="tc">แก้ไขอาการของโรค </h3>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="box-body">
        <?php
        //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
        $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
        $dis = $mysqli->query("SELECT * FROM disease") or die($mysqli);
        $dissymtable = $mysqli->query("SELECT * FROM `disease_symptoms` INNER JOIN `symptom` USING(`symptom_id`) WHERE `disease_id`=$disease_id") or die($mysqli);
        $i = 1;
        $result = $mysqli->query("SELECT * FROM symptom order by CONVERT( symptom_name USING tis620 ) ASC") or die($mysqli);
        ?>
        <form action="apiAD.php" method="POST">
          <div class="box-body">
            <div class="row">
              <div class="col-md-5 ml-2">
                <label>โรค</label> <?php echo $disease_name ?>
              </div>
            </div>
            <div class="row mt-3">
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

              <div class="col-md-5 ml-2"><br>
                <label>เลือกอาการ</label>
                <select name="symptom_id" class="form-control select2">
                  <?php foreach ($result as $results) { ?>
                    <option value="<?php echo $results['symptom_id']; ?>"><?php echo $results['symptom_name']; ?></option>
                  <?php } ?>
                </select>
              </div>

              <div class="col-md-4 mt-3">
                <input type="hidden" name="disease_id" value="<?php echo $disease_id; ?>">
                <button type="submit" class="btn bg-navy btn-flat ml-5 mt-10" name="save2">บันทึก</button>
              </div>

            </div>
          </div>
        </form>
        <div class="box">
          <!-- /.box-header -->
          <div class="box-body">

            <table id="example1" class="table table-bordered table-striped">

              <thead>
                <tr>
                  <th width='5%'>ที่</th>
                  <th width='60%'>อาการ</th>
                  <th width='3%'><a href="apiAD.php?delete2=<?php echo $row['disease_id']; ?>" class="btn btn-danger btn-flat fl">ลบอาการทั้งหมด</a></th>
                </tr>
              </thead>
              <tbody>
                <?php
                while ($row = $dissymtable->fetch_assoc()) : ?>
                  <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['symptom_name']; ?></td>
                    <td></td>
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