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
        // $result = $mysqli->query("SELECT * FROM `question` LEFT JOIN `expertise` USING ( `expertise_id` )") or die($mysqli);
        $result = $mysqli->query("SELECT `question_id` , `question` ,expertise_name, `question_date` , `question_name` , `expertise_id` , answer_id
        FROM question
        INNER JOIN user
        USING ( `expertise_id` )
        LEFT JOIN answer
        USING ( `question_id` )
        LEFT JOIN `expertise` USING ( `expertise_id` )
        GROUP BY `question_id`
        ORDER BY `question_date` DESC") or die($mysqli);
 $result2 = $mysqli->query("SELECT * FROM `question` LEFT JOIN `answer` USING ( `question_id` )") or die($mysqli);

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
                        while ($row = $result->fetch_assoc()) : $date = date_create($row['question_date']); ?>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php if ($row['question_name'] == "null") {
                                    ?><p>ไม่ระบุชื่อ</p>
                                    <?php } else {
                                        echo $row['question_name'];
                                    } ?>
                                </td>
                                <td><?php echo $row['question']; ?></td>
                                <td><?php echo date_format($date, 'd/m/Y H:i:s'); ?></td>
                                <td><?php echo $row['expertise_name']; ?></td>                   
                                <td>
                                    <button type="button" class="btn btn-info " data-toggle="modal" data-target="#exampleModal<?php echo $row['question_id']; ?>">
                                        <span class="glyphicon glyphicon-file"></span></button>

                                    <div class="modal fade" id="exampleModal<?php echo $row['question_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $row['question_id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        <h3>คำถามจากคุณ <?php if ($row['question_name'] == "null") {
                                                                        ?><h5>ไม่ระบุชื่อ</h5>
                                                            <?php } else {
                                                                            echo $row['question_name'];
                                                                        } ?></h3>
                                                    </h5>

                                                </div>

                                                <div class="modal-body" style="width: 100%">
                                                    <div class="post-content">
                                                        <div class="post-container">
                                                            <img src="includes/2698690-512.png" alt="user" class="profile-photo-md pull-left">
                                                            <?php $question_id = $row['question_id']; ?>
                                                            <div class="post-detail">
                                                                <div class="user-info">
                                                                    <h5 class="name"><a href="timeline.html" class="profile-link"></a>ผู้ถาม : <?php if ($row['question_name'] == "null") {
                                                                                                                                                ?><p>ไม่ระบุชื่อ</p>
                                                                        <?php } else {
                                                                                                                                                    echo $row['question_name'];
                                                                                                                                                } ?></h5>
                                                                    <p class="text-muted"><?php echo date_format($date, 'd/m/Y H:i:s'); ?></p>
                                                                </div>
                                                                <div class="line-divider"></div>
                                                                <div class="post-text">
                                                                    <p><?php echo $row['question']; ?><i class="em em-anguished"></i> <i class="em em-anguished"></i> <i class="em em-anguished"></i></p>
                                                                </div>
                                                                <div class="line-divider"></div>
                                                                <?php $result2 = $mysqli->query("SELECT * FROM `answer` JOIN question 
                                   on answer.question_id=question.question_id 
                                   LEFT JOIN user USING ( id )
                                   WHERE question.question_id=$question_id") or die($mysqli); ?>

                                                                <?php while ($row2 = $result2->fetch_assoc()) : $date = date_create($row2['answer_date']); ?>

                                                                    <div class="post-comment" style="background-color:white;padding:10px;">
                                                                        <div class="row" style="margin:5%;">
                                                                            <p class="profile-link namedt">

                                                                                ผู้ตอบ : <?php echo $row2['doctorname']; ?>
                                                                                <?php if ($row2['id'] == $_SESSION['userid']) { ?>
                                                                                    <a href="QA.php?edit=<?php echo $row2['answer_id']; ?>">
                                                                                        <i class="fa fa-fw fa-edit"></i>
                                                                                    </a>
                                                                                    <a href="QAapi.php?del=<?php echo $row2['answer_id']; ?>">
                                                                                        <i class="fa fa-fw fa-trash"></i>
                                                                                    </a>


                                                                                <?php } ?>
                                                                            </p>
                                                                            <p class="text-muted"><?php echo date_format($date, 'd/m/Y H:i:s'); ?>

                                                                            </p>
                                                                            <p class="mr-5"><?php echo $row2['answer_name']; ?>

                                                                            </p>
                                                                        </div>
                                                                    </div>

                                                                <?php endwhile; ?>
                                                            </div>

                                                        </div>
                                                    </div>


                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <a href="apiIndex6.php?delete2=<?php echo $row['question_id']; ?>" onclick="return confirm('หากลบคำถามนี้ คำตอบทั้งหมดจะถูกลบด้วย คุณต้องการลบใช่หรือไม่?')" class="btn btn-danger btn-flat">
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