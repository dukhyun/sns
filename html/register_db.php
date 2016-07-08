<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php
$root = '.';
include_once $root.'/../include/header.php';
?>

<?php
	if (isset($_POST['email'], $_POST['nick'], $_POST['password'])) {
		$email = $_POST['email'];
		$nick = $_POST['nick'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		$db_server = get_connection();
		$insert_query = sprintf("INSERT INTO user(email, nick, pw_hash) values('%s', '%s', '%s');", $email, $nick, $password);
		if (mysqli_query($db_server, $insert_query) === false) {
			echo mysqli_error($db_server);
		} else {
			echo "register success..! <br><br>";
			header('Location: /');
		}
	} else {
		echo 'register form error..!';
	}
	mysqli_close($db_server);
?>

<?php // footer ?>

</body>
</html>