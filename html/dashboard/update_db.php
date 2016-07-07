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
if (isset($_POST['content'])) {
	//$category_id = $_POST['category'];
	$content = $_POST['content'];
	
	$conn = get_connection();
	//$category_id = 1;
	$user_id = get_user_id($conn, $_SESSION['id']);
	$update_query = sprintf("UPDATE post SET content='%s' WHERE user_id='%d'", $content,  $user_id);
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
