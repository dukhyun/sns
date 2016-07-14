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
				<input type="file" name="file" accept="image/*" onchange="previewFile(event);">
				<img id="output">
				<script>
				var previewFile = function(event) {
					var reader = new FileReader();
					reader.onload = function() {
						var output = document.getElementById('output');
						output.src = reader.result;
					};
					reader.readAsDataURL(event.target.files[0]);
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