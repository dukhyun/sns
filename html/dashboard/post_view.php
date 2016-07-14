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
	<div>
	
		<div class="head clearfix">
	<?php
		$picture = get_user_picture($conn, $user_id);
		if ($picture !== NULL) {
			printf('<img class="floatleft" src="/file/%s">', $picture);
		}
	?>
			<h3 class="floatleft"><?php echo $nick; ?></h3>
	<?php
		printf('<a class="category floatleft" href="/dashboard/?user=%d&category_id=%d">%s</a>', $user_id, $category_id, $category);
		// admin
		if (check_login() === true) {
			if ($_SESSION['id'] !== get_user_email($conn, $user_id)) {
				$select_query = sprintf("SELECT * FROM friend WHERE user_id=%d", get_user_id($conn, $_SESSION['id']));
				$result2 = mysqli_query($conn, $select_query);
				$row2 = mysqli_fetch_assoc($result2);
				if ($user_id !== $row2['friend_id']) {
	?>			
				<a class="floatright" href="/dashboard/friend/friend_db.php?id=<?php echo $user_id?>">친구추가</a>
	<?php
				}
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
		<ul class="post">
			<li><?php echo $content; ?></li>
		<?php
			if ($image != NULL) {
		?>
			<li><img src="/file/<?php echo $image; ?>"></li>
		<?php
			}
		?>
		</ul>
		<div class="date"><?php echo $date; ?></div>
		<!-- comment //-->
	</div>
</article>