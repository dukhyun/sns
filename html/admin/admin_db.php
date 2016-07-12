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
	$upload_dir = $root.'/../file/';
	$path = pathinfo($_FILES['file']['name']);
	$ext = strtolower($path['extension']);
	$upload_file = $upload_dir.$user_id.'.'.$ext;
	
	if ($_FILES['file']['size'] > 5000000) {
		echo 'Sorry, your file is too large.';
		$upload_ok = 0;
	}
	if ($upload_ok == 0) {
		echo 'Sorry, your file was not uploaded.';
	} else {
		if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
			echo 'The file '.basename($_FILES['file']['name']).' has been uploaded.';
		} else {
			echo 'Sorry, there was an error uploading your file.';
		}
	}
	
	// db update
	$email = $_POST['email'];
	$nick = $_POST['nick'];
	$intro = $_POST['intro'];
	$gender = $_POST['gender'];
	
	if ($gender == 0) {
		$update_query = sprintf("UPDATE user SET email='%s', nick='%s', picture='%s', intro='%s', gender_id=NULL WHERE id='%s'", $email, $nick, $upload_file, $intro, $user_id);
	} else {
		$update_query = sprintf("UPDATE user SET email='%s', nick='%s', picture='%s', intro='%s', gender_id='%d' WHERE id='%s'", $email, $nick, $upload_file, $intro, $gender, $user_id);
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