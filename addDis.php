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
                  <h3 class="box-title">โรค</h3>

            </div>
            <!-- Main content -->
            <section class="box-body">

                  <form action="disease.php" method="POST">
                        <div class="row">
                              <div class="form-group col-md-6 ml-1">
                                    <input type="hidden" name="disease_id" value="<?php echo $disease_id; ?>">
                                    <label>ชื่อโรค</label>
                                    <input type="text" class="form-control"  name="disease_name" placeholder="ชื่อโรค" value="<?php echo $disease_name; ?>">

                              </div>
                              <div class="form-group col-md-4">
                                    <label>จำนวนอาการที่มีความเสี่ยง (เช่น 3 อาการ ขึ้นไป)</label>
                                    <input type="number" class="form-control"  name="no" value="<?php echo $no; ?>">
                              </div>
                        </div>
                        <div class="form-group col-md-6 ">
                              <label>รายละเอียด</label>
                              <div class="">
                                    <textarea id="editor2" placeholder="รายละเอียด..." name="disease_detail"><?php echo $disease_detail; ?></textarea>
                              </div>
                        </div>
                        <div class="form-group col-md-6 ">
                              <label>สาเหตุของการเกิดโรค</label>
                              <textarea id="editor3" class="form-control" placeholder="สาเหตุของการเกิดโรค ..." name="disease_cause"><?php echo $disease_cause; ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                              <label>การป้องกัน</label>
                              <textarea id="editor4" class="form-control" rows="4" placeholder="การป้องกัน ..." name="disease_defence"><?php echo $disease_defence; ?></textarea>
                        </div>
                        <div class="form-group col-md-6">
                              <label>การรักษา</label>
                              <textarea id="editor5" class="form-control" rows="4" placeholder="การรักษา ..." name="disease_treatment"><?php echo $disease_treatment; ?></textarea>
                        </div>
                        <div class="row box-body ">
                              <div class="form-group col-md-6">
                                    <label>กลุ่มเสี่ยง</label>
                                    <input type="text" class="form-control mt-1" name="disease_risk" placeholder="กลุ่มเสี่ยง" value="<?php echo $disease_risk; ?>">
                              </div>

                              <div class="form-group col-md-6 ">
                                    <label>โอกาสเกิดโรค</label>
                                    <input type="text" class="form-control mt-1" name="disease_chance" placeholder="โอกาสเกิดโรค" value="<?php echo $disease_chance; ?>">
                              </div>
                        </div>
                        <?php
                        //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
                        $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
                        $ex = $mysqli->query("SELECT * FROM expertise") or die($mysqli);
                        ?>
                        <div class="row box-body ">
                              <div class="form-group col-md-6">
                                    <label>เลือกสาขาความเชี่ยวชาญ</label>
                                    <select class="form-control select2" style="width: 100%;" name="expertise_id">
                                          <?php foreach ($ex as $exs) { ?>
                                                <option value="<?php echo $exs['expertise_id']; ?>"><?php echo $exs['expertise_name']; ?></option>
                                          <?php } ?>
                                    </select>
                              </div>
                              <div class="form-group col-md-6">
                                    <label>หมายเหตุ</label>
                                    <textarea class="form-control" rows="3" placeholder="หมายเหตุ ..." name="disease_about"><?php echo $disease_about; ?></textarea>
                              </div>
                        </div>

                        <div class="box-footer">
                              <?php if ($update == true) : ?>
                                    <button type="submit" class="btn bg-orange btn-flat " name="update">แก้ไข</button>
                              <?php else : ?>
                                    <button type="submit" class="btn bg-navy btn-flat aa" name="save"><i class="fa fa-save ml-1"></i> บันทึก</button>
                              <?php endif; ?>

                        </div>
            </section>
            </form>
      </div>
</div>
<!-- /.content-wrapper -->
<?php include('includes/scripts.php');
include('includes/scriptsAddDis.php');
include('includes/footer.php');
?>