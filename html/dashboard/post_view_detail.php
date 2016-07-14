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
?>

<section class="content">
	<div class="detail center">
	<?php include "./post_view.php"; ?>
		<!--comment-->
		<form action="comment/comment_db.php" method="post">
		<ul class="comment_write clearfix">
			<li>
				<input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
			</li>
			<li>
				<label>comment</label>
				<textarea type="text" name="content"></textarea>
			</li>
			<li class="floatright">
				<input type="submit" value="제출">
			</li>
		</ul>
		</form>
		
		<!-- comment list -->
		<div class="comment_list">
	<?php 
		$select_query = sprintf("SELECT * FROM comment WHERE post_id=%d", $post_id);
		$result_comment = mysqli_query($conn, $select_query);
		while ($row_comment = mysqli_fetch_assoc($result_comment)) {
	?>
		<ul class="clearfix">
			<li class="floatleft">
			<?php
				printf("<h3>%s</h3>", get_user_nick($conn, $row_comment['user_id']));
			?>
			</li>
			<?php
			if ($_SESSION['id'] == get_user_email($conn, $row_comment['user_id'])) {
			?>
			<li class="floatright">
				<a href="./comment/delete_comment.php?id=<?php echo $row_comment['id']; ?>&post_id=<?php echo $post_id; ?>">삭제</a>
			</li>
			<?php
			}
			?>
			<li class="txt clearboth">
			<?php
				printf("<div>%s</div>", $row_comment['comment']);
			?>
			</li>
		</ul>
	<?php
		}
	?>
		</div>
	</div>
</section>

<?php // footer ?>

</body>
</html>