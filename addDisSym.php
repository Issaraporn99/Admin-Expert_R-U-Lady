<?php 
@session_start();
 include('includes/header.php'); 
 
 ?>
<?php require_once 'disease.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-primary">
    <!-- <?php 
  if(isset($_SESSION['message'])): ?>
  <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
      <?php echo $_SESSION['message'];
            unset($_SESSION['message']);
      ?>
  </div>
  <?php endif ?> -->
      <div class="box-header with-border">
      <?php
    $mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
    $maxdis = $mysqli->query("SELECT MAX(disease_id)as MAX , `disease_name` FROM disease where disease_id")or die($mysqli); 
    foreach( $maxdis as $results)
    $max= $results['MAX'];
    $m = $mysqli->query("SELECT MAX(disease_id)as MAX , `disease_name` FROM disease where disease_id=$max")or die($mysqli); 
    foreach( $m as $resultss)
    $nameD = $resultss['disease_name']
    ?> 
        <h3 class="box-title">อาการของโรค<?php echo $nameD ?> </h3>   
      </div>
    <!-- Main content --> 
    <section class="box-body">
      <!-- -------------------------------------------- -->
      <form>       
   
        <?php 
        error_reporting(0);
        $data=array();
        $data=$_SESSION['name'];
        if(isset($_GET["symptom_id"])){
        $data2=$_GET["symptom_id"];
        // $data3=$_GET["symptom_name"];

        // echo($data3);
        $_SESSION['name_test'][]=$data3;
        $_SESSION['name'][]= $data2;
        $data=$_SESSION['name'];
        }
        if(isset($_GET["deletesym"])){
        //session_destroy(); 
        unset($data[$_GET["deletesym"]]);
        $_SESSION['name']= $data;
        
        }
        if (isset($_GET['save'])){
        foreach ($_SESSION['name'] as $key ) {
            $mysqli->query("INSERT INTO disease_symptoms (symptom_id,disease_id) VALUES ('$key','$max')")or die($mysqli->error);
          }
        }
            $mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM symptom order by CONVERT( symptom_name USING tis620 ) ASC")or die($mysqli);
        ?>
        
        
                <div class="row">  
                
                <div class="col-md-5  ml-1"> 
                
                  <label>เลือกอาการ</label>
                  <select id="myInput" name="symptom_id" class="form-control select2" >
                  <?php foreach($result as $results){?>
                    <option value="<?php echo $results['symptom_id'];?> <?php echo $results['symptom_name']; ?> "><?php echo $results['symptom_name']; ?> </option>                
                  <?php } ?> 
                  </select>  
                  </div> 
                  <div class="col-md-5  mt-2"> 
                  <button type="submit" class="btn bg-maroon btn-flat mt-1">เพิ่ม</button>  
                  </div>
                  </div>                        
                                     
        </form>

        
      <!-- -------------------------------------------- -->
      
        
      
           
                         <!-- ตาราง -->
          <div class="box-body">  
           <div class="box">
         <div class="tc"><h4>ตารางแสดงอาการ</h4></div>         
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width='3%'>ที่</th>
                    <th width='40%'>อาการ</th>
                    <th width='5%'>ลบ</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=0?>
                <?php if ($_SESSION['name'] != ''){
                  foreach($data as $key){ ?>               
                <tr>
                    <td><?php echo $i+1 ?></td>
                    <td><?php echo $key ?></td>
                    <td class="wid20"><a href="addDisSym.php?deletesym=<?php echo $i ?>"
               class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-trash"></span></a></td>
               <?php $i++?>
                </tr>
                <?php }} ?> 
                </tbody>
                </table>
            </div>
            </div>          
<!-- ตาราง -->
<form action="disease.php" method="POST">         
        <div class="box-footer">
                  <?php if ($update == true):?>
                    <button type="submit" class="btn bg-orange btn-flat " name="update">แก้ไข</button>
                  <?php else: ?>
                    <button type="submit" class="btn bg-navy btn-flat aa" name="save2">บันทึก</button>
                  <?php endif; ?>
                  </div>  
</form>
  
    </section>
  
  </div>
  </div>
  <!-- /.content-wrapper -->
<?php include('includes/scripts.php'); 
        include('includes/scriptsAddDis.php'); 
        include('includes/footer.php'); 
 ?>
