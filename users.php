<?php include("login.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>plexWatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- css -->
    <link href="css/plexwatch.css" rel="stylesheet">
	<link href="css/plexwatch-tables.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet" >
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    

    <!-- touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/icon_iphone.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icon_ipad.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icon_iphone@2x.png">
	<link rel="apple-touch-icon" sizes="144x144" href="images/icon_ipad@2x.png">
  </head>

  <body>

  
  
	<div class="container">
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<a href="index.php"><div class="logo hidden-phone"></div></a>
				<ul class="nav">
					
                    <li><a href="index.php"><i class="icon-2x icon-home icon-white" data-toggle="tooltip" data-placement="bottom" title="Home" id="home"></i></a></li>
                    <li><a href="history.php"><i class="icon-2x icon-calendar icon-white" data-toggle="tooltip" data-placement="bottom" title="History" id="history"></i></a></li>
                    <li><a href="stats.php"><i class="icon-2x icon-tasks icon-white" data-toggle="tooltip" data-placement="bottom" title="PLEX Stats" id="stats"></i></a></li>
                    <li class="active"><a href="users.php"><i class="icon-2x icon-group icon-white" data-toggle="tooltip" data-placement="bottom" title="Users" id="users"></i></a></li>
                    <li><a href="charts.php"><i class="icon-2x icon-bar-chart icon-white" data-toggle="tooltip" data-placement="bottom" title="Charts" id="charts"></i></a></li>
                    <li><a href="sysinfo.php"><i class="icon-2x icon-hdd icon-white" data-toggle="tooltip" data-placement="bottom" title="System Info" id="sysinfo"></i></a></li>
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
						<h2><i class="icon-large icon-group icon-white"></i> Users</h2>
					</div>
				</div>

				<?php
						$guisettingsFile = "config/config.php";
						
						if (file_exists($guisettingsFile)) { 
							require_once(dirname(__FILE__) . '/config/config.php');
						}else{
							header("Location: settings.php");
						}
							
						$plexWatchPmsUrl = "http://".$plexWatch['pmsIp'].":".$plexWatch['pmsHttpPort']."";	
						
						if (!empty($plexWatch['myPlexAuthToken'])) {
								$myPlexAuthToken = $plexWatch['myPlexAuthToken'];
								
							}else{
								$myPlexAuthToken = '';
								
						}
						
							
						date_default_timezone_set(@date_default_timezone_get());

						$db = dbconnect();
						
						if ($plexWatch['userHistoryGrouping'] == "yes") {
							$plexWatchDbTable = "grouped";
						}else if ($plexWatch['userHistoryGrouping'] == "no") {
							$plexWatchDbTable = "processed";
						}
						
						$users = $db->query("SELECT COUNT(title) as plays, user, time, SUM(time) as timeTotal, SUM(stopped) as stoppedTotal, SUM(paused_counter) as paused_counterTotal, platform, ip_address, xml FROM ".$plexWatchDbTable." GROUP BY user ORDER BY user COLLATE NOCASE") or die ("Failed to access plexWatch database. Please check your settings.");
					
							
							echo "<div class='wellbg'>";
							
							echo "<table id='usersTable' class='display'>";
								echo "<thead>";
									echo "<tr>";
										echo "<th align='right'></th>";
										echo "<th align='left'>User </th>";
										echo "<th align='left'>Last Seen </th>";
										echo "<th align='left'>Last Known IP </th>";
										echo "<th align='left'>Total Plays</th>";
										
									echo "</tr>";
								echo "</thead>";
								echo "<tbody>";
							
								// Run through each feed item
								while ($user = $users->fetchArray()) {
							
									$userXml = simplexml_load_string($user['xml']) ;                         

										echo "<tr>";
											echo "<td align='right' width='40px'>";
												if (empty($userXml->User['thumb'])) {				
													echo "<div class='users-poster-face'><a href='user.php?user=".$user['user']."'><img src='data:image/png;base64,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' /></a></div>";			
												}else{
													echo "<div class='users-poster-face'><a href='user.php?user=".$user['user']."'><img src='".$userXml->User['thumb']."' onerror=\"this.src='data:image/png;base64,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'\" /></a></div>";
												}
											echo "</td>";
											echo "<td>";
												echo "<div class='users-name'><a href='user.php?user=".$user['user']."'> ".FriendlyName($user['user'],$user['platform'])."</a> </div>";
											echo "</td>";
														
											require_once(dirname(__FILE__) . '/includes/timeago.php');
											$lastSeenTime = $user['time'];

											echo "<td>".TimeAgo($lastSeenTime)."</td>";
														
											echo "<td>".$user['ip_address']."</td>";
													
											echo "<td>".$user['plays']."</td>";
					
											
																		
										echo "</tr>";   
												
								}
								
								echo "</tbody>";
								echo "</table>";
						
					
					?>
						</div>
				
			</div>
		</div><!--/.fluid-row-->			
			
			

		<footer>
		
		</footer>
		
    </div><!--/.fluid-container-->
    
    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.0.3.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.dataTables.js"></script>
	<script src="js/jquery.dataTables.plugin.bootstrap_pagination.js"></script>
	<script>
		$(document).ready(function() {
			var oTable = $('#usersTable').dataTable( {
				"bPaginate": false,
				"bLengthChange": true,
				"bFilter": false,
				"bSort": true,
				"bInfo": true,
				"bAutoWidth": true,
				"aaSorting": [[ 0, "asc" ]],
				"bStateSave": false,
				"bSortClasses": true,
				"sPaginationType": "bootstrap"	
			} );
		} );
	</script>
	
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
