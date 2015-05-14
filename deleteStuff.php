<?php include("login.php"); ?>

<?php
echo $_POST['id'];
	
	date_default_timezone_set(@date_default_timezone_get());

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

$id = (int) $_POST['id'];
if( $id > 0 ) {
    $db->query("DELETE FROM processed WHERE id=".$_POST['id']);
}

?>
