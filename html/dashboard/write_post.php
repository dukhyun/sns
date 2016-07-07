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
?>

<div class="form_style center">
	<h1>글 작성</h1>
	<form action="write_db.php" method="post">
		<ul>
			<li>
				카테고리:
				<label for="category"></label>
				<select id="category" name="category">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
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