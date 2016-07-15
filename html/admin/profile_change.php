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
			
			$nick = $row['nick'];
			$intro = $row['intro'];
			$gender = get_gender_type($conn, $row['gender_id']);
			if ($row['picture'] == NULL) {
				$picture = NULL;
			} else {
				$picture = '/file/'.$row['picture'];
			}
		?>
		<form action="profile_change_db.php" method="post" enctype="multipart/form-data">
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
					<div class="clearfix">
						<input class="floatleft" id="file_name" value="파일 선택" disabled="disabled">
						<label class="floatright" for="input_file">업로드</label>
						<input type="file" id="input_file" name="file" accept="image/*" onchange="previewFile(event);">
					</div>
					<div>
						<img id="output" src="<?php echo $picture; ?>">
					</div>
					<div>
						<span id="error"></span>
					</div>
					<script> // 파일 업로드 이벤트
					var previewFile = function(event) {
						var file = document.getElementById('input_file').value;
						var output = document.getElementById('output');
						output.src = '';
						document.getElementById('file_name').value = file;
						//file_name.value = input_file.value;
						if (file != '') {
							var fileExt = file.substring(file.lastIndexOf('.') + 1);
							var reg = /gif|jpg|jpeg|png/i; // 업로드 가능 확장자
							if (reg.test(fileExt) == false) {
								document.getElementById('error').innerHTML = 'gif, jpg, png로 된 이미지만 업로드 가능합니다.';
								return;
							}
							var reader = new FileReader();
							reader.onload = function() {
								output.src = reader.result;
							};
							reader.readAsDataURL(event.target.files[0]);
						}
					};
					</script>
				</div>
			<li class="clearfix">
				<div class="side floatleft">소개</div>
				<textarea class="floatleft" name="intro"><?php echo $intro ?></textarea>
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
							printf('<option value="0" selected>%s</option>', 선택안함);
						} else {
							printf('<option value="0">%s</option>', 선택안함);
						}
					?>
					</select>
				</div>
			</li>
			<li class="clearfix">
				<div class="side floatleft"></div>
				<input class="floatleft" type="submit" value="정보 수정">
			</li>
		</ul>
		</form>
		<form action="./register_delete.php" method="post">
		<ul>
			<li class="clearfix">
				<div class="side floatleft"></div>
				<input class="drawal floatleft" type="submit" value="회원탈퇴">
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