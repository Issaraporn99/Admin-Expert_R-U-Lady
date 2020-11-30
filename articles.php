<?php 
@session_start();
if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {
        include('includes/header2.php'); 
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-danger">
    <?php require_once 'articlesAPI.php'; ?>

    <?php 
    $mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
    $dis = $mysqli->query("SELECT * FROM disease")or die($mysqli);
 ?>
  <?php 
  error_reporting(0);
  $disArticles=array();
  $disArticles=$_SESSION['nameArticles'];
  if(isset($_GET["disease_id"])){
  $disArticles2=$_GET["disease_id"];

  $_SESSION['nameArticles'][]= $disArticles2;
  $disArticles=$_SESSION['nameArticles'];
  }
  if(isset($_GET["deletedisArticles"])){
             //session_destroy(); 
  unset($disArticles[$_GET["deletedisArticles"]]);
  $_SESSION['disArticles']= $disArticles;             
  }
    
?>
      <div class="box-header with-border">
        <h3 class="box-title">เขียนบทความ</h3>
      </div>
 

          <form action="articlesAPI.php" method="POST">  
          <div class="box">         
              <div class="box-body">                         
                    <div class="col-4">
                    <input type="hidden" name="articles_id" value="<?php echo $articles_id; ?>">
                        <label for="exampleInputEmail1">ชื่อบทความ</label>
                        <input type="text" class="form-control " name="topic" 
                            placeholder="ชื่อบทความ" value="<?php echo $topic;?>">  
                    </div>
              </div>

              <div class="box-body"> 
                  <div class="">
                        <textarea id="sssss" cols="30" rows="10" placeholder="รายละเอียดบทความ..." required name="detail"><?php echo $detail?></textarea>
                  </div>
              </div>
              <!-- <textarea id="editor1" name="editor1" rows="10" cols="80"></textarea> -->
             
                <div class="box-footer">
                <input type="hidden" name="id" value="<?php echo $_SESSION['userid'] ?>">
                <input type="hidden" name="issue_date" value="<?php echo $issue_date; ?>">
                  <?php if ($update == true):?>
                    <button type="submit" class="btn btn-flat btn-info aa" name="update">แก้ไข</button>
                  <?php else: ?>
                    <button type="submit" class="btn bg-navy btn-flat margin aa" name="saves">บันทึก</button>
                  <?php endif; ?>                    
                </div>
              </div>          
          </form>   

 
  </div>
  </div>
  <!-- /.content-wrapper -->
 
  <?php include('includes/scripts.php'); 
 include('includes/footer.php'); 
 ?>
  
  <?php } ?>
      

