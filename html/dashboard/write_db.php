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
	
	// file check
	$path = pathinfo($_FILES['file']['name']);
	$ext = strtolower($path['extension']);
	$upload_ok = 1;
	// Allow certain file formats
	if ($ext != 'gif' && $ext != 'jpg' && $ext != 'jpeg' && $ext != 'png') {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$upload_ok = 0;
	}
	// Check file size
	if ($_FILES['file']['size'] > 5000000) {
		echo 'Sorry, your file is too large.';
		$upload_ok = 0;
	}
	if ($upload_ok == 0) {
		echo 'Sorry, your file was not uploaded.';
		header('Location: write_post.php');
	}
	
	// insert db
	if ($category_id == 0) {
		$insert_query = sprintf("INSERT INTO post (content, user_id)
				VALUES ('%s', '%d')", $content, $user_id);
	} else {
		$insert_query = sprintf("INSERT INTO post (content, category_id, user_id)
				VALUES ('%s', '%d', '%d')", $content, $category_id, $user_id);
	}
	if (mysqli_query($conn, $insert_query) === false) {
		echo mysqli_error($conn);
	} else {
		echo 'DB INSERT<br>';
		// insert post id
		$post_id = mysqli_insert_id($conn);
		// image upload
		$file_name = $post_id.'_'.time();
		$image = file_upload($root, $file_name, $ext);
		$update_query = sprintf("UPDATE post SET image='%s' WHERE id=%d", $image, $post_id);
		if (mysqli_query($conn, $update_query) === false) {
			echo mysqli_error($conn);
		}
		
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