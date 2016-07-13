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
	$post_id = $_POST['post_id'];
	$category_id = $_POST['category'];
	$content = $_POST['content'];
	
	$conn = get_connection();
	$user_id = get_user_id($conn, $_SESSION['id']);
	
	// upload file
	$upload_dir = $root.'/../file/';
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
	
	// update db
	$update_query = sprintf("UPDATE post SET content='%s'", $content);
	$update_query .= sprintf(", image='%s'", $upload_fn);
	if ($category_id == 0) {
		$update_query .= sprintf(", category_id=NULL");
	} else {
		$update_query .= sprintf(", category_id=%d", $category_id);
	}
	$update_query .= sprintf(" WHERE id=%d", $post_id);
	
	if (mysqli_query($conn, $update_query) === false) {
		echo mysqli_error($conn);
	} else {
		echo 'DB UPDATE<br>';
		header("Location: /dashboard/");
	}
} else {
	echo '내용이 없습니다.';
	header('Location: update_post.php');
}
mysqli_close($conn);
?>

<?php // footer ?>

</body>
</html>
