<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php 
	include $_SERVER['DOCUMENT_ROOT'].'/../include/header.php';
	require_once '../../../../include/host.php';
	if (isset($_POST['email'], $_POST['nick'], $_POST['password'])) {
		$email = $_POST['email'];
		$nick = $_POST['nick'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$db_server = get_connection();
		$insert_query = "INSERT INTO user(email, nick, pw_hash) values('" . $email . "','" .$nick. "','" .$password. "') ";
		if (mysqli_query($db_server, $insert_query) === false) {
			echo mysqli_error($db_server);
		} 
		else {
			echo "register success..! <br><br>";
			echo "<a href='index.php'>login</a><br>"; 
		}
	}
	else {
		echo 'register form error..!';
	}
	mysqli_close($db_server);
	}

	
	
	
	
?>
</body>
</html>