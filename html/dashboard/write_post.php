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
	카테고리: <input type="text" name="category"><br><br>
	내용: <br><textarea rows = "10" cols = "50%" input type="text" name="content"></textarea><br>
	<input type="submit" value="제출">
</form>

<?php // footer ?>

</body>
</html>