<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php 
	include $_SERVER['DOCUMENT_ROOT'].'/../include/header.php';
	require_once 'session.php';
	start_session();
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$email = $_POST['email'];
		$password = $_POST['password'];
	
		if (try_to_login($email, $password) ==	 true) {
			//header('Location: protected_page.php?id='.$id);
			if (check_login()) {
				header('Location: 대쉬보드.php?');
			}
		} else {
			//header('Location: error.php?error_code=1');
		}
	} else {
		echo 'login form error..!';
	}
?>
</body>
</html>