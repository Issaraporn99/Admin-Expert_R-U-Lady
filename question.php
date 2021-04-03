<?php
include('includes/header.php');
?>
<?php require_once 'disease.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="tc">คำถามจากผู้หญิง</h3>
        </div>
        <!-- Main content -->
        <?php
        $i = 1;
        //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
        $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM `question` LEFT JOIN `expertise` USING ( `expertise_id` )") or die($mysqli);


        ?>
        <div class="box">
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width='3%'>ที่</th>
                            <th width='20%'>ชื่อ</th>
                            <th width='20%'>คำถาม</th>
                            <th width='20%'>วันที่ถาม</th>
                            <th width='20%'>สาขาความเชี่ยวชาญ</th>
                            <th width='10%'>จัดการข้อมูล</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $result->fetch_assoc()) : $date = date_create($row['question_date']);?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['question_name']; ?></td>
                                <td><?php echo $row['question']; ?></td>
                                <td><?php echo date_format($date, 'd/m/Y H:i:s');?></td>
                                <td><?php echo $row['expertise_name']; ?></td>

                                <td><a href="apiIndex6.php?delete2=<?php echo $row['question_id']; ?>" 
                                onclick="return confirm('คุณต้องการที่จะลบข้อมูลนี้หรือไม่?')" 
                                class="btn btn-danger btn-flat">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
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