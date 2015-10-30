<!DOCTYPE html>
<html lang="en" ng-app="plexwatchDash">
    <head>
		<title>plexWatch</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
		<link href="css/plexwatch.css" rel="stylesheet">
	    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" type="text/css" href="css/sysinfo/main.css">
		<link rel="stylesheet" type="text/css" href="css/sysinfo/plexDash.css">
		<link rel="stylesheet" type="text/css" href="css/sysinfo/animate.css">

		<!-- Angular Libs -->
		<script src="js/angular.min.js" type="text/javascript"></script>
		<script src="js/angular-route.js" type="text/javascript"></script>
		
	 	<style type="text/css">
			body {
				padding-top: 60px;
				padding-bottom: 40px;
			}
			.sidebar-nav {
				padding: 9px 0;
			}
		</style>	

		<link rel="shortcut icon" href="images/favicon.ico">
		<link rel="apple-touch-icon" href="images/icon_iphone.png">
		<link rel="apple-touch-icon" sizes="72x72" href="images/icon_ipad.png">
		<link rel="apple-touch-icon" sizes="114x114" href="images/icon_iphone@2x.png">
		<link rel="apple-touch-icon" sizes="144x144" href="images/icon_ipad@2x.png">
		<!--[if lt IE 9]>
			  <script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<![endif]-->
	</head>

<body ng-controller="body">

    <div class="container">

        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <a href="index.php">
                    <div class="logo hidden-phone"></div>
                </a>
                <ul class="nav">

                    <li><a href="index.php"><i class="icon-2x icon-home icon-white" data-toggle="tooltip" data-placement="bottom" title="Home" id="home"></i></a></li>
                    <li><a href="history.php"><i class="icon-2x icon-calendar icon-white" data-toggle="tooltip" data-placement="bottom" title="History" id="history"></i></a></li>
                    <li><a href="stats.php"><i class="icon-2x icon-tasks icon-white" data-toggle="tooltip" data-placement="bottom" title="PLEX Stats" id="stats"></i></a></li>
                    <li><a href="users.php"><i class="icon-2x icon-group icon-white" data-toggle="tooltip" data-placement="bottom" title="Users" id="users"></i></a></li>
                    <li><a href="charts.php"><i class="icon-2x icon-bar-chart icon-white" data-toggle="tooltip" data-placement="bottom" title="Charts" id="charts"></i></a></li>
                    <li class="active"><a href="sysinfo.php"><i class="icon-2x icon-hdd icon-white" data-toggle="tooltip" data-placement="bottom" title="System Info" id="sysinfo"></i></a></li>
                    <li><a href="edit.php"><i class="icon-2x icon-bug icon-white" data-toggle="tooltip" data-placement="bottom" title="Debug SQL" id="editsql"></i></a></li>
                    <li><a href="settings.php"><i class="icon-2x icon-wrench icon-white" data-toggle="tooltip" data-placement="bottom" title="PlexWatch Settings" id="settings"></i></a></li>
                    <li><a href="index.php?logout=1"><i class="icon-2x icon-power-off icon-white" data-toggle="tooltip" data-placement="bottom" title="Logout" id="logout"></i></a></li>

                </ul>
            </div>
        </div>
    </div>

    <div class="clear"></div>

    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">

                <div class='wellheader'>
                    <div class="dashboard-wellheader-no-chevron">
                        <h2><i class="icon-large icon-hdd icon-white"></i> System Info</h2>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class='container-fluid'>
        <div class='row-fluid'>
            <div class='span12'>
                <div class='wellbg'>
                    <!--Begin of plexwatchDash Content-->
					
						<div class="hero">
							<nav-bar></nav-bar>
						</div>
						
						<div ng-if="!serverSet">
							<h2>Setting server...</h2>
							<loader></loader>
						</div>

						<!-- Templates Get Rendered Here -->
						<div ng-if="serverSet" id="plugins" class="animated fadeInDown" ng-view></div>


                    <!--End of plexwatchDash Content-->
                </div>
            </div>
        </div>
    </div>


		<!-- javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="js/jquery-2.0.3.js"></script>
		<script src="js/bootstrap.js"></script>

		<script src="js/plexwatchDash.js" type="text/javascript"></script>
		<script src="js/modules.js" type="text/javascript"></script>
		<script src="js/smoothie.min.js" type="text/javascript"></script>

		<script>
			$(document).ready(function() {
				$('#home').tooltip();
			});
			$(document).ready(function() {
				$('#history').tooltip();
			});
			$(document).ready(function() {
				$('#users').tooltip();
			});
			$(document).ready(function() {
				$('#charts').tooltip();
			});
			$(document).ready(function() {
				$('#editsql').tooltip();
			});
			$(document).ready(function() {
				$('#settings').tooltip();
			});
			$(document).ready(function() {
				$('#sysinfo').tooltip();
			});
			$(document).ready(function() {
				$('#stats').tooltip();
			});
			$(document).ready(function() {
				$('#logout').tooltip();
			});
		</script>
	</body>

</html>