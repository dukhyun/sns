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
?>

<?php
if (isset($_GET['content'])) {
	$post_id = $_GET['post_id'];
	$category_id = $_GET['category'];
	$content = $_GET['content'];
	$conn = get_connection();
	$user_id = get_user_id($conn, $_SESSION['id']);
	
	
	if ($category_id == 0) {
		$update_query = sprintf("UPDATE post SET content='%s', category_id=NULL WHERE id='%d'", $content, $post_id);
	} else {
		$update_query = sprintf("UPDATE post SET content='%s', category_id='%d' WHERE id='%d'", $content, $category_id, $post_id);
	}
	if (mysqli_query($conn, $update_query) === false) {
		echo mysqli_error($conn);
	} else {
		echo 'DB UPDATE<br>';
		header("Location: /dashboard/");
	}
} else {
	echo '내용이 없습니다.';
	header('Location: update_post.php');
}
?>

<?php // footer ?>

</body>
</html>
