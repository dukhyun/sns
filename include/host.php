<?php
function get_connection() {
	$hostname = 'kocia.cytzyor3ndjk.ap-northeast-2.rds.amazonaws.com';
	$username = 'sns';
	$password = 'sns';
	$dbname = 'sns';
	
	$db_server = mysqli_connect($hostname, $username, $password, $dbname);
	mysqli_query($db_server, "SET NAMES 'utf8'");
	if (!$db_server) {
		die('Mysql connection failed: '.mysqli_connect_error());
	}
	
	return $db_server;
}
?>