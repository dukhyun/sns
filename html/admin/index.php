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
	<div class="about">
		<h1>프로필 편집</h1>
		<?php
		if (check_login() === true) {
			get_user_email($conn, $user_id);
		?>
		<form action="about_db.php" method="POST">
			<ul>
				<li class="clearfix">
					<div class="side floatleft">E-mail</div>
					<input class="floatleft" type="text" name="email" value="">
				</li>
				<li class="clearfix">
					<div class="side floatleft">닉네임</div>
					<input class="floatleft" type="text" name="nick" value="">
				</li>
				<li class="clearfix">
					<div class="side floatleft">프로필 사진</div>
					<div class="floatleft filebox">
						<input class="floatleft file_name" value="파일 선택" disabled="disabled">
						<label class="floatright" for="input_file">업로드</label>
						<input type="file" id="input_file" name="picture" accept="image/*">
					</div>
				</li>
				<li class="clearfix">
					<div class="side floatleft">소개</div>
					<textarea class="floatleft" name="intro" value=""></textarea>
				</li>
				<li class="clearfix">
					<div class="side floatleft">성별</div>
					<div>
						<select id="gender" name="gender">
							<option value="male">남자</option>
							<option value="femail">여자</option>
							<option value="none" selected>선택 안함</option>
						</select>
					</div>
				</li>
				<li type="hidden">
					<div class="side floatleft"></div>
					<input class="floatleft" type="submit" value="확인">
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