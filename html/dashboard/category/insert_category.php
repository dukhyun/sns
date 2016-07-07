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
if (isset($_POST['name'])) {
	$name = $_POST['name']; // 카테고리 이름
	
	$conn = get_connection();
	$user_id = get_user_id($conn, $_SESSION['id']);
	$insert_query = sprintf("INSERT INTO category (name, user_id)
				VALUES ('%s', '%d')", $name, $user_id);
	if (mysqli_query($conn, $insert_query) === false) {
		echo mysqli_error($conn);
	} else {
		echo 'DB INSERT<br>';
		header("Location: category_edit.php");
	}
} else {
	echo '내용이 없습니다.';
	header('Location: category_edit.php');
}
?>

<?php // footer ?>

</body>
</html>