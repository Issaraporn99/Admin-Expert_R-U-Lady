<?php
session_start();

if (!$_SESSION['userid']) {
  header("Location: index.php");
} else {
  include('includes/header2.php');
?>
  <?php require_once 'profileApi.php'; ?>
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-danger">
      <div class="box-body">
        <div class="box-header with-border">
          <h3 class="tc">ข้อมูลส่วนตัว</h3>
        </div>
      </div>


      <?php
      $user = $_SESSION['userid'];
      //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
      $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
      $result = $mysqli->query("SELECT * FROM `user` LEFT JOIN expertise USING(expertise_id) WHERE `id`= $user") or die($mysqli);
      $i = 1;

      ?>

      <div class="row">
        <div class="col-md-5">
          <!-- Profile Image -->
          <div class="box box-danger">
            <div class="box-body box-profile ">
              <?php
              while ($row = $result->fetch_assoc()) : ?>
                <div>
                  <div>
                    <a class="pull-right" href="profileEdit.php?edit=<?php echo $row['id']; ?>" class="ml-2">
                      <i class="fa fa-fw fa-edit"></i>
                    </a>
                    <h3 class="profile-username text-center"><?php echo $row['doctorname']; ?></h3>
                  </div>
                </div>
                <ul class="list-group list-group-unbordered mt-4">
                  <li class="list-group-item">
                    <b>สถานที่ทำงาน</b>
                    <p class="pull-right"><?php echo $row['office']; ?></p>
                  </li>
                  <li class="list-group-item">
                    <b>สาขาความเชี่ยวชาญ</b>
                    <p class="pull-right"> <?php echo $row['expertise_name']; ?></p>
                  </li>
                </ul>

              <?php endwhile; ?>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <?php include('includes/scripts.php');
  include('includes/footer.php');
  ?>

<?php } ?>