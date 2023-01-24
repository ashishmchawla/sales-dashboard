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
			<h3 class="m-0" >Hello, <?php echo $_SESSION['name']; ?> </h3>
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
			<div class="row">
				<div class="col-md-6">
					<div class="analytics-row row">
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Deposits Today</div>
								<div class="analytics-value" id="depositsToday"></div>
							</div>
						</div>
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Total Deposits</div>
								<div class="analytics-value" id="totalDeposit"></div>
							</div>
						</div>
					</div>
					<div class="analytics-row row">
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Commissions Today</div>
								<div class="analytics-value" id="commissionToday"></div>
							</div>
						</div>
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Total Commissions</div>
								<div class="analytics-value" id="totalCommission"></div>
							</div>
						</div>
					</div>
					<div class="analytics-row row">
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Playing Today</div>
								<div class="analytics-value" id="playingToday"></div>
							</div>
						</div>

						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Total Playing Users</div>
								<div class="analytics-value" id="totalPlayingUsers"></div>
							</div>
						</div>
					</div>
					<div class="analytics-row row">
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Paid Users Today</div>
								<div class="analytics-value" id="playingTodayPaid"></div>
							</div>
						</div>
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">New Counter</div>
								<div class="analytics-value">Coming Soon</div>
							</div>
						</div>
					</div>
					<div class="analytics-row row">
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Users Added</div>
								<div class="analytics-value" id="newAddedUsers"></div>
							</div>
						</div>
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Total Users</div>
								<div class="analytics-value" id="totalUsers"></div>
							</div>
						</div>
					</div>
					<div class="analytics-row row">
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Real Cash Today</div>
								<div class="analytics-value" id="real_cash_amt"></div>
							</div>
						</div>
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Cash Bonus Today</div>
								<div class="analytics-value" id="cash_bonus_amt"></div>
							</div>
						</div>
					</div>
					<div class="analytics-row row">
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Total App Downloads</div>
								<div class="analytics-value" id="appDownloads"></div>
							</div>
						</div>
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Active Matches</div>
								<div class="analytics-value" id="activeMatches"></div>
							</div>
						</div>
					</div>
					<div class="analytics-row row">
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Active Public Leagues</div>
								<div class="analytics-value" id="activePublicContests"></div>
							</div>
						</div>
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Today's Public Leagues</div>
								<div class="analytics-value" id="todayPublicContests"></div>
							</div>
						</div>
					</div>
					<div class="analytics-row row">
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Active Private Leagues</div>
								<div class="analytics-value" id="activePrivateContests"></div>
							</div>
						</div>
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Today's Private Leagues</div>
								<div class="analytics-value" id="todayPrivateContests"></div>
							</div>
						</div>
					</div>
					<div class="analytics-row row">
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Active Zero Leagues Today</div>
								<div class="analytics-value" id="activeZeroLeagues"></div>
							</div>
						</div>
						<div class="col-md-6 analytics-block">
							<div class="analytics-block-inner">
								<div class="analytics-title">Filled Zero Leagues Today</div>
								<div class="analytics-value" id="zeroLeaguesFilled"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div id="commission_chart_area"></div>
					<br>
					<div class="card">
					<h4 class="card-header">Quick Links </h4>
						<div class="card-body">
							<ul class="fa-ul">
								<li><i class="fa-li fa fa-table"></i><a href="../stats/match_stats.php" >Daily Match Stats</a></li>
								<li><i class="fa-li fa fa-credit-card"></i><a href="../withdrawals/listing.php">Recent Withdrawals</a> <span class="badge badge-primary">New </span> </li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</div>
	<?php
	include '../includes/footer.php';
}
?>
<script>
	google.charts.load('current', {packages: ['corechart', 'bar']});
	google.charts.setOnLoadCallback();

	function loadGraph() {
		$.ajax({
			url: baseUrl+"/admin/cashflowGraph",
			headers: {
				'Authorization': "Bearer "+token
			},
		}).done(function(response) {
			drawCashFlowGraph(response, 'Weekly Cash Flow');
		});
	}

	function loadCommissionGraph() {
		$.ajax({
			url: baseUrl+"/admin/commissionGraph",
			headers: {
				'Authorization': "Bearer "+token
			},
		}).done(function(response) {
			drawCommissionGraph(response, 'Weekly Commissions');
		});
	}

	function loadUsersGraph() {
		$.ajax({
			url: baseUrl+"/admin/userGraph",
			headers: {
				'Authorization': "Bearer "+token
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
		$.each(jsonData, function(i, element){
			var date = element.date;
			var deposits = parseFloat($.trim(element.deposits));
			var withdraw_request = parseFloat($.trim(element.withdraw_request));
			var withdraw_fulfilled = parseFloat($.trim(element.withdraw_fulfilled));
			data.addRows([[date, deposits, withdraw_request, withdraw_fulfilled ]]);
		});
		var options = {
			title:title,
			hAxis: {
				title: "Dates",
				direction:-1,
				slantedText:true,
				slantedTextAngle:45,
			},
			vAxis: {
				title: 'CashFlow'
			},
			height: 300,
			legend: { position: 'top', maxLines: 3 },
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
		$.each(jsonData, function(i, element){
			var name = element.name;
			var earned = parseFloat($.trim(element.earned));
			var distributed = parseFloat($.trim(element.distributed));
			data.addRows([[name, earned, distributed ]]);
		});
		var options = {
			title:title,
			hAxis: {
				title: "Matches",
				direction: -1,
				slantedText:true,
				slantedTextAngle:45,
			},
			vAxis: {
				title: 'Commissions'
			},
			height: 300,
			legend: { position: 'top', maxLines: 3 },
		};

		var chart = new google.visualization.ColumnChart(document.getElementById('commission_chart_area'));
		chart.draw(data, options);
	}

	function drawUsersGraph(chart_data, title) {
		var jsonData = chart_data;
		var data = new google.visualization.arrayToDataTable(jsonData);
		var options = {
			title:title,
			hAxis: {
				title: "Dates",
				direction:-1,
				slantedText:true,
				slantedTextAngle:45,
			},
			vAxis: {
				title: 'Users'
			},
			height: 300,
			legend: { position: 'top', maxLines: 3 },
			seriesType: 'bars',
    		series: {1: {type: 'line', pointShape: 'circle', pointSize:5}}
		};

		var chart = new google.visualization.ComboChart(document.getElementById('users_chart'));
		chart.draw(data, options);
	}

	$(document).ready( function () {
		let analyticsResponse;
		$.ajax({
			url: baseUrl+"/index",
			headers: {
				'Authorization': "Bearer "+token
			},
		}).done(function(response) {
			analyticsResponse =  response;
			console.log(analyticsResponse);
			$("#dateToday").html(analyticsResponse.today);
			$("#matchesToday").html(analyticsResponse.matchCount.matchesToday);
			$("#activeMatches").html(analyticsResponse.matchCount.activeMatches);
			$("#totalUsers").html(analyticsResponse.usersCount.total);
			$("#newAddedUsers").html(analyticsResponse.usersCount.usersAddedToday);
			$("#playingToday").html(analyticsResponse.playingUsers.playingToday);
			$("#totalPlayingUsers").html(analyticsResponse.playingUsers.totalPlayingUsers);
			$("#activePublicContests").html(analyticsResponse.publicContests.activePublicContests);
			$("#todayPublicContests").html(analyticsResponse.publicContests.todayPublicContests);
			$("#activePrivateContests").html(analyticsResponse.privateContests.activePrivateContests);
			$("#todayPrivateContests").html(analyticsResponse.privateContests.todayPrivateContests);
			$('#activeZeroLeagues').html(analyticsResponse.zero_leagues.today);
			$('#zeroLeaguesFilled').html(analyticsResponse.zero_leagues.filled);
			$('#real_cash_amt').html('₹ '+analyticsResponse.totals.totalAmt+' /-');
			$('#cash_bonus_amt').html('₹ '+analyticsResponse.totals.totalCB+' /-');
			if( analyticsResponse.deposit.depositToday !== null ) {
				$('#depositsToday').html('₹ '+analyticsResponse.deposit.depositToday+' /-');
			}
			else {
				$('#depositsToday').html('₹ 0.00 /-')
			}
			$('#playingTodayPaid').html(analyticsResponse.playingUsers.playingTodayPaid);
			$('#totalDeposit').html('₹ '+analyticsResponse.deposit.totalDeposit+' /-');
			if( analyticsResponse.commission.commissionToday !== null ) {
				$('#commissionToday').html('₹ '+analyticsResponse.commission.commissionToday+' /-');
			}
			else {
				$('#commissionToday').html('₹ 0.00 /-')
			}
			$('#totalCommission').html('₹ '+analyticsResponse.commission.totalCommission+' /-');
			$('#appDownloads').html(analyticsResponse.downloads.totalDownloads);
		});
		loadGraph();
		loadCommissionGraph();
		loadUsersGraph();
	});
</script>