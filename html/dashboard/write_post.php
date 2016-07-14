<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/edit.css">
</head>
<body>
<?php
$root = '..';
include_once $root.'/../include/header.php';
?>

<div class="form_style center">
	<h1>글 작성</h1>
	<form action="write_db.php" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label>카테고리:</label>
				<select id="category" name="category">
					<option value="0">전체보기</option>
					<?php 
						$result = get_category_list($conn, get_user_id($conn, $_SESSION['id']));
						while($row = mysqli_fetch_assoc($result)) {
							printf('<option value="%d">%s</option>', $row['id'], $row['name']);
						}
					?>
				</select>
			</li>
			<li>
				<label>사진:</label>
				<input type="file" name="file" id="file" accept="image/*" onchange="previewFile(event);">
				<img id="output">
				<div id="error"></div>
				<script> // 파일 업로드 이벤트
				var previewFile = function(event) {
					var file = document.getElementById('file').value;
					var output = document.getElementById('output');
					output.src = '';
					//document.getElementById('file_name').value = file;
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
			</li>
			<li>
				<label>내용:</label>
				<textarea type="text" name="content"></textarea>
			</li>
			<li>
				<input type="submit" value="제출">
			</li>
		</ul>
	</form>
</div>

<?php // footer ?>

</body>
</html>