<article>
<?php
	$post_id = $row['id'];
	$post_user_id = $row['user_id'];
	$nick = get_user_nick($conn, $post_user_id);
	$category_id = $row['category_id'];
	$category = get_category_name($conn, $category_id);
	$content = $row['content'];
	$date = time_set($row['date']);
	$image  = $row['image'];
?>
	<div>
	
		<div class="head clearfix">
	<?php
		$picture = get_user_picture($conn, $post_user_id);
		if ($picture !== NULL) {
			printf('<img class="floatleft" src="/file/%s">', $picture);
		}
	?>
			<h3 class="floatleft"><?php echo $nick; ?></h3>
	<?php
		printf('<a class="category floatleft" href="/dashboard/?user=%d&category_id=%d">%s</a>', $post_user_id, $category_id, $category);
		// admin
		if (check_login() === true) {
			if ($_SESSION['id'] !== get_user_email($conn, $post_user_id)) {
				$select_query = sprintf("SELECT * FROM friend WHERE post_user_id=%d", get_post_user_id($conn, $_SESSION['id']));
				$result_friend = mysqli_query($conn, $select_query);
				$friend_ok = 0;
				while ($row_friend = mysqli_fetch_assoc($result_friend)) {
					if ($post_user_id == $row_friend['friend_id']) {
						$friend_ok = 1;
						break;
					}
				}
				if ($friend_ok == 0) {
	?>			
				<a class="floatright" href="/dashboard/friend/friend_db.php?id=<?php echo $post_user_id; ?>">친구추가</a>
	<?php
				}
			} else {
	?>
			<a class="floatright" href="/dashboard/delete_db.php?post_id=<?php echo $post_id; ?>">글삭제</a>
			<a class="floatright" href="/dashboard/update_post.php?post_id=<?php echo $post_id; ?>">글수정</a>
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
		<div class="date"><a href="/dashboard/post_view_detail.php?post_id=<?php echo $post_id; ?>"><?php echo $date; ?></a></div>
	</div>
</article>