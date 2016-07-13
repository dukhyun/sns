<section class="main floatleft">
	<!-- action //-->
	<div class="action">
		<a class="floatleft" href="/dashboard/write_post.php">글작성</a>
		<a class="floatleft" href="/dashboard/friend/friend_list.php">친구관리</a>
	</div>
	
	<!-- post list //-->
<?php
	$conn = get_connection();
	if (isset($_GET['category_id'])) {
		$category_id = $_GET['category_id'];
		$select_query = sprintf("SELECT * FROM post 
			WHERE user_id = %d AND category_id = %d ORDER BY date DESC", $user, $category_id);
	} else {
		$select_query = sprintf("SELECT * FROM post WHERE user_id = %d ORDER BY date DESC", $user);
	}

	$result = mysqli_query($conn, $select_query);
	while ($row = mysqli_fetch_assoc($result)) {
?>
	<?php include "./post_view.php"; ?>
<?php
	}
?>
</section>