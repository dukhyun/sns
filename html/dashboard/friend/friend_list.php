<!DOCTYPE HTML>
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
	
	//db불러오기
	$conn = get_connection();
	if (check_login()) {
		$user_id = get_user_id($conn, $_SESSION['id']);
?>
	<h1>친구목록</h1>
<?php // 친구 리스트 보여주기
		$select_query = sprintf("SELECT * FROM friend WHERE user_id=%d", $user_id);
		$result = mysqli_query($conn, $select_query);
		while ($row = mysqli_fetch_assoc($result)) {
		?>
		<form action="delete_friend.php" method="post">
		<ul>
			<li class="floatleft">
		<?php
			$friend_id = $row['friend_id'];
			printf('<a href="dashboard/?user=%d">%s</a>', $friend_id, get_user_nick($conn, $friend_id));
		?>
			</li>
			<li class="floatleft">
				<input type="hidden" name="id" value="<?php echo $friend_id; ?>">
				<input type="submit" value="삭제">
			</li>
		</ul>
		</form>
		<?php	
		}
	}
?>
	<h1>친구검색</h1>


<?php // footer ?>

</body>
</html>
	