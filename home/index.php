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
    <button class="btn btn-primary" id="refresh"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
            fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z" />
            <path
                d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z" />
        </svg> Refresh Stats
    </button>
</div>
<div class="analytics-wrapper container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div id="chart_area">
                <div id="columnchart"></div>
            </div>
        </div>
        <div class="col-md-6">
            <div id="chart_area">
                <div id="columnchart_numbers"></div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <h3> New Clients</h3>
            <div id="chart_area">
                <div id="columnchart_new"></div>
            </div>
        </div>
        <div class="col-md-6">
            <h3> Existing Clients</h3>
            <div id="chart_area">
                <div id="columnchart_existing"></div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <h3>Accounts</h3>
            <div id="chart_area">
                <div id="columnchart_account"></div>
            </div>
        </div>
        <div class="col-md-6">
            <h3>Margin</h3>
            <div id="chart_area">
                <div id="columnchart_margin"></div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-6">
            <h3> Mutual Funds</h3>
            <div id="chart_area">
                <div id="columnchart_mf"></div>
            </div>
        </div>
        <div class="col-md-6">
            <h3> Insurance</h3>
            <div id="chart_area">
                <div id="columnchart_insurance"></div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Option Brains</h3>
            <div id="chart_area">
                <div id="columnchart_thirdParty"></div>
            </div>
        </div>
        <div class="col-md-3"></div>
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
// google.charts.setOnLoadCallback(drawNewUserChart);
// google.charts.setOnLoadCallback(drawExistingUserChart);

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

async function loadNumberGraph() {
    await $.ajax({
        url: baseUrl + "/allServicesGraphNumbers",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        console.log(response);
        if (response.status == 1) {
            drawNumberChart(response.graphData, response.month);
        }
    });
}

async function loadNewGraph() {
    await $.ajax({
        url: baseUrl + "/getStatsByType/new",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        console.log(response);
        if (response.status == 1) {
            drawNewUserChart(response.graphData, 'New Lead Stats');
        }
    });
}

async function loadExistingGraph() {
    await $.ajax({
        url: baseUrl + "/getStatsByType/existing",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        console.log(response);
        if (response.status == 1) {
            drawExistingUserChart(response.graphData, 'Existing Lead Stats');
        }
    });
}

async function loadAccountsGraph() {
    await $.ajax({
        url: baseUrl + "/getStatsByType/account",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        console.log(response);
        if (response.status == 1) {
            drawAccountsChart(response.graphData, 'Account Stats');
        }
    });
}

async function loadMarginGraph() {
    await $.ajax({
        url: baseUrl + "/getStatsByType/margin",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        console.log(response);
        if (response.status == 1) {
            drawMarginChart(response.graphData, 'Existing Lead Stats');
        }
    });
}

async function loadMFChart() {
    await $.ajax({
        url: baseUrl + "/getStatsByType/mutual_funds",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        console.log(response);
        if (response.status == 1) {
            drawMFChart(response.graphData, 'Mutual Fund Stats');
        }
    });
}

async function loadInsuranceChart() {
    await $.ajax({
        url: baseUrl + "/getStatsByType/insurance",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        console.log(response);
        if (response.status == 1) {
            drawInsuranceChart(response.graphData, 'Insurance Stats');
        }
    });
}

async function loadThirdPartyChart() {
    await $.ajax({
        url: baseUrl + "/getStatsByType/option_brains",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        console.log(response);
        if (response.status == 1) {
            drawThirdPartyChart(response.graphData, 'Option brain Stats');
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

    var chart = new google.charts.Bar(document.getElementById('columnchart'));
    chart.draw(data, options);

    // var chart = new google.visualization.Bar(document.getElementById('columnchart'));
    // chart.draw(data, options);

}


function drawNumberChart(chart_data, title) {

    var data = google.visualization.arrayToDataTable(chart_data);

    var options = {
        chart: {
            title: 'Company Performance -' + title,
            subtitle: 'Amounts',
        },
        height: 400,
        width: '90%',
        legend: {
            position: 'bottom',
        },
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_numbers'));
    chart.draw(data, options);

    // var chart = new google.visualization.Bar(document.getElementById('columnchart'));
    // chart.draw(data, options);

}

function drawNewUserChart(chart_data, title) {

    var data = google.visualization.arrayToDataTable(chart_data);

    var options = {
        chart: {
            title: title
        },
        height: 400,
        width: '90%',
        legend: {
            position: 'bottom',
        },
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_new'));
    chart.draw(data, options);
}

function drawExistingUserChart(chart_data, title) {

    var data = google.visualization.arrayToDataTable(chart_data);

    var options = {
        chart: {
            title: title,
        },
        height: 400,
        width: '90%',
        legend: {
            position: 'bottom',
        },
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_existing'));
    chart.draw(data, options);
}

function drawAccountsChart(chart_data, title) {

    var data = google.visualization.arrayToDataTable(chart_data);

    var options = {
        chart: {
            title: title,
        },
        height: 400,
        width: '90%',
        legend: {
            position: 'bottom',
        },
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_account'));
    chart.draw(data, options);
}

function drawMarginChart(chart_data, title) {

    var data = google.visualization.arrayToDataTable(chart_data);

    var options = {
        chart: {
            title: title,
        },
        height: 400,
        width: '90%',
        legend: {
            position: 'bottom',
        },
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_margin'));
    chart.draw(data, options);
}

function drawMFChart(chart_data, title) {

    var data = google.visualization.arrayToDataTable(chart_data);

    var options = {
        chart: {
            title: title,
        },
        height: 400,
        width: '90%',
        legend: {
            position: 'bottom',
        },
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_mf'));
    chart.draw(data, options);
}

function drawInsuranceChart(chart_data, title) {

    var data = google.visualization.arrayToDataTable(chart_data);

    var options = {
        chart: {
            title: title,
        },
        height: 400,
        width: '90%',
        legend: {
            position: 'bottom'
        },
        hAxis: {
            direction: -1,
            slantedText: true,
            slantedTextAngle: 90
        }
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_insurance'));
    chart.draw(data, options);
}

function drawThirdPartyChart(chart_data, title) {

    var data = google.visualization.arrayToDataTable(chart_data);

    var options = {
        chart: {
            title: title,
        },
        height: 400,
        width: '90%',
        legend: {
            position: 'bottom',
        },
    };

    var chart = new google.charts.Bar(document.getElementById('columnchart_thirdParty'));
    chart.draw(data, options);
}

$(document).ready(function() {
    let analyticsResponse;
    loadGraph();
    loadNumberGraph();
    loadNewGraph();
    loadExistingGraph();
    loadAccountsGraph();
    loadMarginGraph();
    loadMFChart();
    loadInsuranceChart();
    loadThirdPartyChart();
});
$(document).click('#refresh', function() {
    $.ajax({
        url: baseUrl + "/updateStats",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        console.log(response);
        window.location.reload();
    });
})
</script>
<script type="text/javascript" src="https://www.google.com/jsapi?autoload= 
{'modules':[{'name':'visualization','version':'1.1','packages':
['corechart']}]}"></script>