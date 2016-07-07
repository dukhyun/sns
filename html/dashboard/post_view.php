<article>
<?php
	$conn = get_connection();
	// 포스트 내용 출력
	$post_id = 1;
	$query = sprintf("SELECT * FROM post WHERE id = %s", $post_id);
	$result = mysqli_query($conn, $query);
	if (!$result) {
		die ("Database access failed: ".mysqli_error());
	}
	$row = mysqli_fetch_assoc($result);
	$nick = get_user_nick($conn, $row['user_id']);
	$category = get_category($conn, $row['category_id']);
	$content = $row['content'];
	$date = time_set($row['date']);
?>
	<div class="post">
		<p><?php echo $date; ?></p>
		<p><?php echo $nick; ?></p>
		<p><?php echo $category; ?></p>
		<p><?php echo $content; ?></p>
		
		<a class="floatright" href="/dashboard/delete_db.php">글삭제</a>
		<a class="floatright" href="/dashboard/update_post.php">글수정</a>
	</div>
</article>