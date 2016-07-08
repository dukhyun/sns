<article>
<?php
	$post_id = $row['id'];
	$user_id = $row['user_id'];
	$nick = get_user_nick($conn, $user_id);
	$category = get_category_name($conn, $row['category_id']);
	$content = $row['content'];
	$date = time_set($row['date']);
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
		<a class="floatright" href="/dashboard/delete_db.php?post_id=<?php echo $post_id ?>">글삭제</a>
		<a class="floatright" href="/dashboard/update_post.php?post_id=<?php echo $post_id ?>">글수정</a><br>
	<?php
			}
		}
	?>
		<p>댓글</p>
	</div>
</article>