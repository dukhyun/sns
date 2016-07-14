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
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$post_id = $_GET['post_id'];
	}
	$conn = get_connection();
	$select_query = sprintf("SELECT * FROM post WHERE id=%d", $post_id);
	$result = mysqli_query($conn, $select_query);
	$row = mysqli_fetch_assoc($result);
	$last_content = $row['content'];
	$category_id = $row['category_id'];
	if ($row['image'] == NULL) {
		$image = NULL;
	} else {
		$image = '/file/'.$row['image'];
	}
?>

<div class="form_style center">
	<h1>글 수정</h1><br>
	<form action="update_db.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
		<ul>
			<li>
				<label>카테고리:</label>
				<select id="category" name="category">
					<option value="0">전체보기</option>
					<?php 
						$result = get_category_list($conn, get_user_id($conn, $_SESSION['id']));
						while($row = mysqli_fetch_assoc($result)) {
							if ($category_id == $row['id']) {
								printf('<option vlaue="%d" selected="selected">%s</option>', $row['id'], $row['name']);
							} else {
								printf('<option value="%d">%s</option>', $row['id'], $row['name']);
							}
						}
					?>
				</select>
			</li>
			<li>
				<label>사진:</label>
				<input type="file" name="file" id="file" accept="image/*" onchange="previewFile(event);">
				<img id="output" src="<?php echo $image; ?>">
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
				내용: <br>
				<textarea type="text" name="content"><?php echo $last_content ?></textarea>
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