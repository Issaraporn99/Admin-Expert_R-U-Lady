<?php 
 include('includes/header.php');
 ?>
<?php require_once 'disease.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-primary">
      <div class="box-header with-border">
      <h3 class="tc">โรคทั้งหมด</h3>
      </div>
    <!-- Main content --> 

          <form role="form">
              <div class="box-body">
                <div class="col-md-6">
                  <a href="addDis.php" class="btn bg-maroon btn-flat margin">เพิ่มโรค</a>          
                </div> 
              </div>
            </form>   
            
 <?php 
 $i=1;
 //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
 $mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM disease INNER JOIN expertise USING (expertise_id)")or die($mysqli);
   
    
 ?>
    <div class="box">
      <div class="box-body">           
      <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th width='3%'>ที่</th>
        <th width='20%'>โรค</th>
        <!-- <th width='40%'>รายละเอียด</th> -->
        <th width='10%'>จัดการข้อมูล</th>
      </tr>
      </thead>
      <tbody>
      <?php
            while ($row = $result->fetch_assoc()):
              $image_name=$row['disease_id']?>
            
      <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $row['disease_name']; ?></td>
        <!-- <td><?php echo $row['disease_detail']; ?></td> -->
        <td>
        <button type="button" class="btn bg-purple btn-flat" data-toggle="modal" data-target="#exampleModal<?php echo $row['disease_id']; ?>">
        <i class="fa fa-fw fa-search"></i>
        </button>
        <?php $disid= $row['disease_id']; ?>
       <?php $sym = $mysqli->query("SELECT * FROM `disease_symptoms` INNER JOIN symptom USING(symptom_id) WHERE disease_id=$disid")or die($mysqli);?>
        <div class="modal fade" id="exampleModal<?php echo $row['disease_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?php echo $row['disease_id']; ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              <h3><?php echo $row['disease_name']; ?></h3> 
              </div>
              <div class="modal-body">            
              <h4 class="font-weight-bold">ข้อมูลโรค</h4> <p><?php echo $row['disease_detail']; ?></p>

              <h4>อาการ</h4> 
              <?php foreach($sym as $syms){?>                   
              <p><?php echo $syms['symptom_name'];?></p>            
              <?php } ?> 

              <!-- <h4>รูปภาพ</h4> 
              <?php $img=[1,2]; foreach($img as $imgs){?>
              <?php echo "<img src='diseaseIMG/$image_name/$imgs.jpg' width='auto' height='100'>"; ?>
              <?php $imgs++; ?>
              <?php } ?>  -->

              <h4>สาเหตุ</h4><?php echo $row['disease_cause']; if(empty($row['disease_cause']))  echo "* ไม่ระบุแน่ชัด";  ?>
              <h4>กลุ่มเสี่ยง</h4><?php echo $row['disease_risk']; if(empty($row['disease_risk']))  echo "* ไม่ระบุแน่ชัด";?>
              <h4>โอกาสเกิด</h4><?php echo $row['disease_chance']; if(empty($row['disease_chance']))  echo "* ไม่ระบุแน่ชัด";?>
              <h4>การรักษา</h4><?php echo $row['disease_treatment']; if(empty($row['disease_treatment']))  echo "* ไม่ระบุแน่ชัด";?>
              <h4>การป้องกัน</h4><?php echo $row['disease_defence']; if(empty($row['disease_defence']))  echo "* ไม่ระบุแน่ชัด";?>
              <?php 
                if(!empty($row['disease_about'])){?><h4>หมายเหตุ</h4><?php echo $row['disease_about']; ?><?php } ?>
              <h4>สาขาความเชี่ยวชาญ</h4><?php echo $row['expertise_name']; ?>
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
              </div>
            </div>
          </div>
        </div>
            <a href="addDis2.php?edit=<?php echo $row['disease_id']; ?>"
                  class="btn bg-orange btn-flat"><i class="fa fa-fw fa-edit"></i></a>
            <a href="disease.php?delete=<?php echo $row['disease_id']; ?>"
               class="btn btn-danger btn-flat"><span class="glyphicon glyphicon-trash"></span></a>

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