<?php include("login.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>plexWatch</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/plexwatch.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet" >

    <style type="text/css">
        body {
            padding-top: 60px;
            padding-bottom: 40px;
        }
        .sidebar-nav {
            padding: 9px 0;
        }
        .spinner {
            padding-bottom: 25px;
            position: relative;
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
					
                    <li class="active"><a href="index.php"><i class="icon-2x icon-home icon-white" data-toggle="tooltip" data-placement="bottom" title="Home" id="home"></i></a></li>
                    <li><a href="history.php"><i class="icon-2x icon-calendar icon-white" data-toggle="tooltip" data-placement="bottom" title="History" id="history"></i></a></li>
                    <li><a href="stats.php"><i class="icon-2x icon-tasks icon-white" data-toggle="tooltip" data-placement="bottom" title="PLEX Stats" id="stats"></i></a></li>
                    <li><a href="users.php"><i class="icon-2x icon-group icon-white" data-toggle="tooltip" data-placement="bottom" title="Users" id="users"></i></a></li>
                    <li><a href="charts.php"><i class="icon-2x icon-bar-chart icon-white" data-toggle="tooltip" data-placement="bottom" title="Charts" id="charts"></i></a></li>
                    <li><a href="sysinfo.php"><i class="icon-2x icon-hdd icon-white" data-toggle="tooltip" data-placement="bottom" title="System Info" id="sysinfo"></i></a></li>
                    <li><a href="edit.php"><i class="icon-2x icon-bug icon-white" data-toggle="tooltip" data-placement="bottom" title="Debug SQL" id="editsql"></i></a></li>
                    <li><a href="settings.php"><i class="icon-2x icon-wrench icon-white" data-toggle="tooltip" data-placement="bottom" title="PlexWatch Settings" id="settings"></i></a></li>
                    <li><a href="index.php?logout=1"><i class="icon-2x icon-power-off icon-white" data-toggle="tooltip" data-placement="bottom" title="Logout" id="logout"></i></a></li>
					
				</ul>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class='row-fluid'>
        <div class='span12'></div>
    </div>
    <div class='row-fluid'>
        <div class='span12'>
            <?php
            $guisettingsFile = "config/config.php";
            if (file_exists($guisettingsFile)) {
                require_once(dirname(__FILE__) . '/config/config.php');
                // Check if the date format is still using the old PHP formats
                if (strpos($plexWatch['timeFormat'],"g") !== false || strpos($plexWatch['timeFormat'],"G") !== false) {
                    header("Location: settings.php?error=datetime");
                }
            }else{
                header("Location: settings.php");
            }
            ?>
            <div class='wellbg'>
                <div class='wellheader'>
                    <div class='dashboard-wellheader'>
                        <h3>Statistics</h3>
                    </div>
                </div>
                <div id='library-stats' class='stats'>
                    <div id='stats-spinner' class='spinner'></div>
                </div>
            </div>
        </div>

        <div class='row-fluid'>
            <div class='span12'>
                <div class='wellbg'>
                    <div class='wellheader'>
                        <div class='dashboard-wellheader'>
                            <div id='currentActivityHeader'>
                            </div>
                        </div>
                    </div>
                    <div id='currentActivity'>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class='row-fluid'>
        <div class='wellbg'>
            <div class='wellheader'>
                <div class='dashboard-wellheader'>
                    <h3>Recently Added</h3>
                </div>
            </div>
            <div id='recentlyAdded'><div id='recently-added-spinner' class='spinner'></div></div>
        </div>
    </div>

    <footer></footer>
</div><!--/.fluid-container-->

<!-- javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-2.0.3.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/spin.min.js"></script>
<script src="js/cacher.js"></script>
<script>
    $(document).ready(function() {
        var cacheData = getCache('library-stats-cache');
        if (cacheData) {
            $("#library-stats").html(cacheData);
        } else {
            $.ajax({
                url: 'datafactory/get-library-stats.php',
                async: true,
                success: function(data) {
                    $("#library-stats").html(data);
                    setCache('library-stats-cache', data);
                }
            });
        }
    } );
</script>
<script>
    function currentActivityHeader() {
        $.ajax({
            url: 'includes/current_activity_header.php',
            cache: false,
            async: true,
            success: function(data) {
                $("#currentActivityHeader").html(data);
            }
        });
    }
    currentActivityHeader();
    setInterval('currentActivityHeader()', 15000);
</script>
<script>
    function currentActivity() {
        $.ajax({
            url: 'includes/current_activity.php',
            cache: false,
            async: true,
            success: function(data) {
                $("#currentActivity").html(data);
            }
        });
    }
    currentActivity();
    setInterval('currentActivity()', 15000);
</script>
<script>
    function recentlyAdded() {
        var widthVal= $('body').find(".container-fluid").width();
        $.ajax({
            url: 'includes/recently_added.php',
            type: "GET",
            async: true,
            data: { width : widthVal },
            success: function(data) {
                $("#recentlyAdded").html(data);
            }
        });
    }
    $(document).ready(function () {
        recentlyAdded();
        $(window).resize(function() {
            recentlyAdded();
        });
    });
</script>
<script>
    var opts = {
        lines: 8, // The number of lines to draw
        length: 8, // The length of each line
        width: 4, // The line thickness
        radius: 5, // The radius of the inner circle
        corners: 1, // Corner roundness (0..1)
        rotate: 0, // The rotation offset
        direction: 1, // 1: clockwise, -1: counterclockwise
        color: '#fff', // #rgb or #rrggbb or array of colors
        speed: 1, // Rounds per second
        trail: 60, // Afterglow percentage
        shadow: false, // Whether to render a shadow
        hwaccel: false, // Whether to use hardware acceleration
        className: 'spinner', // The CSS class to assign to the spinner
        zIndex: 2e9, // The z-index (defaults to 2000000000)
        top: '0', // Top position relative to parent
        left: '50%' // Left position relative to parent
    };
    var target_a = document.getElementById('stats-spinner');
    var spinner_a = new Spinner(opts).spin(target_a);

    var target_b = document.getElementById('recently-added-spinner');
    var spinner_b = new Spinner(opts).spin(target_b);
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