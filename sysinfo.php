<?php include("login.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>plexWatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/plexwatchSYS.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
		
	<link href="css/sysinfo/style.css" rel="stylesheet" type="text/css">
    <link href="css/sysinfo/dashboard.css" rel="stylesheet" type="text/css">
    <link href="css/sysinfo/odometer.css" rel="stylesheet" type="text/css">
	
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

<body>

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
                    <!--Begin of Content-->
					

					
<!--
					<iframe src="http://192.168.1.22/info/" style="border:0px #FFFFFF none;" name="SysINFO" scrolling="no" frameborder="1" align="center" marginheight="0px" marginwidth="0px" height="1290" width="1290"></iframe>
-->
				
                   <div class="subnavbar">
                        <div class="subnavbar-inner">

                            <a class="btn btn-navbar btn-info visible-phone" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </a>

                            <div class="container nav-collapse">

                                <ul class="mainnav">
                                    <li><a class="js-smoothscroll" href="#refresh-os"><i class="icon-dashboard"></i><span>General</span></a></li>
                                    <li><a class="js-smoothscroll" href="#refresh-df"><i class="icon-list-alt"></i><span>Disk</span></a></li>
                                    <li><a class="js-smoothscroll" href="#refresh-ps"><i class="icon-list-alt"></i><span>CPU</span></a></li>
                                    <li><a class="js-smoothscroll" href="#refresh-ram"><i class="icon-list-alt"></i><span>RAM</span></a></li>
                                    <li><a class="js-smoothscroll" href="#refresh-users"><i class="icon-group"></i><span>Users</span></a></li>
                                    <li><a class="js-smoothscroll" href="#refresh-ispeed"><i class="icon-exchange"></i><span>Network</span></a></li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i id="closed-widget-count">0</i>
                                            <span> Closed Widgets <i class="icon-caret-down"></i></span>
                                        </a>
                                        <ul class="dropdown-menu" id="closed-widget-list">
                                            <li id="close-all-widgets">
                                                <a> <i class="icon-remove lead pull-left"></i> Close All Widgets</a>
                                            </li>
                                            <li id="open-all-widgets">
                                                <a> <i class="icon-plus lead pull-left"></i> Open All Widgets</a>
                                            </li>
                                            <li class="">
                                                <hr>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i id="phpinfo-widget-what" class="icon-info-sign"></i>
                                            <span>PHPInfo <i class="icon-caret-down"></i></span></a>
											
                                        <ul class="dropdown-menu" id="phpinfo-widget-opt">
                                            <li><a href="modules/phpinfo.php?what=-1" target="_blank"><i class="icon-info"></i> - INFO_ALL</a></li>
                                            <li><a href="modules/phpinfo.php?what=1" target="_blank"><i class="icon-info"></i> - INFO_GENERAL</a></li>
                                            <li><a href="modules/phpinfo.php?what=4" target="_blank"><i class="icon-info"></i> - INFO_CONFIGURATION</a></li>
                                            <li><a href="modules/phpinfo.php?what=8" target="_blank"><i class="icon-info"></i> - INFO_MODULES</a></li>
                                            <li><a href="modules/phpinfo.php?what=16" target="_blank"><i class="icon-info"></i> - INFO_ENVIRONMENT</a></li>
                                            <li><a href="modules/phpinfo.php?what=32" target="_blank"><i class="icon-info"></i> - INFO_VARIABLES</a></li>
                                            <li><a href="modules/phpinfo.php?what=2" target="_blank"><i class="icon-info"></i> - INFO_CREDITS</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="main">
                        <div class="main-inner">
                            <div class="container">
                                <div class="lead" style="text-align: center;">
                                    <div class="btn icon-refresh js-refresh-info" data-title="Refresh all widgets!" data-toggle="tooltip" id="refresh-all"></div>
                                    <div>PlexWatch Server Details:</div>
                                </div>
                                <div id="widgets">
                                    <div class="span3">
                                        <div id="general-info-widget" class="widget widget-table action-table">
                                            <div class="widget-header">
                                                <i class="icon-info-sign"></i>
                                                <h3>General Info</h3>
                                                <div id="refresh-os" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">
                                                <div class="general-info-item">
                                                    <span class="general-title">OS</span>
                                                    <span class="general-data" id="os-info"></span>
                                                </div>
                                                <div class="general-info-item">
                                                    <span class="general-title">Uptime</span>
                                                    <span id="os-uptime"></span>
                                                </div>
                                                <div class="general-info-item">
                                                    <span class="general-title">Server Time</span>
                                                    <span id="os-time"></span>
                                                </div>
                                                <div class="general-info-item">
                                                    <span class="general-title">Hostname</span>
                                                    <span id="os-hostname"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span4">
                                        <div id="load-average-widget" class="widget">
                                            <div class="widget-header">
                                                <i class="icon-laptop"></i>
                                                <h3>Load average</h3>
                                                <div id="refresh-cpu" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">
                                                <div style="text-align:center;">
                                                    <b>Number of cores:</b> <span class="lead" id="core-number">0</span>
                                                </div>
                                                <div class="cf big_stats">
                                                    <div class="stat">
                                                        <i class="icon-#">1 min&nbsp;</i> <span class="value odometer" id="cpu-1min-per"></span> %
                                                        <br>
                                                        <span class="value" id="cpu-1min"></span>
                                                    </div>
                                                    <div class="stat">
                                                        <i class="icon-#">5 min&nbsp;</i> <span class="value odometer" id="cpu-5min-per"></span> %
                                                        <br>
                                                        <span class="value" id="cpu-5min"></span>
                                                    </div>
                                                    <div class="stat">
                                                        <i class="icon-#">15 min&nbsp;</i> <span class="value odometer" id="cpu-15min-per"></span> %
                                                        <br>
                                                        <span class="value" id="cpu-15min"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span5">
                                        <div id="ram-widget" class="widget widget-nopad">
                                            <div class="widget-header">
                                                <i class="icon-list-alt"></i>
                                                <h3>RAM</h3>
                                                <div id="refresh-ram" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">
                                                <div class="big-stats-container">
                                                    <div class="widget-content">
                                                        <div class="cf big_stats">
                                                            <div class="stat">
                                                                <i class="icon-#">Total&nbsp;</i> <span class="value odometer" id="ram-total"></span> MB
                                                            </div>
                                                            <div class="stat">
                                                                <i class="icon-#">Used&nbsp;</i> <span class="value odometer" id="ram-used"></span> MB
                                                                <br>
                                                                <span class="value odometer" id="ram-used-per"></span> %
                                                            </div>
                                                            <div class="stat">
                                                                <i class="icon-#">Free&nbsp;</i> <span class="value odometer" id="ram-free"></span> MB
                                                                <br>
                                                                <span class="value odometer" id="ram-free-per"></span> %
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span6">
                                        <div id="disk-usage-widget" class="widget widget-table">
                                            <div class="widget-header">
                                                <i class="icon-list"></i>
                                                <h3>Disk Usage</h3>
                                                <div id="refresh-df" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">
                                                <table id="df_dashboard" class="table table-hover table-condensed table-bordered"></table>
                                            </div>
                                        </div>
                                    </div>
									
                                    <div class="span6">
                                        <div id="software-widget" class="widget widget-table">
                                            <div class="widget-header">
                                                <i class="icon-list"></i>
                                                <h3>Software</h3>
                                                <div id="refresh-whereis" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">
                                                <table id="whereis_dashboard" class="table table-hover table-condensed table-bordered"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
									<!-- 
                                    <div class="span6">
                                        <div id="dns-lease-widget" class="widget widget-table">
                                            <div class="widget-header">
                                                <i class="icon-list"></i>
                                                <h3>DHCP Leases</h3>
                                                <div id="refresh-dnsmasqleases" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">
                                                <table id="dnsmasqleases_dashboard" class="table table-hover table-condensed table-bordered"></table>
                                            </div>
                                        </div>
                                    </div>
									-->
                                    <div class="span3">
                                        <div id="ip-widget" class="widget widget-table">
                                            <div class="widget-header">
                                                <i class="icon-monitor"></i>
                                                <h3>IP</h3>
                                                <div id="refresh-ip" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">
                                                <table id="ip_dashboard" class="table table-hover table-condensed table-bordered"></table>
                                            </div>
                                        </div>
                                    </div>
									
                                    <div class="span3">
                                        <div id="internet-speed-widget" class="widget widget-table">
                                            <div class="widget-header">
                                                <i class="icon-monitor"></i>
                                                <h3>Internet Speed</h3>
                                                <div id="refresh-ispeed" class="btn js-refresh-info"><span class="icon-refresh"></span>
                                                </div>
                                            </div>
                                            <div class="widget-content">
                                                <div style="padding:0px; text-align: center;">
                                                    <i class="icon-download" style="font-size:18px;"></i>
                                                    <span class="lead value odometer" style="margin-top:11px;" id="ispeed-rate-downstream">0</span>
                                                    <span class="lead">Mbps</span>
                                                </div>
                                                <div style="padding:0px; text-align: center;">
                                                    <i class="icon-upload" style="font-size:18px;"></i>
                                                    <span class="lead value odometer" style="margin-top:11px;" id="ispeed-rate-upstream">0</span>
                                                    <span class="lead">Mbps</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span4">
                                        <div id="netstat-widget" class="widget widget-table">
                                            <div class="widget-header">
                                                <i class="icon-dashboard"></i>
                                                <h3>Network Statistics</h3>
                                                <div id="refresh-netstat" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">
                                                <table id="netstat_dashboard" class="table table-hover table-condensed table-bordered"></table>
                                            </div>
                                        </div>
                                    </div>
									
                                    <div class="span4">
                                        <div id="ping-widget" class="widget widget-table">
                                            <div class="widget-header">
                                                <i class="icon-exchange"></i>
                                                <h3>Ping</h3>
                                                <div id="refresh-ping" class="btn js-refresh-info"><span class="icon-refresh"></span>
                                                </div>
                                            </div>
                                            <div class="widget-content">
                                                <table id="ping_dashboard" class="table table-hover table-condensed table-bordered"></table>
                                            </div>
                                        </div>
                                    </div>
									
                                    <div class="span4">
                                        <div id="bandwidth-widget" class="widget widget-table">
                                            <div class="widget-header">
                                                <i class="icon-exchange"></i>
                                                <h3>Bandwidth</h3>
                                                <div id="refresh-bandwidth" class="btn js-refresh-info"><span class="icon-refresh"></span>
                                                </div>
                                            </div>
                                            <div class="widget-content">
                                                <div style="padding:10px;text-align:center;">
                                                    <i style="color:#F9AA03; font:20px/2em 'Open Sans',sans-serif;" class="icon-#" id="bw-int">eth0:</i>&nbsp; RX: <span class="lead odometer" style="margin-top:11px;" id="bw-rx">0</span>&nbsp;&nbsp;|&nbsp;&nbsp; TX: <span class="lead odometer" style="margin-top:11px;" id="bw-tx"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span4">
                                        <div id="users-widget" class="widget widget-table action-table">
                                            <div class="widget-header">
                                                <i class="icon-group"></i>
                                                <h3>Users</h3>
                                                <div id="refresh-users" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">
                                                <table id="users_dashboard" class="table table-hover table-bordered table-condensed"></table>
                                            </div>
                                        </div>
                                    </div>
									
                                    <div class="span4">
                                        <div id="online-widget" class="widget widget-table action-table">
                                            <div class="widget-header">
                                                <i class="icon-group"></i>
                                                <h3>Online</h3>
                                                <div id="refresh-online" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">
                                                <table id="online_dashboard" class="table table-hover table-bordered table-condensed"></table>
                                            </div>
                                        </div>
                                    </div>
									
                                    <div class="span4">
                                        <div id="lastlog-widget" class="widget widget-table action-table">
                                            <div class="widget-header">
                                                <i class="icon-group"></i>
                                                <h3>Last Login</h3>
                                                <div id="refresh-lastlog" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">
                                                <table id="lastlog_dashboard" class="table table-hover table-bordered table-condensed"></table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="span12">
                                        <div id="process-widget" class="widget widget-table">
                                            <div class="widget-header">
                                                <i class="icon-dashboard"></i>
                                                <h3>Processes</h3>
                                                <div id="refresh-ps" class="btn icon-refresh js-refresh-info"></div>
                                                <div class="pull-right">
                                                    <input type="text" id="filter-ps" class="widget-search" placeholder="search...">
                                                </div>
                                            </div>
                                            <div class="widget-content">
                                                <table id="ps_dashboard" class="table table-hover table-condensed table-bordered"></table>
                                            </div>
                                        </div>
                                    </div>
									<!--  
                                    <div class="span3">
                                        <div id="sabnzbd-widget" class="widget widget-table">
                                            <div class="widget-header">
                                                <i class="icon-monitor"></i>
                                                <h3>SABnzbd Speed</h3>
                                                <div id="refresh-sabspeed" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">

                                                <div style="padding:0px; text-align: center;">
                                                    <i class="icon-download" style="font-size:18px;"></i>
                                                    <span class="lead value odometer" style="margin-top:11px;" id="sabspeed-rate-downstream">0</span>
                                                    <span class="lead">Mbps</span>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
									-->
                                    <div class="span9">
                                        <div id="swap-widget" class="widget widget-table">
                                            <div class="widget-header">
                                                <i class="icon-dashboard"></i>
                                                <h3>Swap Usage</h3>
                                                <div id="refresh-swap" class="btn icon-refresh js-refresh-info"></div>
                                            </div>
                                            <div class="widget-content">
                                                <table id="swap_dashboard" class="table table-hover table-condensed table-bordered"></table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <!--End of Content-->
                </div>
            </div>
        </div>
    </div>

    <footer>
	<!--  
        <div class="footer-inner">
            <div class="container">
                <div class="row">
                     <div class="span12">
                      Original Author: <a href="http://github.com/afaqurk">Afaq Tariq</a>.
                     </div>
                </div>
            </div>
        </div>
		-->
    </footer>


    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.0.3.js"></script>
    <script src="js/bootstrap.js"></script>
	
	<!-- New from Original	-->
    <script src="js/sysinfo/jquery.js" type="text/javascript"></script>
    <script src="js/sysinfo/jquery-ui.min.js" type="text/javascript"></script>
    <script src="js/sysinfo/bootstrap.js" type="text/javascript"></script>
    <script src="js/sysinfo/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="js/sysinfo/odometer.js" type="text/javascript"></script>
    <script src="js/sysinfo/dashboard.js" type="text/javascript"></script>
    <script src="js/sysinfo/base.js" type="text/javascript"></script>


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