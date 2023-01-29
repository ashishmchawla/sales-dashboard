<?php

session_start();

if( !isset($_SESSION['token']) ) {
	header("Location: ../");
} else {
	?>
<?php include '../includes/header.php' ?>
<title>Home of Triventure! </title>

<?php include '../includes/sidebar.php'; ?>
<div id="main" class="p-3 d-flex align-items-center justify-content-between">
    <h3 class="m-0">Hello, <?php echo $_SESSION['name']; ?> </h3>
    <h4 class="m-0" id="dateToday"></h4>
</div>
<div class="analytics-wrapper container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div id="chart_area">
                <div id="columnchart_material"></div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <h3> New Clients</h3>
            <div id="chart_area">
                <div id="columnchart_new_material"></div>
            </div>
        </div>
        <div class="col-md-6">
            <h3> Existing Clients</h3>
            <div id="chart_area">
                <div id="columnchart_existing_material"></div>
            </div>
        </div>
    </div>
    <br>
</div>
<?php
	include '../includes/footer.php';
}
?>
<script>
google.charts.load('current', {
    'packages': ['bar']
});
// google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawNewUserChart);
google.charts.setOnLoadCallback(drawExistingUserChart);

async function loadGraph() {
    await $.ajax({
        url: baseUrl + "/allServicesGraph",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        console.log(response);
        if (response.status == 1) {
            drawChart(response.graphData, response.month);
        }
    });
}

function drawChart(chart_data, title) {

    var data = google.visualization.arrayToDataTable(chart_data);

    var options = {
        chart: {
            title: 'Company Performance -' + title,
            subtitle: 'Actuals & Targets',
        },
        height: 400,
        width: '90%',
        legend: {
            position: 'bottom',
        },
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_material'));
    chart.draw(data, options);

    // var chart = new google.visualization.Bar(document.getElementById('columnchart_material'));
    // chart.draw(data, options);

}

function drawNewUserChart(chart_data, title) {

    var data = google.visualization.arrayToDataTable([
        ['Element', 'Density'],
        ['Copper', 8.94],
        ['Silver', 10.49],
        ['Gold', 19.30],
        ['Platinum', 21.45]
    ]);

    var options = {
        chart: {
            title: 'User-wise Performance',
            subtitle: 'Actuals & Targets',
        },
        height: 400,
        width: '90%',
        legend: {
            position: 'bottom',
        },
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_new_material'));
    chart.draw(data, options);
}

function drawExistingUserChart(chart_data, title) {

    var data = google.visualization.arrayToDataTable([
        ['Element', 'Density'],
        ['Copper', 8.94],
        ['Silver', 10.49],
        ['Gold', 19.30],
        ['Platinum', 21.45]
    ]);

    var options = {
        chart: {
            title: 'User-wise Performance',
            subtitle: 'Actuals & Targets',
        },
        height: 400,
        width: '90%',
        legend: {
            position: 'bottom',
        },
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_existing_material'));
    chart.draw(data, options);
}


$(document).ready(function() {
    let analyticsResponse;
    loadGraph();
    drawNewUserChart();
    drawExistingUserChart();
});
</script>