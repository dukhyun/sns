<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>
<?php
	$root = '../..';
	include_once $root.'/../include/header.php';
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$id = $_GET['id'];
		$post_id = $_GET['post_id'];
	}
	$conn = get_connection();
	
	$delete_query = sprintf("DELETE FROM comment WHERE id=%d", $id);
	if (mysqli_query(mysqli_query($conn, $delete_query)) === false){
		echo mysqli_error($conn);
	} else {	
		echo 'DB DELETE<br>';
		header("Location: /dashboard/post_view_detail.php?post_id=".$post_id);
	}
	mysqli_close($conn);
?>

<?php // footer ?>

</body>
</html>