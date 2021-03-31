
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>รู้ทันปัญหาสุขภาพผู้หญิง</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
    <!-- bootstrap wysihtml5 - text editor -->
    <!-- Select2 -->
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <link rel="stylesheet" href="trumbowyg/dist/ui/trumbowyg.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="btn.css">
</head>
<body class="hold-transition skin-red-light sidebar-mini">
<div class="wrapper">
<header class="main-header">
    <!-- Logo -->
    <a href="user_page.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>R U</b>L</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>R U </b> Lady</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">                   
              <span class="hidden-xs"> <?php echo $_SESSION['user']; ?> <i class="fa fa-gears"></i></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
                <p><?php echo $_SESSION['user']; ?></p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                <p><a href="logout.php" class="btn btn-block btn-default margin">ออกจากระบบ</a></p>
                </div>
                <div class="pull-left">
                <a href="profile.php"class="btn bg-maroon margin">ข้อมูลส่วนตัว</a></button>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
        <div class="pull-left info">
        <p class="ml-5"><b><?php echo $_SESSION['user']; ?></b></p>        
        <p class="ml-5"><i class="fa fa-circle text-success"></i> ออนไลน์</p>
        </div>
        </div>
 
      </div>
      <p class="ml-5"><b>สถานที่ทำงาน : </b><?php echo $_SESSION['office']; ?></p>
      <p class="ml-5"><b>เชี่ยวชาญด้าน : </b><?php echo $_SESSION['expertise_name']; ?></p>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="active treeview">
          <a href="#">
            <i class="fa fa-dashboard"></i><span>จัดการข้อมูล</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active treeview"><a href="user_page.php"><i class="fa fa-bar-chart"></i>สถิติ</a>
            <ul class="treeview-menu">
            <li><a href="user_page.php"><i class="fa fa fa-circle-o"></i>การตรวจพบโรคตามปี</a></li>
            <li><a href="user_page2.php"><i class="fa fa fa-circle-o"></i>การตรวจพบโรคสูงสุด</a></li>           
          </ul>
            </li>
            <li><a href="articlesShow.php"><i class="fa fa-file-text"></i>บทความของฉัน</a></li>
            <li><a href="articlesShowAll.php"><i class="fa fa-file-text"></i>บทความทั้งหมด</a></li>
            <li><a href="qaShow.php"><i class="fa fa-question-circle"></i>ถาม-ตอบ</a></li>           
          </ul>
        </li> 
        <li class="mt-45"><a href="logout.php"><i class="fa fa-sign-out"></i>ออกจากระบบ</a></li>   
    </section>
    <!-- /.sidebar -->
  </aside>
  
 