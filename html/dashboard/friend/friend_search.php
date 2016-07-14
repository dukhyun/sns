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
		$friend_nick = $_POST['nick'];
		
		$select_query = sprintf("SELECT * FROM user WHERE nick='%s'", $friend_nick);
		$result = mysqli_query($conn, $select_query);
		$row = mysqli_fetch_assoc($result);
	?>			
		<h2><?php echo $friend_nick; ?>으로 검색된 유저의 프로필</h2>
		<ul>
			<li>
			<?php
				$url = $row['picture'];
				if ($url !== NULL) {
			?>
				<img src= "/file/<?php echo $url ?>">
			<?php } ?>
			</li>
			<li>
			E-mail : <?php echo $row['email']; ?>
			</li>
			<li>
			nick : <?php echo $row['nick']; ?>
			</li>
			<li>
			intro : <?php echo $row['intro']; ?>
			</li>
			<li>
			<?php 
				if ($row['gender_id'] !== NULL) {
			?>
				gender : <?php echo get_gender_type($conn, $row['gender_id']);
				}
				else { ?>
				gender : 선택안함	
				<?php } ?>
			</li>
		<ul>
	<?php
		$select_query = sprintf("SELECT * FROM friend WHERE user_id=%d", $user_id);
		$result2 = mysqli_query($conn, $select_query);
		$row2 = mysqli_fetch_assoc($result2);
		if ($row['id'] !== $row2['friend_id']) {
	?>	
		<a href="/dashboard/friend/friend_db.php?id=<?php echo $row['id']?>">친구추가</a>
	<?php	
		}		
	}
?>		




<?php // footer ?>

</body>
</html>