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
if (isset($_POST['content'])) {
	$category_id = $_POST['category'];
	$content = $_POST['content'];
	
	$conn = get_connection();
	// $category_id = 1;
	$user_id = get_user_id($conn, $_SESSION['id']);
	$insert_query = sprintf("INSERT INTO post (content, category_id, user_id)
				VALUES ('%s', '%d', '%d')", $content, $category_id, $user_id);
	if (mysqli_query($conn, $insert_query) === false) {
		echo mysqli_error($conn);
	} else {
		echo 'DB INSERT<br>';
		header("Location: /dashboard/");
	}
} else {
	echo '내용이 없습니다.';
	header('Location: write_post.php');
}
?>

<?php // footer ?>

</body>
</html>