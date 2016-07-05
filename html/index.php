<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php include $_SERVER['DOCUMENT_ROOT'].'/../include/header.php'; ?>
<h1>00sns</h1><br>
<form action="login_db.php" method="POST">
	e-mail <input type="text" name="email"><br>
	password <input type="text" name="password"><br>
	<input type="submit" value="login"><br>
</form>	


<?php // footer ?>

</body>
</html>