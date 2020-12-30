<?php 
@session_start();
 include('includes/header.php'); 
 
 ?>
 
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-primary">
    <?php require_once 'symptom.php'; ?>
    <!-- <?php require_once 'disease.php'; ?> -->
    <!-- <?php 
        if(isset($_SESSION['message'])): ?>

        <div class="alert alert-<?=$_SESSION['msg_type'] ?>">
            <?php echo $_SESSION['message'];
                  unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?> -->

    <?php 
    //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
    $mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM group_symptom")or die($mysqli);

    $dis = $mysqli->query("SELECT * FROM disease")or die($mysqli);

    $dissymtable = $mysqli->query("SELECT * FROM `disease_symptoms` INNER JOIN disease USING(disease_id) INNER JOIN symptom USING(symptom_id)")or die($mysqli);
   
    $table = $mysqli->query("SELECT * FROM symptom JOIN group_symptom ON symptom.group_id= group_symptom.group_id")or die($mysqli);
    $i=1;
    $a=1;
    $maxdis = $mysqli->query("SELECT MAX(symptom_id)as MAX FROM symptom where symptom_id")or die($mysqli); 
    foreach( $maxdis as $results)
    $max= $results['MAX'];
 ?>
 <?php 
        error_reporting(0);
        $data=array();
        $data=$_SESSION['name'];
        if(isset($_GET["disease_id"])){
        $data2=$_GET["disease_id"];
        // $data3=$_GET["symptom_name"];

        // echo($data3);
        $_SESSION['name_test'][]=$data3;
        $_SESSION['name'][]= $data2;
        $data=$_SESSION['name'];
        }
        if(isset($_GET["deleteDis"])){
        //session_destroy(); 
        unset($data[$_GET["deleteDis"]]);
        $_SESSION['name']= $data;
        
        }
        if (isset($_GET['save'])){
        foreach ($_SESSION['name'] as $key ) {
            $mysqli->query("INSERT INTO disease_symptoms (symptom_id,disease_id) VALUES ('$key','$max')")or die($mysqli->error);
          }
        }
            
        ?>

      <div class="box-header with-border">
        <h3 class="box-title">อาการ</h3>
      </div>
    <!-- Main content -->
    <section class="content">

    <form  action="symptom.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
               <div class="col-md-6"> <br>
                <input type="hidden" name="symptom_id" value="<?php echo $symptom_id; ?>">
                  <label for="exampleInputEmail1">เพิ่มอาการ</label>
                  <input type="text" class="form-control " name="symptom_name" 
                         placeholder="อาการ" value="<?php echo $symptom_name; ?>">
                </div> 
        
                <!-- select -->
                <div class="col-md-5 mb-1"><br>
                  <label>กลุ่มอาการ</label>
                  <select name="group_id" class="form-control select2" >
                  <?php foreach($result as $results){?>
                    <option value="<?php echo $results['group_id']; ?>"><?php echo $results['group_name']; ?></option>
                  <?php } ?> 
                  </select>                
                </div> 
               <!-- select -->  
                                       
              <p  class="ml-1"><input type="file" name="coverimg"/></p>
              
              <div class="float-right">
                  <?php if ($update == true):?>
                    <button type="submit" class="btn bg-orange btn-flat margin" name="update">แก้ไข</button>
                  <?php else: ?>
                    <button type="submit" class="btn bg-navy btn-flat margin" name="save">บันทึก</button>
                  <?php endif; ?>
              </div> 
              </form> 

          
    </section>
  
  </div>
  </div>
  <!-- /.content-wrapper -->

  <?php include('includes/scripts.php'); 
 include('includes/footer.php'); 
 ?>