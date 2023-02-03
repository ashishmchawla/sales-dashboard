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
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3> Third Party</h3>
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
        url: baseUrl + "/getStatsByType/third_party",
        headers: {
            'Authorization': "Bearer " + token
        },
    }).done(function(response) {
        console.log(response);
        if (response.status == 1) {
            drawThirdPartyChart(response.graphData, 'Third Party Stats');
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
            position: 'bottom',
        },
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
</script>
<script type="text/javascript" src="https://www.google.com/jsapi?autoload= 
{'modules':[{'name':'visualization','version':'1.1','packages':
['corechart']}]}"></script>