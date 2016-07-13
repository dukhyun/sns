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
		$post_id = mysqli_insert_id($conn);
		echo 'post_id:'.$post_id.'<br>';
		// image upload
		if ($_FILES['file']['name'] != NULL) {
			$file_name = $post_id.'_'.time();
			$image = file_upload($root, $file_name);
			$update_query = sprintf("UPDATE post SET image='%s' WHERE id=%d", $image, $post_id);
			if (mysqli_query($conn, $update_query) === false) {
				echo mysqli_error($conn);
			}
		} else {
			echo 'false';
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