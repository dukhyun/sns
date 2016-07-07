<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/../include/header.php'; ?>

<?php
	$conn = get_connection();
	$select_query = "SELECT * FROM post";
	$result = mysqli_query($conn, $select_query);
	$row = mysqli_fetch_assoc($result);
	$delete_query = sprintf("DELETE FROM post WHERE id=%s", $row['id']);
	mysqli_query($conn, $delete_query);
	if (mysqli_query($db_server, $delete_query) === false){
		echo mysqli_error($db_server);
	}
	else {	
		echo 'DB DELETE<br>';
		header("Location: /dashboard/");
	}
	mysqli_close($db_server);
?>

<?php // footer ?>

</body>
</html>