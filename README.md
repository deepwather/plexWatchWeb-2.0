# plexWatchWeb-2.0
This is my development of the original plexWatchWeb from "https://github.com/ecleese/plexWatchWeb".

A new web front-end for plexWatch.

* plexWatch: https://github.com/ljunkie/plexWatch
* plexWatch Plex forum thread: http://forums.plexapp.com/index.php/topic/72552-plexwatch-plex-notify-script-send-push-alerts-on-new-sessions-and-stopped/
* plexWatch (Windows branch) Plex forum thread: http://forums.plexapp.com/index.php/topic/79616-plexwatch-windows-branch/


###Support
-----------
* plexWatchWeb-2.0 Wiki: https://github.com/deepwather/plexWatchWeb-2.0/wiki

###NEW Features
-----------
* A beatiful Login-Page is now included ->> defauld passwort is: <b>plexwatch</b> (All php-Files are protectet!)
  * There is as well new a logout butten integradet in the main-menu.
  * You can change the default PW by editing the "login.php" file.

* A very exciting new function, is the "System Info" Tab. With it you have now the opportunity to monitor your server.
 * <em>You can monitor the server in the following ways:</em>
 * General info's like -> OS-type, uptime, Server-Time & Hostname
 * Internet Speed (Up/Down) & Bandwich
 * Load average CPU & numbers of prozessor cores and Ram consumption
 * Network Statistics // numper of connections & IP Adresses.
 * Disk Usage (All partitions) Size / Used / Avail. & Mountpoint
 * Display's all users on the system & the userhome path
 * Display all running processes and details like: ->> "User, PID, CPU-Load, Used-Mem, VSZ, RSS, TTY & STAT"
 * Aditionally you can activate ->> last login, who is online, Swap usage & installed Software (may not working)
 

* A SQL-Editor is as well new found in the top-Menu. With it you can easily delete incorrect informations.
 

###Regular Features
-----------

* Responsive web design viewable on desktop, tablet and mobile web browsers 

* Themed to complement Plex/Web 

* Easy configuration setup via html form

* Plex Media Server section counts / Total user count

* Current Plex Media Server viewing activity including:
	* number of current users
	* title
	* progress
	* platform
	* user
	* state (playing, paused, buffering, etc)
	* stream type (direct, transcoded)
	* video type & resolution
	* audio type & channel count.
	
* Recently added media and how long ago it was added

* Global watching history charts (hourly, max hourly, daily, monthly)

* Global watching history with search/filtering & dynamic column sorting
	* date
	* user
	* platform
	* ip address (if enabled in plexWatch)
	* title
	* stream information details
	* start time
	* paused duration length
	* stop time
	* duration length
	* percentage completed
	
* full user list with general information and comparison stats

* individual user information
	- username and gravatar (if available)
	- daily, weekly, monthly, all time stats for play count and duration length
	- individual platform stats for each user
	- public ip address history with last seen date and geo tag location 
	- recently watched content
	- watching history
* charts
	- top 10 all time viewed content
	- top 10 viewed movies
	- top 10 viewed tv shows
	- top 10 viewed tv episodes

* content information pages 
	- movies (includes watching history)
	- tv shows (includes top 10 watched episodes)
	- tv seasons
	- tv episodes (includes watching history)


###Requirements
---------------
* Plex Media Server (v0.9.9+) and a PlexPass membership
* plexWatch (v0.3.2+)
* a web server that supports php (apache, nginx, XAMPP, WampServer, EasyPHP, lighttpd, etc)
* php5
* php5-sqlite
* php5-curl
* php5-json


### Install 
-----------

1. Install requirements
2. Download and unzip the plexWatchWeb package.
3. Upload the contents to the desired location on your web server "/var/www/plexWatch"


###Use
------

Navigate to: http://ip-of-web-server/plexWatch
