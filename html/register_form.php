<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'].'/../include/header.php'; ?>
<h1>register</h1><br>
<form action="register_db.php" method="POST">
	e-mail <input type="text" name="email"><br>
	nickname <input type="text" name="nick"><br>
	password <input type="text" name="password"><br>
	<input type="submit" value="register"><br>
</form>	

<?php // footer ?>
</body>
</html>