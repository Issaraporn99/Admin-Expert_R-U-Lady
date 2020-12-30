<?php 
session_start();
if (!$_SESSION['userid']) {
        header("Location: index.php");
    } else {
        include('includes/header2.php'); 

?>
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-danger">
  <form role="form">
              <div class="box-body">
              <div class="box-header with-border">
                  <h3 class="tc">บทความ</h3>
              </div>
                <div class="col-md-6">
                  <a href="articles.php" class="btn bg-olive">เขียนบทความ</a>          
                </div> 
              </div>
            </form>   
                     
 <?php 
    $user=$_SESSION['userid'];
    $mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
    //$mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM articles INNER JOIN user USING(`id`) WHERE user.`id` =$user")or die($mysqli);
    $i=1;
 ?>
    <div class="box">
      <div class="box-body">           
      <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th width='3%'>ลำดับที่</th>
        <th width='13%'>วันที่เขียน</th>
        <th width='50%'>บทความ</th>
        <th width='15%'>จัดการข้อมูล</th>
      </tr>
      </thead>
      <tbody>
      <?php
            while ($row = $result->fetch_assoc()):?>
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['issue_date']; ?></td>
        <td><?php echo $row['topic']; ?></td> 
        <td>
        <button type="button" class="btn bg-purple " data-toggle="modal" data-target="#exampleModal<?php echo $row['articles_id']; ?>">
        <span class="glyphicon glyphicon-file"></span></button>

        <div class="modal fade" id="exampleModal<?php echo $row['articles_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $row['articles_id']; ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">   
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="exampleModalLabel"><h3><?php echo $row['topic']; ?></h3> </h5>
                <p>วันที่เขียน <?php echo $row['issue_date']; ?></p>            
              </div>
 
              <div class="modal-body">                                   
              <?php echo $row['detail']; ?>
              <?php $datasss = $row['articles_id']; ?>
              <?php $ddd = $mysqli->query("SELECT * FROM `articles_disease` INNER JOIN disease USING(disease_id) WHERE `articles_id`=$datasss")or die($mysqli);?>
              <?php foreach($ddd as $ddds){?>                   
              <p>เกี่ยวข้องกับโรค : <?php echo $ddds['disease_name'];?></p>            
              <?php } ?> 
              <p>ผู้เขียน : <?php echo $row['doctorname']; ?></p>
  
        
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
              </div>
            </div>
          </div>
        </div>
           
            <a href="articles.php?edit=<?php echo $row['articles_id']; ?>"
               class="btn btn-warning "><i class='fa fa-fw fa-edit'></i></a>
            <a href="articlesAPI.php?delete=<?php echo $row['articles_id']; ?>"
               class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>

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
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>
  <?php include('includes/scripts.php'); 
 include('includes/footer.php'); 
 
}
 ?>