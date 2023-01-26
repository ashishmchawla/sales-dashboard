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
        <div class="col-md-6" style="margin-bottom: 10px;">
            <div id="users_chart"></div>
        </div>
        <div class="col-md-6">
            <div id="chart_area"></div>
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
    packages: ['corechart', 'bar']
});
google.charts.setOnLoadCallback();

function loadGraph() {
    $.ajax({
        url: baseUrl + "/admin/cashflowGraph",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        drawCashFlowGraph(response, 'Weekly Cash Flow');
    });
}

function loadCommissionGraph() {
    $.ajax({
        url: baseUrl + "/admin/commissionGraph",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        drawCommissionGraph(response, 'Weekly Commissions');
    });
}

function loadUsersGraph() {
    $.ajax({
        url: baseUrl + "/admin/userGraph",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        drawUsersGraph(response, 'Daily Users');
    });
}

function drawCashFlowGraph(chart_data, title) {
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Date');
    data.addColumn('number', 'Desposit');
    data.addColumn('number', 'Withdraw Request');
    data.addColumn('number', 'Withdraw Fulfilled');
    $.each(jsonData, function(i, element) {
        var date = element.date;
        var deposits = parseFloat($.trim(element.deposits));
        var withdraw_request = parseFloat($.trim(element.withdraw_request));
        var withdraw_fulfilled = parseFloat($.trim(element.withdraw_fulfilled));
        data.addRows([
            [date, deposits, withdraw_request, withdraw_fulfilled]
        ]);
    });
    var options = {
        title: title,
        hAxis: {
            title: "Dates",
            direction: -1,
            slantedText: true,
            slantedTextAngle: 45,
        },
        vAxis: {
            title: 'CashFlow'
        },
        height: 300,
        legend: {
            position: 'top',
            maxLines: 3
        },
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('chart_area'));
    chart.draw(data, options);
}

function drawCommissionGraph(chart_data, title) {
    var jsonData = chart_data;
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Match');
    data.addColumn('number', 'Earned');
    data.addColumn('number', 'Distributed');
    $.each(jsonData, function(i, element) {
        var name = element.name;
        var earned = parseFloat($.trim(element.earned));
        var distributed = parseFloat($.trim(element.distributed));
        data.addRows([
            [name, earned, distributed]
        ]);
    });
    var options = {
        title: title,
        hAxis: {
            title: "Matches",
            direction: -1,
            slantedText: true,
            slantedTextAngle: 45,
        },
        vAxis: {
            title: 'Commissions'
        },
        height: 300,
        legend: {
            position: 'top',
            maxLines: 3
        },
    };

    var chart = new google.visualization.ColumnChart(document.getElementById('commission_chart_area'));
    chart.draw(data, options);
}

function drawUsersGraph(chart_data, title) {
    var jsonData = chart_data;
    var data = new google.visualization.arrayToDataTable(jsonData);
    var options = {
        title: title,
        hAxis: {
            title: "Dates",
            direction: -1,
            slantedText: true,
            slantedTextAngle: 45,
        },
        vAxis: {
            title: 'Users'
        },
        height: 300,
        legend: {
            position: 'top',
            maxLines: 3
        },
        seriesType: 'bars',
        series: {
            1: {
                type: 'line',
                pointShape: 'circle',
                pointSize: 5
            }
        }
    };

    var chart = new google.visualization.ComboChart(document.getElementById('users_chart'));
    chart.draw(data, options);
}

$(document).ready(function() {
    let analyticsResponse;
    // loadGraph();
    // loadCommissionGraph();
    // loadUsersGraph();
});
</script>