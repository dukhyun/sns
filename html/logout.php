<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>

<?php
	require_once '../include/host.php';
	
	start_session();
	try_to_logout();
	destroy_session();
	
	header('Location: index.php');
?>
</body>
</html>