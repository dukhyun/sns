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

if (isset($_POST['id'])) {
	$id = $_POST['id']; // 카테고리 id
	
	// 연결된 포스트가 있으면 삭제할 수 없다.
	$query = sprintf("SELECT count(*) AS count FROM post WHERE category_id = %d", $id);
	$result = mysqli_query($conn, $query);
	if ($result === false) {
		die ("Database access failed: ".mysqli_error());
	}
	$row = mysqli_fetch_assoc($result);
	if (intval($row['count']) > 0) {
		// script
		header("Location: category_edit.php");
		// die();
	}
	
	// 카테고리 삭제 쿼리
	$query = sprintf("DELETE FROM category WHERE id = %d;", $id);
	if (mysqli_query($conn, $query) === false) {
		echo mysqli_error($conn);
	} else {
		echo 'DB DELETE<br>';
		header("Location: category_edit.php");
	}
} else {
	echo '삭제할 카테고리가 없습니다.<br>';
	header('Location: category_edit.php');
}
?>

<?php // footer ?>

</body>
</html>