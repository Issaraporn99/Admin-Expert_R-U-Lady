<?php 
 include('includes/header.php'); 
 include('includes/navbar.php'); 
 ?>
  <?php require_once 'group.php'; 
  
?>
  
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">กลุ่มอาการ</h3>
      </div>
    <!-- Main content -->
    <section class="content">
          <form action="group.php" method="POST">
              <div class="box-body">
                <div class="col-md-6">
                <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                  <label for="exampleInputEmail1">เพิ่มกลุ่มอาการ</label>
                  <input type="text" class="form-control " name="group_name" 
                         placeholder="กลุ่มอาการ" value="<?php echo $group_name;?>">
                </div> 
                <!-- select -->
                
<?php 
//$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
    $mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM organ")or die($mysqli);

    $table = $mysqli->query("SELECT * FROM group_symptom JOIN organ ON group_symptom.organ_id = organ.organ_id")or die($mysqli);
    $i=1;
 ?>
                <div class="col-md-4">                          
                  <label>อวัยวะ</label>
                  <select name="organ_id" class="form-control select2" >
                  <?php foreach($result as $results){?>
                    <option value="<?php echo $results['organ_id']; ?>"><?php echo $results['organ_name']; ?></option>
                  <?php } ?> 
                  </select>               
                </div>
              </div>
              <!-- /.box-body -->
                  
              <div class="box-footer">
                  <?php if ($update == true):?>
                    <button type="submit" class="btn bg-orange btn-flat margin" name="update">แก้ไข</button>
                  <?php else: ?>
                    <button type="submit" class="btn bg-navy btn-flat margin" name="save">บันทึก</button>
                  <?php endif; ?>
                </div>
            </form>       
    </section>
    <div class="box">
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>ที่</th>
        <th>กลุ่มอาการ</th>
        <th>อวัยวะ</th>
        <th>จัดการข้อมูล</th>
      </tr>
      </thead>    
      <tbody>
      <?php
            while ($row = $table->fetch_assoc()):?>
      <tr>  
        <td><?php echo $i; ?></td>
        <td><?php echo $row['group_name']; ?></td>
        <td><?php echo $row['organ_name']; ?></td>
        <td>
            <a href="index2.php?edit=<?php echo $row['group_id']; ?>"
               class="btn bg-orange btn-flat"><i class="fa fa-fw fa-edit"></i></a>
            <a href="group.php?delete=<?php echo $row['group_id']; ?>"
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