<?php
session_start();
if (!$_SESSION['userid']) {
  header("Location: index.php");
} else {
  include('includes/header2.php');
?>
  <?php require_once 'QAapi.php'; ?>
  <?php
  $id = $_SESSION['userid'];
  $i = 1;
  //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
  $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
  $result = $mysqli->query("SELECT *
  FROM `answer`
  JOIN `question`
  USING ( `question_id` )
  WHERE answer.`answer_id` = $answer_id") or die($mysqli);

  ?>
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-danger">
      <div class="row">

        <?php while ($row = $result->fetch_assoc()) : ?>
          <div class="col-md-8">
            <div class="post-content">
              <div class="post-container">
                <img src="includes/2698690-512.png" alt="user" class="profile-photo-md pull-left">
                <?php $question_id = $row['question_id']; ?>
                <div class="post-detail">
                  <div class="user-info">
                    <h5 class="name"><a href="timeline.html" class="profile-link"></a><?php echo $row['question_name']; ?></h5>
                    <p class="text-muted"><?php echo $row['question_date']; ?></p>
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

                  <?php while ($row2 = $result2->fetch_assoc()) : ?>

                    <div class="post-comment">
                      <div class="row">
                          <p class="profile-link name"><?php echo $row2['doctorname']; ?></p>
                          <p><?php echo $row2['answer_name']; ?>
                            <?php if ($row2['id'] == $_SESSION['userid']) { ?>
                              <a href="QAapi.php?del=<?php echo $row2['answer_id']; ?>">
                                <i class="fa fa-fw fa-trash"></i>
                              </a>
                            <?php } ?>
                          </p>
                      </div>
                    </div>

                  <?php endwhile; ?>




                  <form action="QAapi.php" method="POST">

                    <div class="post-comment">
                      <textarea class="form-control" name="answer_name" rows="3" placeholder="แสดงความคิดเห็น ..."><?php echo $answer_name; ?></textarea>

                      <input type="hidden" name="id" value="<?php echo $_SESSION['userid'] ?>">
                      <input type="hidden" name="question_id" value="<?php echo $question_id ?>">
                      <input type="hidden" name="answer_date" value="<?php echo $answer_date; ?>">
                      <input type="hidden" name="answer_id" value="<?php echo $answer_id; ?>">

                    </div>
                    <button type="submit" class="btn bg-navy btn-flat fl" name="update">แก้ไข</button>
                  </form>
                </div>

              </div>
            </div>
          </div>
          <?php $i++; ?>
        <?php endwhile; ?>
      </div>


    </div>
  </div>
  <!-- /.content-wrapper -->
  <?php include('includes/scripts.php');
  include('includes/footer.php');
  ?>

<?php } ?>