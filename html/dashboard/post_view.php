<article>
<?php
	$post_id = $row['id'];
	$user_id = $row['user_id'];
	$nick = get_user_nick($conn, $user_id);
	$category_id = $row['category_id'];
	$category = get_category_name($conn, $category_id);
	$content = $row['content'];
	$date = time_set($row['date']);
	$image  = $row['image'];
?>
	<div class="post">
	
		<div class="head clearfix">
			<h3 class="floatleft"><?php echo $nick; ?></h3>
	<?php
		printf('<a class="op floatleft" href="/dashboard/?user=%d&category_id=%d">%s</a>', $user_id, $category_id, $category);
		// admin
		if (check_login() === true) {
			if ($_SESSION['id'] !== get_user_email($conn, $user_id)) { 
	?>
				<a class="floatright" href="/dashboard/friend_db.php?id=<?php echo $user_id?>">친구추가</a>	
	<?php
			}
			if ($_SESSION['id'] == get_user_email($conn, $user_id)) {
	?>
			<a class="floatright" href="/dashboard/delete_db.php?post_id=<?php echo $post_id ?>">글삭제</a>
			<a class="floatright" href="/dashboard/update_post.php?post_id=<?php echo $post_id ?>">글수정</a>
	<?php
			}
		}
	?>
		</div>
		
		<?php
			if ($image != NULL) {
		?>
		<img src="/file/<?php echo $image; ?>">
		<?php
			}
		?>
		<p><?php echo $content; ?></p>
		<p><?php echo $date; ?></p>
		
		<!-- comment //-->
	</div>
</article>