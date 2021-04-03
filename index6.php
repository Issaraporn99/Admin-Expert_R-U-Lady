<?php
include('includes/header.php');
?>
<?php require_once 'disease.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="tc">ข้อมูลผู้เชี่ยวชาญ</h3>
        </div>
        <!-- Main content -->
        <?php
        $i = 1;
        //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
        $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM `user` LEFT JOIN `expertise` USING ( `expertise_id` ) WHERE `userlevel` != 'a'") or die($mysqli);


        ?>
        <div class="box">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width='3%'>ที่</th>
                            <th width='20%'>ชื่อ</th>
                            <th width='20%'>สถานที่ทำงาน</th>
                            <th width='20%'>สาขาความเชี่ยวชาญ</th>
                            <th width='10%'>สถานะ</th>
                            <th width='10%'>จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) :
                            $image_name = $row['id'] ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['doctorname']; ?></td>
                                <td><?php echo $row['office']; ?></td>
                                <td><?php echo $row['expertise_name']; ?></td>
                                <td><?php if ($row['userlevel'] != "m") {
                                    ?> <p class="text-warning">รอการยืนยัน</p>
                                    <?php
                                    } else {   ?>
                                        <p class="text-success">สมาชิก</p> <?php
                                                                        } ?>
                                </td>
                                <td><?php if ($row['userlevel'] != "m") {
                                    ?>
                                        <a href="index62.php?edit=<?php echo $row['id']; ?>" class="btn bg-orange btn-flat">
                                        ยืนยันการสมัคร</a>               
                                    <?php
                                    } else {   ?>
                                        <a href="apiIndex6.php?delete=<?php echo $row['id']; ?>" onclick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่?')" class="btn btn-danger btn-flat">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- /.content-wrapper -->
<?php include('includes/scripts.php');
include('includes/footer.php');
?>