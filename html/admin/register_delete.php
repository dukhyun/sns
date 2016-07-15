<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php
	$root = '..';
	include_once $root.'/../include/header.php';
	
	$conn = get_connection();
	$user_id = get_user_id($conn, $_SESSION['id']);
	
	// post delete
	$delete_query = sprintf("DELETE FROM post WHERE user_id=%d", $user_id);
	if (mysqli_query($conn, $delete_query) === false){
		echo mysqli_error($conn);
	} else {
		echo 'POST DB DELETE<br>';
	}
	
	//
	
	// user delete
	$delete_query = sprintf("DELETE FROM user WHERE id=%d", $user_id);
	if (mysqli_query($conn, $delete_query) === false) {
		echo mysqli_error($conn);
	} else {
		echo 'USER DB DELETE<br>';
		header('Location: /logout.php');
	}
?>

<?php // footer ?>

</body>
</html>