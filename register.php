<?php 

    session_start();

    require_once "connection.php";
    if (isset($_POST['submit'])) {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $doctorname = $_POST['doctorname'];
        $office = $_POST['office'];
        $expertise_id = $_POST['expertise_id'];

        $user_check = "SELECT * FROM user WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $user_check);
        $user = mysqli_fetch_assoc($result);

        if ($user['username'] === $username) {
            echo "<script>alert('Username already exists');</script>";
        } else {
            $passwordenc = md5($password);

            $query = "INSERT INTO user (username, password, doctorname, office, expertise_id, userlevel)
                        VALUE ('$username', '$passwordenc', '$doctorname', '$office', '$expertise_id', 'm')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $_SESSION['success'] = "Insert user successfully";
                header("Location: index.php");
            } else {
                $_SESSION['error'] = "Something went wrong";
                header("Location: index.php");
            }
        }

    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>รู้ทันปัญหาสุขภาพผู้หญิง</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../csslogin/images/icons/doctor.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../csslogin/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../csslogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../csslogin/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../csslogin/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../csslogin/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../csslogin/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../csslogin/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../csslogin/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../csslogin/css/util.css">
	<link rel="stylesheet" type="text/css" href="../csslogin/css/main.css">
<!--===============================================================================================-->
</head>
<body>
    <div class="limiter">
		<div class="container-login100" style="background-image: url('../csslogin/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"class="login100-form validate-form">
                <span class="login100-form-title p-b-49">สมัครสมาชิก</span>
                 <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                    <span class="label-input100">ชื่อผู้ใช้</span>
                    <input  class="input100" type="text" name="username" placeholder="ชื่อผู้ใช้" required>
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>
                 <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                 <span class="label-input100">รหัสผ่าน</span>
                    <input  class="input100" type="password" name="password" placeholder="รหัสผ่าน" required>
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>
                 <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                 <span class="label-input100">ชื่อ-นามสกุล</span>
                    <input  class="input100" type="text" name="doctorname" placeholder="ชื่อ-นามสกุล" required>
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>    
                 <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                 <span class="label-input100">สถานที่ทำงาน</span>
                    <input  class="input100" type="text" name="office" placeholder="สถานที่ทำงาน" required>
                    <span class="focus-input100" data-symbol="&#xf206;"></span>
                </div>
                 <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                    <?php 
                    //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
                        $mysqli = new mysqli('student.crru.ac.th','601463046','issaraporn@5075','601463046') or die(mysqli_error($mysqli));
                        $ex = $mysqli->query("SELECT * FROM expertise")or die($mysqli);
                    ?>
                        <span class="label-input100">เลือกสาขาความเชี่ยวชาญ</span>
                        <select class="form-control" name="expertise_id">  
                            <?php foreach($ex as $exs){?>
                                <option value="<?php echo $exs['expertise_id']; ?>"><?php echo $exs['expertise_name']; ?></option>
                            <?php } ?> 
                        </select>                    
                    </div>
                    <div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" type="submit" name="submit" value="Submit">สมัครสมาชิก</button>
                            
						</div>
					</div>
                
                </form>
                <div class="txt1 text-center p-t-54 p-b-20">
                    <span><a href="index.php">กลับสู่หน้าหลัก</a></span>
                </div>
    </div>
        </div>
    </div>
    <div id="../csslogin/dropDownSelect1"></div>
<!--===============================================================================================-->
	<script src="../csslogin/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../csslogin/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../csslogin/vendor/bootstrap/js/popper.js"></script>
	<script src="../csslogin/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../csslogin/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../csslogin/vendor/daterangepicker/moment.min.js"></script>
	<script src="../csslogin/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../csslogin/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../csslogin/js/main.js"></script>
</body>
</html>