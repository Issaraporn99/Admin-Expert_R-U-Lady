<?php 
session_start();
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
    $mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
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
        <h3 class="box-title">บทความนี้เกี่ยวข้องกับโรคอะไรบ้าง</h3>
      </div>
      <form>
          <div class="box-body"> 
                  <div class="row">
                    <div class="col-md-4">
                        <label>โรค</label>
                        <select name="disease_id" class="form-control select2">
                        <?php foreach($dis as $diss){?>
                          <option value="<?php echo $diss['disease_id']; ?> <?php echo $diss['disease_name']; ?>"><?php echo $diss['disease_name']; ?></option>
                        <?php } ?> 
                        </select>                                      
                    </div> 
                    <div class="col-md-4"> 
                      <button type="submit" class="btn bg-maroon mt-10">เพิ่ม</button> 
                    </div> 
                  </div> 
                   <!-- ตารางแสดงโรคที่เกี่ยวข้อง  -->
              <div class="box-body">  
           <div class="box">
         <div class="tc"><h4>ตารางแสดงโรคที่เกี่ยวข้อง</h4></div>         
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width='3%'>ที่</th>
                    <th width='40%'>โรค</th>
                    <th width='5%'>ลบ</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0?>
                <?php if ($_SESSION['nameArticles'] != ''){
                  foreach($disArticles as $key){ ?>
               
                <tr>
                    <td><?php echo $i+1 ?></td>
                    <td><?php echo $key ?></td>
                    <td class="wid20"><a href="articlesDis.php?deletedisArticles=<?php echo $i ?>"
               class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-trash"></span></a></td>
               <?php $i++?>
                </tr>
                <?php }} ?> 
                </tbody>
                </table>
                </div>
            </div>             
          <!-- ตารางแสดงโรคที่เกี่ยวข้อง   -->
              </div> 

          </form>   
          <form action="apiAD.php" method="POST">
          <div class="box-footer">
                  <?php if ($update == true):?>
                    <button type="submit" class="btn btn-flat btn-info" name="update">แก้ไข</button>
                  <?php else: ?>
                    <button type="submit" class="btn bg-navy btn-flat margin aa" name="saveAD">บันทึก</button>
                  <?php endif; ?>
                </div>
          </form>
                                               
  </div>
  </div>
  <!-- /.content-wrapper -->
 
  <?php include('includes/scripts.php'); 
 include('includes/footer.php'); }
 ?>

      

