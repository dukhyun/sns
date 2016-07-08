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
	
	// upload file
	$upload_dir = $root.'/../file/';
	$upload_file = $upload_dir.basename($_FILES['file']['name']);
	$upload_ok = 1;
	// Check file size
	if ($_FILES['file']['size'] > 5000000) {
		echo 'Sorry, your file is too large.';
		$uploadOk = 0;
	}
	if ($uploadOk == 0) {
		echo 'Sorry, your file was not uploaded.';
	} else 
		if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
			echo 'The file '.basename($_FILES['file']['name']).' has been uploaded.';
		} else {
			echo 'Sorry, there was an error uploading your file.';
		}
	}
	
	$conn = get_connection();
	$user_id = get_user_id($conn, $_SESSION['id']);
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