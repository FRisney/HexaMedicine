	<?php
	$host = "localhost";
	$username = "root";
	$password = "usbw";
	$dbname = "hexamed";
	@ $db = new mysqli($host, $username, $password, $dbname);
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	if(mysqli_connect_errno()){printf("Connect failed: %s\n", mysqli_connect_error());exit();}
	?>