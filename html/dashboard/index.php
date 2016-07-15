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

<div class="content">
	<div class="dashboard center clearfix">
<?php
$conn = get_connection();
// 보여줄 user_id 값 받아오기
if (isset($_GET['user'])) {
	$user = $_GET['user'];
	// user id 존재 여부 확인
	$count = search_count($conn, 'user', 'id='.$user);
	if ($count == 0) {
		echo '존재하지 않는 회원의 대시보드입니다.';
		header("Location: /dashboard/");
	} else {
		include_once './sidebar.php';
		include_once './post_list.php';
	}
} else {
	// ?user 값이 없을 경우 자기자신을 보여준다
	$user = get_user_id($conn, $_SESSION['id']);
	
	// ?user 값이 없을 경우
	// 자기자신의 포스트와 친구의 포스트 리스트를 보여준다
	include_once './sidebar.php';
	include_once './my_list.php';
}
?>
	</div>
</div>

<?php // footer ?>

</body>
</html>