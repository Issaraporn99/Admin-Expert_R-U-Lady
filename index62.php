<?php
@session_start();
include('includes/header.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-primary">
        <?php require_once 'apiIndex6.php'; ?>
        <div class="box-header with-border">
            <h3 class="box-title">ข้อมูลการสมัคร</h3>
        </div>
        <!-- Main content -->
        <section class="content">

            <form action="apiIndex6.php" method="POST">
                <div class="box-body">
                    <div class="row">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="col-md-6 ml-2"> <br>
                            <label for="exampleInputEmail1">ชื่อ-สกุล</label>
                            <input name="doctorname" value="<?php echo $doctorname; ?>" disabled>
                        </div>

                        <div class="col-md-6 ml-2"> <br>
                            <label for="exampleInputEmail1">สถานที่ทำงาน</label>
                            <input name="office" value="<?php echo $office; ?>" disabled>
                        </div>

                        <div class="col-md-6 ml-2"> <br>
                            <label for="exampleInputEmail1">สาขาความเชี่ยวชาญ</label>
                            <input name="expertise_name" value="<?php echo $expertise_name; ?>" disabled>
                        </div>

                    </div>
                </div>

                <div class="float-right mt-3 ml-2">

                    <button type="submit" class="btn bg-olive btn-flat margin" name="update">ยืนยันการสมัคร</button>

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