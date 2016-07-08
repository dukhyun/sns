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

if (isset($_POST['name'], $_POST['id'])) {
	$id = $_POST['id']; // 카테고리 id
	$name = $_POST['name']; // 수정할 카테고리 이름
	
// 카테고리 수정
	$update_query = sprintf("UPDATE category SET name = '%s' WHERE id = '%d';", $name, $id);
	if (mysqli_query($conn, $update_query) === false) {
		echo mysqli_error($conn);
	} else {
		echo 'DB UPDATE<br>';
		header("Location: category_edit.php");
	}
} else {
	// 카테고리 이름란이 비어있다.
	header("Location: category_edit.php");
}
?>

<?php // footer ?>

</body>
</html>