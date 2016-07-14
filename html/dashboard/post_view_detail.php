<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="/css/style.css">
<link rel="stylesheet" type="text/css" href="/css/dash.css">
</head>
<body>
<?php
	$root = '..';
	include_once $root.'/../include/header.php';
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		$post_id = $_GET['post_id'];
	}
	$conn = get_connection();
	$select_query = sprintf("SELECT * FROM post WHERE id=%d", $post_id);
	$result = mysqli_query($conn, $select_query);
	$row = mysqli_fetch_assoc($result);
	
	include "./post_view.php";
?>
	<!--comment-->
	댓글
	<form action="comment/comment_db.php" method="post">
		<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
		<ul>
			<li>
				<label>내용:</label>
				<textarea type="text" name="content"></textarea>
			</li>
			<li>
				<input type="submit" value="제출">
			</li>
		</ul>
	</form>
	
	<!-- comment list -->
<?php 
	$select_query = sprintf("SELECT * FROM comment WHERE post_id=%d", $post_id);
	$result_comment = mysqli_query($conn, $select_query);
	while ($row_comment = mysqli_fetch_assoc($result_comment)) {
?>
	<ul>
		<li>
			<?php echo get_user_nick($conn, $row_comment['user_id'])." : ".$row_comment['comment'].'<br>'; ?>
		</li>
		<?php 
		if ($_SESSION['id'] == get_user_email($conn, $row_comment['user_id'])) { ?>
		<li>
			<a href="./comment/delete_comment.php?id=<?php echo $row_comment['id']; ?>&post_id=<?php echo $post_id; ?>">삭제</a>
		</li>
		<?php } ?>
	</ul>
<?php
	}
?>
<?php // footer ?>

</body>
</html>