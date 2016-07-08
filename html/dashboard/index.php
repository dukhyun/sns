<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/dash.css">
</head>
<body>
<?php
$root = '..';
include_once $root.'/../include/header.php';
?>

<?php
// 보여줄 user_id 값 받아오기
if (isset($_GET['user'])) {
	$user = $_GET['user'];
} else {
	// ?user 값이 없을 경우 자기자신을 보여준다
	$conn = get_connection();
	$user = get_user_id($conn, $_SESSION['id']);
}

include_once './sidebar.php';
include_once './post_list.php';
?>

<?php // footer ?>

</body>
</html>