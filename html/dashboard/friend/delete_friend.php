<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/dash.css">
</head>
<body>
<?php
$root = '../..';
include_once $root.'/../include/header.php';
?>

<?php
	$conn = get_connection();
	if (check_login()) {
		$friend_id = $_POST['id'];
		$delete_query = sprintf("DELETE FROM friend WHERE friend_id = %d;", $friend_id);
		if (mysqli_query($conn, $delete_query) === false) {
			echo mysqli_error($conn);
		} else {
			echo 'DB DELETE<br>';
			header("Location: friend_list.php");
		}
	}
	mysql_close($conn);
?>

<?php // footer ?>

</body>
</html>