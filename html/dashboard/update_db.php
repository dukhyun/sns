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
	if ($_FILES['file']['name'] != NULL) {
		$upload_file_name = file_upload($root, $post_id);
	} else {
		$upload_file_name = 0;
	}
	
	// update db
	$update_query = sprintf("UPDATE post SET content='%s'", $content);
	if ($$upload_file_name != 0) { // image
		$update_query .= sprintf(", image='%s'", $upload_file_name);
	}
	if ($category_id == 0) { // category_id
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
