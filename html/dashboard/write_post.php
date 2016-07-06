<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>
<?php 
	include_once $_SERVER['DOCUMENT_ROOT'].'/../include/header.php'; 
	include_once $_SERVER['DOCUMENT_ROOT'].'/../include/host.php';
?>

<h1>글 작성</h1><br>
<form action="write_db.php" method="post">
	<ul>
		<li>
			카테고리: <input type="text" name="category">
		</li>
		<li>
			내용: <br>
			<textarea rows = "10" cols = "50%" input type="text" name="content"></textarea>
		</li>
		<li>
			<input type="submit" value="제출">
		</li>
	</ul>
</form>

<?php // footer ?>

</body>
</html>