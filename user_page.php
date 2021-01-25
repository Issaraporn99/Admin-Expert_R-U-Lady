<?php
session_start();

if (!$_SESSION['userid']) {
    header("Location: index.php");
} else {
    include('includes/header2.php');
?>

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">สถิติโรค</h3>
                        </div>
                        <div class="row ml-5 mt-3">
                            <div class="col-md-8">
                                <label> เลือกปี</label>
                                <select class="form-control select2" style="width: 30%;">
                                    <option selected="selected">Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                                <label> ถึง</label>
                                <select class="form-control select2" style="width: 30%;">
                                    <option selected="selected">Alabama</option>
                                    <option>Alaska</option>
                                    <option>California</option>
                                    <option>Delaware</option>
                                    <option>Tennessee</option>
                                    <option>Texas</option>
                                    <option>Washington</option>
                                </select>
                            </div>
                        </div>
                        <div class="row ml-5 mt-3">
                        <div class="col-md-8">
                            <label> เลือกโรค</label>
                            <select class="form-control select2" style="width: 30%;">
                                <option selected="selected">1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                            </select>
                        </div>
                        </div>
                        <div class="box-body">
                            <div class="chart-container">
                                <canvas id="graphCanvas"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
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
                            label: 'จำนวนการพบโรค'+ name[0],
                            backgroundColor: '#fca652',
                            borderColor: '#ffd57e',
                            hoverBackgroundColor: '#ffd57e',
                            hoverBorderColor: '#ffd57e',
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