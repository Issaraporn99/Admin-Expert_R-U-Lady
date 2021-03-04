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
    //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
    
    $mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
    $dis = $mysqli->query("SELECT * FROM disease")or die($mysqli);
    $maxdisss = $mysqli->query("SELECT MAX(articles_id)AS MAX from articles where articles_id")or die($mysqli); 
    foreach($maxdisss as $results)
        $maxxx= $results['MAX'];

 ?>
<?php 
      $dissymtable = $mysqli->query("SELECT * FROM `articles_disease` INNER JOIN `disease` USING(`disease_id`) WHERE `articles_id`=$maxxx")or die($mysqli);
?>
      <div class="box-header with-border">
      <a href="articlesShow.php">กลับไปหน้าบทความ</a>
       
      </div>
      <form action="apiAD.php" method="POST">
      <div class="box-body"> 
      <h4 class="box-title">บทความนี้เกี่ยวข้องกับโรคอะไรบ้าง</h4>
                  <div class="row">
                    <div class="col-md-4">
                  <label>เลือกโรค</label>
                  <select name="disease_id" class="form-control select2" >
                  <?php foreach($dis as $results){?>
                    <option value="<?php echo $results['disease_id']; ?>"><?php echo $results['disease_name']; ?></option>
                  <?php } ?> 
                  </select>                
                </div> 
              
                <div class="col-md-4 mt-2"> 
                <input type="hidden" name="articles_id" value="<?php echo $articles_id; ?>">               
                        <button type="submit" class="btn bg-navy ml-5" name="saveAD"><i class="fa fa-save ml-1"></i> บันทึก</button>
                </div>          
            
              </div>                                   
      </div>           
                  </form>
                   <!-- ตารางแสดงโรคที่เกี่ยวข้อง  -->
              <div class="box-body">  
           <div class="box">
         <div class="tc"><h4>ตารางแสดงโรคที่เกี่ยวข้อง</h4></div>         
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width='3%'>ที่</th>
                    <th width='40%'>โรค</th>
                    <th width='3%'>ลบ</th>
                </tr>
                </thead>
                <tbody>
                <?php
          $a=1;
                while ($row = $dissymtable->fetch_assoc()): ?>
          <tr> 
            <td><?php echo $a; ?></td>
            <td><?php echo $row['disease_name']; ?></td>   
            <td><a href="apiAD.php?deleteAD=<?php echo $row['disease_id']; ?>"
                  class="btn btn-danger btn-flat fl"><span class="glyphicon glyphicon-trash"></span></a></td>    
          </tr>
          <?php $a++; ?>
          <?php endwhile; ?> 
                </tbody>
                </table>
                </div>
            </div>             
          <!-- ตารางแสดงโรคที่เกี่ยวข้อง   -->
              </div> 

        
                                               
  </div>
  </div>
  <!-- /.content-wrapper -->
 
  <?php include('includes/scripts.php'); 
 include('includes/footer.php'); }
 ?>

      

