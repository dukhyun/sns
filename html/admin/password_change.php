<!DOCTYPE html>
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

<div class="content">
	<div class="about center">
		<div class="menu clearfix">
			<a href="./profile_change.php">프로필 변경</a>
			<a href="./password_change.php">비밀번호 변경</a>
		</div>
		<?php
		if (check_login() === true) {
			$email = $_SESSION['id'];
			$id = get_user_id($conn, $email);
			$result = get_user_profile($conn, $id);
			$row = mysqli_fetch_assoc($result);
			
		?>
		<form action="password_change_db.php" method="post" enctype="multipart/form-data">
		<ul>
			<li class="clearfix">
				<div class="side floatleft">이전 비밀번호</div>
				<input class="floatleft" type="text" id="pw" name="pw">
				<div class="error floatleft"></div>
			</li>
			<li class="clearfix">
				<div class="side floatleft">새 비밀번호</div>
				<input class="floatleft" type="text" id="pw_new" name="pw_new">
				<div class="error floatleft"></div>
			</li>
			<li class="clearfix">
				<div class="side floatleft">새 비밀번호 확인</div>
				<input class="floatleft" type="text" id="pw_confirm" name="pw_confirm">
				<div class="error floatleft"></div>
			</li>
			<li class="clearfix">
				<div class="side floatleft"></div>
				<input class="floatleft" type="submit" value="비밀번호 수정">
			</li>
		</ul>
		</form>
		<?php
		} else {
			echo '로그인이 되어있지 않습니다.';
			header("Location: /");
		}
		?>
	</div>
</div>

<?php // footer ?>

</body>
</html>