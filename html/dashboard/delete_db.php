<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>
<?php
$root = '..';
include_once $root.'/../include/header.php';
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
	$post_id = $_GET['post_id'];
}
?>

<?php
	$user_id = get_user_id($conn, $_SESSION['id']);
	$conn = get_connection();
	$delete_comment_qury = sprintf("DELETE FROM comment WHERE post_id=%d", $post_id);
	mysqli_query($conn, $delete_comment_qury);
	$select_query = sprintf("SELECT * FROM post WHERE user_id=%s", $user_id);
	$result = mysqli_query($conn, $select_query);
	while ($row = mysqli_fetch_assoc($result)) {
		if ($post_id == $row['id']) {
			$delete_query = sprintf("DELETE FROM post WHERE id=%s", $row['id']);
			if (mysqli_query($conn, $delete_query) === false){
				echo mysqli_error($conn);
			}
			else {	
				echo 'DB DELETE<br>';
				header("Location: /dashboard/");
			}
		}
	}
	mysqli_close($conn);
?>

<?php // footer ?>

</body>
</html>