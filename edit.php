<?php include("login.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>plexWatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="css/plexwatch.css" rel="stylesheet">
	<link href="css/plexwatch-tables.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet" >
	<link href="css/xcharts.css" rel="stylesheet" >
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
                    <li><a href="users.php"><i class="icon-2x icon-group icon-white" data-toggle="tooltip" data-placement="bottom" title="Users" id="users"></i></a></li>
                    <li><a href="charts.php"><i class="icon-2x icon-bar-chart icon-white" data-toggle="tooltip" data-placement="bottom" title="Charts" id="charts"></i></a></li>
                    <li><a href="sysinfo.php"><i class="icon-2x icon-hdd icon-white" data-toggle="tooltip" data-placement="bottom" title="System Info" id="sysinfo"></i></a></li>
                    <li class="active"><a href="edit.php"><i class="icon-2x icon-bug icon-white" data-toggle="tooltip" data-placement="bottom" title="Debug SQL" id="editsql"></i></a></li>
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
						<h2><i class="icon-large icon-bug icon-white"></i> Edit SQL</h2>
					</div>
				</div>

			</div>
		</div>
	</div>

	<?php
	date_default_timezone_set(@date_default_timezone_get());
	
	echo "<div class='container-fluid'>";
		echo "<div class='row-fluid'>";
			echo "<div class='span12'>";
				echo "<div class='wellbg'>";		
					
					$guisettingsFile = "config/config.php";
					if (file_exists($guisettingsFile)) { 
						require_once(dirname(__FILE__) . '/config/config.php');
					}else{
						header("Location: settings.php");
					}

					if ($plexWatch['https'] == 'yes') {
						$plexWatchPmsUrl = "https://".$plexWatch['pmsIp'].":".$plexWatch['pmsHttpsPort']."";
					}else if ($plexWatch['https'] == 'no') {
						$plexWatchPmsUrl = "http://".$plexWatch['pmsIp'].":".$plexWatch['pmsHttpPort']."";
					}
					
					if (!empty($plexWatch['myPlexAuthToken'])) {
						$myPlexAuthToken = $plexWatch['myPlexAuthToken'];
						
					}else{
						$myPlexAuthToken = '';
						
					}
										
					$db = dbconnect();

					if ($plexWatch['globalHistoryGrouping'] == "yes") {
						$plexWatchDbTable = "grouped";
						$numRows = $db->querySingle("SELECT COUNT(*) as count FROM $plexWatchDbTable ");
						$results = $db->query("SELECT id, title, user, platform, time, stopped, ip_address, xml, paused_counter, strftime('%Y%m%d', datetime(time, 'unixepoch', 'localtime')) as date FROM processed WHERE stopped IS NULL UNION ALL SELECT title, user, platform, time, stopped, ip_address, xml, paused_counter, strftime('%Y%m%d', datetime(time, 'unixepoch', 'localtime')) as date FROM $plexWatchDbTable ORDER BY time DESC") or die ("Failed to access plexWatch database. Please check your settings.");
						
					}else if ($plexWatch['globalHistoryGrouping'] == "no") {
						$plexWatchDbTable = "processed";
					
						$numRows = $db->querySingle("SELECT COUNT(*) as count FROM $plexWatchDbTable ");
						$results = $db->query("SELECT id, title, user, platform, time, stopped, ip_address, xml, paused_counter, strftime('%Y%m%d', datetime(time, 'unixepoch', 'localtime')) as date FROM $plexWatchDbTable ORDER BY time DESC") or die ("Failed to access plexWatch database. Please check settings.");
					}	
						
					if ($numRows < 1) {

					echo "No Results.";

					} else {
					echo "<table id='globalHistory' class='display'>";
						echo "<thead>";
							echo "<tr>";
								echo "<th align='left'><i class='icon-sort icon-white'></i> Date</th>";
								echo "<th align='left'><i class='icon-sort icon-white'></i> User </th>";
								echo "<th align='left'><i class='icon-sort icon-white'></i> IP Address</th>";
								echo "<th align='left'><i class='icon-sort icon-white'></i> Title</th>";
								echo "<th align='center'><i class='icon-sort icon-white'></i> Started</th>";
								echo "<th align='center'><i class='icon-sort icon-white'></i> Paused</th>";
								echo "<th align='center'><i class='icon-sort icon-white'></i> Stopped</th>";
								echo "<th align='center'><i class='icon-sort icon-white'></i> Duration</th>";
								echo "<th align='center'><i class='icon-sort icon-white'></i> Completed</th>";
								echo "<th align='center'><i class='icon-sort icon-white'></i> Delete</th>";
								echo "<th align='center'></th>";
							echo "</tr>";
						echo "</thead>";
						echo "<tbody>";

						$rowCount = 0;
						while ($row = $results->fetchArray()) {
						
						$rowCount++;
						echo "<tr>";
							if (empty($row['stopped'])) {
								echo "<td data-order='".$row['date']."' class='currentlyWatching' align='left'>Currently watching...</td>";
							}else{
									echo "<td data-order='".$row['date']."' align='left'>".date('m/d/Y',$row['time'])."</td>";
							}
							echo "<td align='left'><a href='#'>".FriendlyName($row['user'],$row['platform'])."</td>";

							$xml = simplexml_load_string($row['xml']); 

							if (empty($row['ip_address'])) {
								echo "<td align='left'>n/a</td>";

							}else{

								echo "<td align='left'>".$row['ip_address']."</td>";
							}
							$request_url = $row['xml'];
							$xmlfield = simplexml_load_string($request_url) ; 
							$ratingKey = $xmlfield['ratingKey'];
							$type = $xmlfield['type'];
							$duration = $xmlfield['duration'];
							$viewOffset = $xmlfield['viewOffset'];
							

							if ($type=="movie") {
								echo "<td class='title' align='left'><a href='#'>".$row['title']."</a></td>";
							}else if ($type=="episode") {
								echo "<td class='title' align='left'><a href='#'>".$row['title']."</a></td>";
							}else if (!array_key_exists('',$type)) {
								echo "<td class='title' align='left'><a href='".$ratingKey."'>".$row['title']."</a></td>";
							}else{
							}
							?>
							
							<?php
							echo "<td align='center'>".date('H:i',$row['time'])."</td>";
							
							$paused_duration = round(abs($row['paused_counter']) / 60,1);
							echo "<td align='center'>".$paused_duration." min</td>";
							
							$stopped_time = date('H:i',$row['stopped']);
							
							if (empty($row['stopped'])) {								
								echo "<td align='center'>n/a</td>";
							}else{
								echo "<td align='center'>".$stopped_time."</td>";
							}

							$to_time = strtotime(date("m/d/Y g:i a",$row['stopped']));
							$from_time = strtotime(date("m/d/Y g:i a",$row['time']));
							$paused_time = strtotime(date("m/d/Y g:i a",$row['paused_counter']));
							
							$viewed_time = round(abs($to_time - $from_time - $paused_time) / 60,0);
							$viewed_time_length = strlen($viewed_time);
							
							if ($viewed_time_length == 8) {
								echo "<td align='center'>n/a</td>";
							}else{
								echo "<td align='center'>".$viewed_time. " min</td>";
							}
							
							$percentComplete = ($duration == 0 ? 0 : sprintf("%2d", ($viewOffset / $duration) * 100));
								if ($percentComplete >= 90) {	
								  $percentComplete = 100;    
								}

							echo "<td align='center'><span class='badge badge-warning'>".$percentComplete."%</span></td>";
							echo "<td align='center'><a class='deleteDbItem' href='#deleteDbItem".$row['id']."' data-id='".$row['id']."'data-toggle='modal'><span class='badge badge-inverse'><i class='icon-remove icon-white'></i></span></a></td>";
							
						echo "</tr>";  
						}
					}
						echo "</tbody>";
						
					echo "</table>";

					?>
				</div>
			</div>
		</div>
	</div>	

		<footer>
		
		</footer>	
    
    
    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.0.3.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/jquery.dataTables.js"></script>
	<script src="js/jquery.dataTables.plugin.bootstrap_pagination.js"></script>
	<script src="js/jquery.dataTables.plugin.date_sorting.js"></script>
	<script src="js/d3.v3.js"></script> 
	
		<script type="text/javascript">
		$( document ).ready(function() {
			$( ".deleteDbItem" ).click(function() {
			console.log($(this).data('id'));
			$.ajax({
			  method: "POST",
			  url: "deleteStuff.php",
			  data: {id: $(this).data('id')}
			})
		  .done(function( msg ) {
			alert( "Data from Row: " + msg + " sucsessfully deleted!" );
		  });
		  });
	  });
	</script>
	
	
	<script type="text/javascript">
		$(document).ready(function() {
			$('#globalHistory').dataTable( {
				"bPaginate": true,
				"bLengthChange": true,
				"iDisplayLength": 25,
				"bFilter": true,
				"bSort": true,
				"bInfo": true,
				"bAutoWidth": true,	
				"aaSorting": [[ 0, "desc" ]],			
				"bStateSave": false,
				"bSortClasses": false,
				"sPaginationType": "bootstrap",
				"aoColumns": [
				{"sSortDataType": "dom-data-order", "sType": "numeric"},
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				null,
				null
				]		
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