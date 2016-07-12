<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/login.css">
</head>
<body>
<?php
$root = '..';
include_once $root.'/../include/header.php';
?>

<?php
if (isset($_POST['content'])) {
	$category_id = $_POST['category'];
	$content = $_POST['content'];
	
	$conn = get_connection();
	$user_id = get_user_id($conn, $_SESSION['id']);
	
	// upload file
	$upload_dir = $root.'/../file/';
	//$upload_file = $upload_dir.basename($_FILES['file']['name']);
	$path = pathinfo($_FILES['file']['name']);
	$ext = strtolower($path['extension']);
	$upload_fn = $user_id.'_'.time();
	$upload_file = $upload_dir.$upload_fn.'.'.$ext;
	$upload_ok = 1;
	// Check file size
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
	
	// insert db
	if ($category_id == 0) {
		$insert_query = sprintf("INSERT INTO post (image, content, user_id)
				VALUES ('%s', '%s', '%d')", $upload_file, $content, $user_id);
	} else {
		$insert_query = sprintf("INSERT INTO post (image, content, category_id, user_id)
				VALUES ('%s', '%s', '%d', '%d')", $upload_file, $content, $category_id, $user_id);
	}
	if (mysqli_query($conn, $insert_query) === false) {
		echo mysqli_error($conn);
	} else {
		echo 'DB INSERT<br>';
		header("Location: /dashboard/");
	}
} else {
	// echo '내용이 없습니다.';
	header('Location: write_post.php');
}
?>

<?php // footer ?>

</body>
</html>