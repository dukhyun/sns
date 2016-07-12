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
	
	$conn = get_connection();
	$email = $_POST['email'];
	$nick = $_POST['nick'];
	$picture = $_POST['picture'];
	$intro = $_POST['intro'];
	$gender = $_POST['gender'];
	$user_id = get_user_id($conn, $_SESSION['id']);
	if ($gender == 0) {
		$update_query = sprintf("UPDATE user SET email = '%s', nick = '%s', picture = '%s', intro = '%s', gender_id = NULL WHERE id = '%s'", $email, $nick, $picture, $intro, $user_id);
	} else {
		$update_query = sprintf("UPDATE user SET email = '%s', nick = '%s', picture = '%s', intro = '%s', gender_id = '%d' WHERE id = '%s'", $email, $nick, $picture, $intro, $gender, $user_id);
	}
	if (mysqli_query($conn, $update_query) === false) {
		echo mysqli_error($conn);
	} else {
		echo 'DB UPDATE<br>';
		//header("Location: ");
	}
?>

<?php // footer ?>

</body>
</html>