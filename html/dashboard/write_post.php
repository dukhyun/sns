<!DOCTYPE HTML>
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
$conn = get_connection();
?>

<div class="form_style center">
	<h1>글 작성</h1>
	<form action="write_db.php" method="post">
		<ul>
			<li>
				카테고리:
				<label for="category"></label>
				<select id="category" name="category">
					<option value="전체보기">전체보기</option>
					<?php 
						$result = get_category_list($conn);
							while($row = mysqli_fetch_assoc($result)) {
							printf("<option value=%s>%s</option>", $row['name'], $row['name']);
							}
					?>
				</select>
			</li>
			<li>
				내용: <br>
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