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

    if (isset($_POST['save2'])) {
        $x = $_POST['x'];
    } else {
        $x = 3;
    }
    $query = " SELECT COUNT( `disease_id` ) AS cd, disease_name, 
    SUBSTRING( diagnosis_date, 1, 4 ) AS dates
    FROM `diagnosis`
    LEFT JOIN `disease`
    USING ( `disease_id` )
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
<?php
    $con = mysqli_connect('student.crru.ac.th', '601463046', 'issaraporn@5075', '601463046') or die("Error: " . mysqli_error($con));
    mysqli_query($con, "SET NAMES 'utf8' ");

    if (isset($_POST['save'])) {
        $disease_id = $_POST['disease_id'];
    } else {
        $disease_id = 1;
    }
    $query = " SELECT COUNT( `disease_id` ) AS cd, disease_name, 
    SUBSTRING( diagnosis_date, 1, 4 ) AS dates
    FROM `diagnosis`
    LEFT JOIN `disease`
    USING ( `disease_id` )
    WHERE `disease_id` = '$disease_id'
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
            <div class="row">
                <div class="col-md-10">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">สถิติโรค</h3>
                        </div>
                        <form action="user_page.php" method="POST">

                            <div class="row ml-5 mt-3">
                                <div class="col-md-6">
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
                                <button type="submit" class="btn bg-navy btn-flat mt-3" name="save">บันทึก</button>
                            </div>
                        </form>
                        <!-- <div class="box-body">
                            <div class="chart-container">
                                <canvas id="graphCanvas"></canvas>
                            </div>
                        </div> -->
                        <div class="box-body">
                            <div class="chart-container">
                                <canvas id="myChart" width="400px" height="150px"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

<!--///////////////////////////////////////////////// TOP /////////////////////////////////////////// -->

            <div class="row">
                <div class="col-md-10">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">สถิติโรค</h3>
                        </div>
                        <form action="user_page.php" method="POST">

                            <div class="row ml-5 mt-3">
                                <div class="col-md-4">
                                    <label>เลือกอันดับโรคสูงสุด</label>
                                    <select name="x" class="form-control select2">
                                        <?php for($x = 1; $x <= 10; $x++) { ?>
                                            <option value="<?php echo $x; ?>"><?php echo $x; ?></option>     
                                        <?php } ?>
                                    </select>

                                </div>
                                <button type="submit" class="btn bg-navy btn-flat mt-3" name="save2">บันทึก</button>
                            </div>
                        </form>
                        <div class="box-body">
                            <div class="chart-container">
                                <canvas id="myCharts" width="800px" height="400px"></canvas>
                            </div>
                        </div>

                    </div>
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
                    label: 'ผลการตรวจพบโรค' + [<?php echo $name; ?>][0] + ' (ครั้ง)',
                    data: [<?php echo $totol; ?>],
                    backgroundColor: [
                        // 'rgba(255, 99, 132, 0.2)',
                        // 'rgba(54, 162, 235, 0.2)',
                        // 'rgba(255, 206, 86, 0.2)',
                        // 'rgba(75, 192, 192, 0.2)',
                        // 'rgba(153, 102, 255, 0.2)',
                        // 'rgba(255, 159, 64, 0.2)'
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        // 'rgba(255,99,132,1)',
                        // 'rgba(54, 162, 235, 1)',
                        // 'rgba(255, 206, 86, 1)',
                        // 'rgba(75, 192, 192, 1)',
                        // 'rgba(153, 102, 255, 1)',
                        // 'rgba(255, 159, 64, 1)'
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(75, 192, 192, 1)'
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
    <script>
        var ctx = document.getElementById("myCharts").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php echo $name2; ?>

                ],
                datasets: [{
                    label: 'ผลการตรวจพบโรค (ครั้ง)',
                    data: [<?php echo $totol2; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 99, 132, 0.2)',


                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)',
                        'rgba(255,99,132,1)',

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