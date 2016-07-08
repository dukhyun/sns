<article>
<?php
	// post_list 에서 $conn 선언
	$post_id = $row['id'];
	$query = sprintf("SELECT * FROM post WHERE id = %s", $post_id);
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die ("Database access failed: ".mysqli_error());
	}
	$post_row = mysqli_fetch_assoc($result);
	$user_id = $post_row['user_id'];
	$nick = get_user_nick($conn, $user_id);
	$category = get_category_name($conn, $post_row['category_id']);
	$content = $post_row['content'];
	$date = time_set($post_row['date']);
?>
	<div class="post">
		<p><?php echo $date; ?></p>
		<p><?php echo $nick; ?></p>
		<p><?php echo $category; ?></p>
		<p><?php echo $content; ?></p>
		
	<?php
		if (check_login() === true) {
			if ($_SESSION['id'] == get_user_email($conn, $user_id)) {
	?>
		<a class="floatright" href="/dashboard/delete_db.php">글삭제</a>
		<a class="floatright" href="/dashboard/update_post.php">글수정</a><br>
	<?php
			}
		}
	?>
		<p>댓글</p>
	</div>
</article>