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
			$email = $_SESSION['id'];
			$id = get_user_id($conn, $email);
			$result = get_user_profile($conn, $id);
			$row = mysqli_fetch_assoc($result);
			$nick = $row['nick'];
			$intro = $row['intro'];
			$gender = get_gender_type($conn, $row['gender_id']);
		?>
		<form action="about_db.php" method="POST">
			<ul>
				<li class="clearfix">
					<div class="side floatleft">E-mail</div>
					<input class="floatleft" type="text" name="email" value="<?php echo $email ?>">
				</li>
				<li class="clearfix">
					<div class="side floatleft">닉네임</div>
					<input class="floatleft" type="text" name="nick" value="<?php echo $nick ?>">
				</li>
				<li class="clearfix">
					<div class="side floatleft">프로필 사진</div>
					<div class="floatleft filebox">
						<input class="floatleft" id="file_name" value="파일 선택" disabled="disabled">
						<label class="floatright" for="input_file">업로드</label>
						<input type="file" id="input_file" name="picture" accept="image/*" onchange="javascript: document.getElementById('file_name').value = this.value">
					</div>
				</li>
				<li class="clearfix">
					<div class="side floatleft">소개</div>
					<textarea class="floatleft" name="intro" value="<?php echo $intro ?>"></textarea>
				</li>
				<li class="clearfix">
					<div class="side floatleft">성별</div>
					<div>
						<select id="gender" name="gender">
						<?php
							$query = sprintf("SELECT * FROM gender");
							$result = mysqli_query($conn, $query);
							while ($row = mysqli_fetch_assoc($result)) {
								if ($gender == $row['gender']) {
									printf('<option value="%d" selected>%s</option>', $row['id'], $row['gender']);
								} else {
									printf('<option value="%d">%s</option>', $row['id'], $row['gender']);
								}
							}
							if ($gender == NULL) {
								printf('<option value="%d" selected>%s</option>', NULL, 선택안함);
							} else {
								printf('<option value="%d">%s</option>', NULL, 선택안함);
							}
						?>
						</select>
					</div>
				</li>
				<li type="clearfix">
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