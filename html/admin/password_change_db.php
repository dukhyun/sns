<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<?php
$root = '..';
include_once $root.'/../include/header.php';
?>

<?php
$conn = get_connection();

if (isset($_POST['pw'], $_POST['pw_new'], $_POST['pw_confirm'])) {
	$password = $_POST['pw'];
	$pw_new = $_POST['pw_new'];
	$pw_confirm = $_POST['pw_confirm'];
	
	$pw_ok = 1;
	
	// pw 확인
	// password_verify($password, $_SESSION['password'])
	// check_user_account($user_id, $password)
	if (!check_user_account($_SESSION['id'], $password)) {
		echo '비밀번호가 잘못되었습니다.';
		$pw_ok = 0;
	}
	
	// pw_new, pw_confirm 확인
	if ($pw_new !== $pw_confirm) {
		echo "The two password fields didn't match.";
		$pw_ok = 0;
	}
	
	if ($pw_ok == 1) {
		$update_query = sprintf("UPDATE user SET pw_hash='%s' WHERE id=%d", password_hash($pw_new, PASSWORD_DEFAULT), $user_id);
		if (mysqli_query($conn, $update_query) === false) {
			echo mysqli_error($conn);
		} else {
			echo 'DB UPDATE<br>';
			header("Location: /");
		}
	} else {
		echo 'password change fail.';
		header("Location: ./password_change.php");
	}
} else {
	echo '빈칸이 없어야 합니다.';
	header("Location: ./password_change.php");
}
?>

<?php // footer ?>

</body>
</html>