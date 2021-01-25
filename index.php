<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>รู้ทันปัญหาสุขภาพผู้หญิง</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="csslogin/images/icons/doctor.png"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="csslogin/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="csslogin/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="csslogin/css/util.css">
	<link rel="stylesheet" type="text/css" href="csslogin/css/main.css">
<!--===============================================================================================-->
</head>
<body>
<?php if (isset($_SESSION['success'])) : ?>
        <div class="success">
            <?php 
                echo $_SESSION['success'];
            ?>
        </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])) : ?>
        <div class="error">
            <?php 
                echo $_SESSION['error'];
            ?>
        </div>
<?php endif; ?>

    <div class="limiter">
		<div class="container-login100" style="background-image: url('csslogin/images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form action="login.php" method="post" class="login100-form validate-form">
                <span class="login100-form-title p-b-49">เข้าสู่ระบบ</span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                    <span class="label-input100">ชื่อผู้ใช้</span>
                        <input  class="input100" type="text" name="username" placeholder="Username" required>
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-23" data-validate = "Username is reauired">
                        <span class="label-input100">รหัสผ่าน</span>
                        <input class="input100" type="password" name="password" placeholder="Password" required>
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>

                    <div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn" type="submit" name="submit" value="Login">เข้าสู่ระบบ</button>
						</div>
					</div>

                </form>
                <div class="txt1 text-center p-t-54 p-b-20">
                    <span><a href="register.php">สมัครสมาชิก</a></span>
                </div>
            </div>
        </div>
	</div>


    <div id="csslogin/dropDownSelect1"></div>
<!--===============================================================================================-->
	<script src="csslogin/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="csslogin/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="csslogin/vendor/bootstrap/js/popper.js"></script>
	<script src="csslogin/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="csslogin/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="csslogin/vendor/daterangepicker/moment.min.js"></script>
	<script src="csslogin/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="csslogin/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="csslogin/js/main.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</body>
</html>

<?php 

    if (isset($_SESSION['success']) || isset($_SESSION['error'])) {
        session_destroy();
    }

?>
