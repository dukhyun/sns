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
	$conn = get_connection();
	if (isset($_POST['content'])) {
		$comment = $_POST['content'];
		$post_id = $_POST['post_id'];
		$user_id = get_user_id($conn, $_SESSION['id']);

		// insert comment db
		$insert_query = sprintf("INSERT INTO comment (comment, user_id, post_id) VALUES ('%s', '%d', '%d')", $comment, $user_id, $post_id);
		if (mysqli_query($conn, $insert_query) === false) {
			echo mysqli_error($conn);
		} else {
			echo 'comment DB INSERT<br>';
			header("Location: /dashboard/post_view_detail.php?post_id=".$post_id);
		}
	}
?>

<?php // footer ?>

</body>
</html>