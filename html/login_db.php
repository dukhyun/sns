<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/../include/header.php'; ?>

<?php
if (isset($_POST['email'], $_POST['password'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	echo 'login_db.php';

	if (try_to_login($email, $password) == true) {
		echo '로그인 성공';
		header('Location: dashboard/');
	} else {
		echo '로그인 실패';
		//header('Location: error.php?error_code=1');
	}
} else {
	echo 'login form error..!';
}
?>

<?php // footer ?>
</body>
</html>