<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php
	$root = '../..';
	include_once $root.'/../include/header.php';
	
	$conn = get_connection();
	$user_id = get_user_id($conn, $_SESSION['id']); 
	$friend_id = $_GET['id'];
	
	// $select_query = sprintf("SELECT * FROM friend WHERE friend_id = %d AND user_id = %d", $friend_id, $user_id);
	// if (mysqli_query($conn, $select_query) === false) {
		// echo mysqli_error($conn);
	// } else {
		// echo 'DB SELECT<br>';
		// die;
	// }
	
	$insert_query = sprintf("INSERT INTO friend (friend_id, user_id) VALUES ('%d', '%d')", $friend_id, $user_id);
	if (mysqli_query($conn, $insert_query) === false) {
		echo mysqli_error($conn);
	} else {
		echo 'DB INSERT<br>';
		header('Location: /dashboard/');
	}
	
	mysqli_close($conn);
?>

<?php // footer ?>

</body>
</html>