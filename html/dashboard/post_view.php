<article>
<?php
	$root = '/..';
	include_once $root.'/../include/header.php';
	$conn = get_connection();
	// 포스트 내용 출력
	
	$select_query = 'SELECT id FROM post';
	$result_set = mysqli_query($conn, $select_query);
	while ($row=mysqli_fetch_assoc($result_set)) {
		$post_id = $row['id'];
		$query = sprintf("SELECT * FROM post WHERE id = %s", $post_id);
		$result = mysqli_query($conn, $query);
		if (!$result) {
			die ("Database access failed: ".mysqli_error());
		}
		$row = mysqli_fetch_assoc($result);
		$nick = get_user_nick($conn, $row['user_id']);
		$category = get_category_name($conn, $row['category_id']);
		$content = $row['content'];
		$date = time_set($row['date']);
?>
	<div class="post">
		<p><?php echo $date; ?></p>
		<p><?php echo $nick; ?></p>
		<p><?php echo $category; ?></p>
		<p><?php echo $content; ?></p>
		<a class="floatright" href="/dashboard/delete_db.php">글삭제</a>
		<a class="floatright" href="/dashboard/update_post.php">글수정</a><br>
		<p>댓글</p>
		
	</div>
<?php }?>
</article>