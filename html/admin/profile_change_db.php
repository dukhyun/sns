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
	$user_id = get_user_id($conn, $_SESSION['id']);
	
	// upload picture
	if ($_FILES['file']['name'] != NULL) {
		$upload_file_name = file_upload($root, $user_id);
	}
	
	// db update
	$email = $_POST['email'];
	$nick = $_POST['nick'];
	$intro = $_POST['intro'];
	$gender = $_POST['gender'];
	
	$update_query = sprintf("UPDATE user SET");
	$update_query .= sprintf(" email='%s', nick='%s', intro='%s'", $email, $nick, $intro);
	if (isset($upload_file_name)) {
		$update_query .= sprintf(", picture='%s'", $upload_file_name);
	}
	if ($gender == 0) {
		$update_query .= sprintf(", gender_id=NULL");
	} else {
		$update_query .= sprintf(", gender_id=%d", $gender);
	}
	$update_query .= sprintf(" WHERE id=%d;", $user_id);
	if (mysqli_query($conn, $update_query) === false) {
		echo mysqli_error($conn);
	} else {
		echo 'DB UPDATE<br>';
		header("Location: /");
	}
?>

<?php // footer ?>

</body>
</html>