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

        $x = isset($_POST['x']) ? $_POST['x'] : "5";
        $da = isset($_POST['dates']) ? $_POST['dates'] : "2018";
        $daa = isset($_POST['datess']) ? $_POST['datess'] : "2021";

        if (isset($_POST['save2'])) {
            if ($da > $daa) {
        ?>
                <script type='text/javascript'>
                    swal("แจ้งเตือน!!", "กรุณาเลือกช่วงปีให้ถูกต้อง เช่น 2019 - 2021", "error").then(function() {
                        window.location = 'user_page2.php';
                    });
                </script>
        <?php
            }
        } else {
            $x = 5;
            $da = 2018;
            $daa = 2021;
        }
        $query = " SELECT COUNT( `disease_id` ) AS cd, disease_name, 
    SUBSTRING( diagnosis_date, 1, 4 ) AS dates
    FROM `diagnosis`
    LEFT JOIN `disease`
    USING ( `disease_id` )
    WHERE SUBSTRING( diagnosis_date, 1, 4 ) BETWEEN '$da' AND '$daa'
    group by `disease_id`
    order by cd desc LIMIT 0 , $x";
        $result = mysqli_query($con, $query);
        $resultchart2 = mysqli_query($con, $query);

        //for chart
        $totol2 = array();
        $name2 = array();

        while ($rs = mysqli_fetch_array($resultchart2)) {
            $totol2[] = "\"" . $rs['cd'] . "\"";
            $name2[] = "\"" . $rs['disease_name'] . "\"";
        }
        $totol2 = implode(",", $totol2);
        $name2 = implode(",", $name2);
        ?>

        <div class="content-wrapper">
            <!-- Main content -->
            <section class="content">
                <div class="box box-danger">
                    <div class="box-body">
                        <div class="box-header with-border">
                            <h3 class="box-title">แสดงสถิติการตรวจโรคที่พบสูงสุดในช่วงปี</h3>
                        </div>
                        <form action="user_page2.php" method="POST">
                            <div class="row ml-5 mt-3">
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
                                <div class="col-md-2">
                                    <label>เลือกปี </label>
                                    <select name="dates" class="form-control select2">
                                        <?php foreach ($result as $results) {
                                            if ($da == $results['dates']) {
                                        ?>
                                                <option value="<?php echo $results['dates']; ?>" selected><?php echo $results['dates']; ?></option>
                                            <?php } else { ?>

                                                <option value="<?php echo $results['dates']; ?>">
                                                <?php echo $results['dates'];
                                            } ?></option>
                                            <?php } ?>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label>ถึงปี </label>
                                    <select name="datess" class="form-control select2">
                                        <?php foreach ($result2 as $results) {
                                            if ($daa == $results['datess']) {
                                        ?>
                                                <option value="<?php echo $results['datess']; ?>" selected><?php echo $results['datess']; ?></option>
                                            <?php } else { ?>

                                                <option value="<?php echo $results['datess']; ?>">
                                                <?php echo $results['datess'];
                                            } ?></option>
                                            <?php } ?>
                                    </select>
                                </div>

                            </div>
                            <div class="row ml-5 mt-3">
                                <div class="col-md-3">
                                    <label>เลือกอันดับของโรค</label>
                                    <select name="x" class="form-control select2">
                                        <?php for ($xx = 1; $xx <= 10; $xx++) {
                                            if ($x == $xx) {
                                        ?>
                                                <option value="<?php echo $xx; ?>" selected><?php echo $xx; ?></option>
                                            <?php } else { ?>

                                                <option value="<?php echo $xx; ?>"><?php echo $xx; ?></option>
                                        <?php }
                                        } ?>
                                    </select>

                                </div>
                                <button type="submit" class="btn bg-navy btn-flat mt-3" name="save2"><i class="fa fa-fw fa-search"></i></button>
                            </div>

                            <div class="row ml-5 mt-3">
                                <div class="box-body col-md-10">
                                    <p>จำนวน (ครั้ง)</p>
                                    <canvas id="myCharts"></canvas>

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
            var ctx = document.getElementById("myCharts").getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php echo $name2; ?>

                    ],
                    datasets: [{
                        label: 'สถิติจำนวนครั้งการตรวจพบโรค' + ' ปี ' + [<?php echo $da; ?>] + ' - ' + [<?php echo $daa; ?>],
                        data: [<?php echo $totol2; ?>],
                        backgroundColor: [
                            '#98acf8',
                            '#98acf8',
                            '#98acf8',
                            '#98acf8',
                            '#98acf8',
                            '#98acf8',
                            '#98acf8',
                            '#98acf8',
                            '#98acf8',
                            '#98acf8'


                        ],
                        borderColor: [
                            '#fcf8ec',
                            '#fcf8ec',
                            '#fcf8ec',
                            '#fcf8ec',
                            '#fcf8ec',
                            '#fcf8ec',
                            '#fcf8ec',
                            '#fcf8ec',
                            '#fcf8ec',
                            '#fcf8ec',

                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        display: false,
                    },

                    title: {
                        display: true,
                        text: 'สถิติจำนวนครั้งการตรวจพบโรค' + ' ปี ' + [<?php echo $da; ?>] + ' - ' + [<?php echo $daa; ?>],
                    }

                }
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <script>
            $(document).ready(function() {
                showGraph();
            });

            function showGraph() {
                {
                    $.post("db_user.php", function(data) {
                        console.log(data);
                        let dates = [];
                        let score = [];
                        let name = [];

                        for (let i in data) {
                            dates.push(data[i].dates);
                            score.push(data[i].cd);
                            name.push(data[i].disease_name);
                        }

                        let chartdata = {
                            labels: dates,
                            datasets: [{
                                label: 'จำนวนการพบโรค' + name[0],
                                backgroundColor: '#51c2d5',
                                borderColor: '#bbf1fa',
                                hoverBackgroundColor: '#bbf1fa',
                                hoverBorderColor: '#51c2d5',
                                data: score
                            }]
                        };

                        let graphTarget = $('#graphCanvas');
                        let barGraph = new Chart(graphTarget, {
                            type: 'bar',
                            data: chartdata
                        })
                    })
                }
            }
        </script>

    <?php
        include('includes/scripts.php');
    }
    ?>
</body>

</html>