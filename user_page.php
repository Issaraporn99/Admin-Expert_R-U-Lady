<html>

<head>
    <meta charset="UTF-8" />
    <script src="css_js/sweetalert.min.js"></script>
    <script src="css_js/sweetalert.js"></script>
    <link rel="stylesheet" type="text/css" href="css_js/sweetalert.css">
</head>

<body>
<?php
session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {
    include('includes/header2.php');
?>
    <?php
    $con = mysqli_connect('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");

    if (isset($_POST['save'])) {
        $disease_id = $_POST['disease_id'];
        $da = $_POST['dates'];
        $daa = $_POST['datess'];
        if($da>$daa){
            ?>
            <script type='text/javascript'>
                swal("แจ้งเตือน!!", "กรุณาเลือกช่วงปีให้ถูกต้อง เช่น 2019 - 2021", "error").then(function() {
                    window.location = 'user_page.php';
                });
            </script>
            <?php
        }
    } else {
        $disease_id = 1;
        $da = 2018;
        $daa = 2021;
    }
    $query = "SELECT COUNT( `disease_id` ) AS cd, disease_name, SUBSTRING( diagnosis_date, 1, 4 ) AS dates
    FROM `diagnosis`
    LEFT JOIN `disease`
    USING ( `disease_id` )
    WHERE `disease_id` ='$disease_id'
    AND SUBSTRING( diagnosis_date, 1, 4 ) BETWEEN '$da' AND '$daa'
    GROUP BY dates";
    $result = mysqli_query($con, $query);
    $resultchart = mysqli_query($con, $query);


    //for chart
    $dates = array();
    $totol = array();
    $name = array();

    while ($rs = mysqli_fetch_array($resultchart)) {
        $dates[] = "\"" . $rs['dates'] . "\"";
        $totol[] = "\"" . $rs['cd'] . "\"";
        $name[] = "\"" . $rs['disease_name'] . "\"";
    }

    $dates = implode(",", $dates);
    $totol = implode(",", $totol);
    $name = implode(",", $name);
    ?>
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="box box-danger">
                <div class="box-body">
                    <div class="box-header with-border">
                        <h3 class="box-title">แสดงสถิติการตรวจพบโรคตามปี</h3>
                    </div>
                    <form action="user_page.php" method="POST">

                        <div class="row ml-5 mt-3">
                            <div class="col-md-4">
                                <?php
                                //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
                                $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
                                $result = $mysqli->query("SELECT * FROM `disease`") or die($mysqli);
                                ?>
                                <label>เลือกโรค</label>
                                <select name="disease_id" class="form-control select2">
                                    <?php foreach ($result as $results) { ?>
                                        <option value="<?php echo $results['disease_id']; ?>"><?php echo $results['disease_name']; ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>

                        <?php
                        //$mysqli = new mysqli('localhost','root','','doctor') or die(mysqli_error($mysqli));
                        $mysqli = new mysqli('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die(mysqli_error($mysqli));
                        $result = $mysqli->query("SELECT SUBSTRING( diagnosis_date, 1, 4 ) AS dates
                                    FROM `diagnosis`
                                    GROUP BY dates") or die($mysqli);
                        $result2 = $mysqli->query("SELECT SUBSTRING( diagnosis_date, 1, 4 ) AS datess
                                    FROM `diagnosis`
                                    GROUP BY datess") or die($mysqli);
                        ?>
                        <div class="row ml-5 mt-3">
                            <div class="col-md-2">
                                <label>เลือกปี </label>
                                <select name="dates" class="form-control select2">
                                    <?php foreach ($result as $results) { ?>
                                        <option value="<?php echo $results['dates']; ?>"><?php echo $results['dates']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label>ถึงปี </label>
                                <select name="datess" class="form-control select2">
                                    <?php foreach ($result2 as $results) { ?>
                                        <option value="<?php echo $results['datess']; ?>"><?php echo $results['datess']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button type="submit" class="btn bg-navy btn-flat mt-3" name="save"><i class="fa fa-fw fa-search"></i></button>
                        </div>

                        <div class="row ml-5 mt-3">
                            <div class="box-body col-md-6">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </form>

                </div>
            </div>   

        </section>
        <!-- /.content -->
    </div>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js"></script>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $dates; ?>

                ],
                datasets: [{
                    label: 'สถิติการตรวจพบโรค' + [<?php echo $name; ?>][0] + ' (ครั้ง) ' + ' ช่วงปี '+[<?php echo $da; ?>] +' ถึง '+' ปี '+[<?php echo $daa; ?>] ,
                    data: [<?php echo $totol; ?>],
                    backgroundColor: [
                        '#16c79a',
                        '#19456b',
                        '#11698e',               
                        '#ffce89',
                        '#16c79a',
                        '#19456b',
                        '#11698e',               
                        '#ffce89',
                        '#16c79a',
                        '#19456b',
                        '#11698e',               
                        '#ffce89',
              
                    ],
                    borderColor: [
                        '#f3ecc2',
                        '#f3ecc2',
                        '#f3ecc2',
                        '#f3ecc2',
                        '#f3ecc2',                
                        '#f3ecc2',
                        '#f3ecc2',
                        '#f3ecc2',
                        '#f3ecc2',
                        '#f3ecc2'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>

<?php
    include('includes/scripts.php');
}
?>
</body>

</html>