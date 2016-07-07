<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/dash.css">
</head>
<body>
<?php 
	include_once $_SERVER['DOCUMENT_ROOT'].'/../include/header.php'; 
?>

<div class="form_style center">
	<h1>글 수정</h1><br>
	<form action="update_db.php" method="post">
		<ul>
			<!--<li>
				카테고리:
				<label for="category"></label>
				<select id="category" name="category">
					<option value="1">112312313123123</option>
					<option value="2">2</option>
					<option value="3">3</option>
				</select>
			</li>-->
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